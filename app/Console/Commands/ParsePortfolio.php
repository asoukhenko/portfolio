<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use Illuminate\Support\Str;

class ParsePortfolio extends Command
{
    protected $signature = 'portfolio:parse {--fresh : Очистить старые проекты перед парсингом}';
    protected $description = 'Парсинг всех 73+ проектов с siluetstudio.com/portfolio';

    public function handle()
    {
        if ($this->option('fresh')) {
            Project::truncate();
            $this->warn('База данных очищена перед парсингом.');
        }

        $this->info('Начинаем сканирование страниц siluetstudio.com/portfolio...');

        $baseUrl = 'https://siluetstudio.com/portfolio';
        $processedTitles = [];
        $totalAdded = 0;

        // Обходим страницы 1..10
        for ($page = 1; $page <= 10; $page++) {
            $url = $page === 1 ? $baseUrl : "{$baseUrl}?page={$page}";
            
            $this->info("Запрос страницы {$page}: {$url}");

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36'
                ])
                ->get($url);

            if (!$response->successful()) {
                break;
            }

            $html = $response->body();

            libxml_use_internal_errors(true);
            $doc = new \DOMDocument();
            $doc->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NOERROR | LIBXML_NOWARNING);
            $xpath = new \DOMXPath($doc);

            // Ищем все карточки проектов
            $cardNodes = $xpath->query('//div[contains(@class, "portfolio") or contains(@class, "case") or contains(@class, "item") or contains(@class, "card") or contains(@class, "work")] | //a[contains(@href, "/portfolio/")]');

            if ($cardNodes->length === 0) {
                // Запасной выбор родительских контейнеров с картинками и услугами
                $cardNodes = $xpath->query('//*[count(.//img) > 0 and count(.//*[contains(text(), "Услуг")]) > 0]');
            }

            $pageAdded = 0;

            foreach ($cardNodes as $card) {
                $cardText = $card->textContent;
                if (empty(trim($cardText))) {
                    continue;
                }

                // 1. СФЕРА УСЛУГ (Услуга : Маркетинг, Веб-разработка)
                $sphere = 'Веб-разработка';
                if (preg_match('/Услуги?\s*:\s*([^\n\r]+)/ui', $cardText, $matches)) {
                    $cleanSphere = trim(strip_tags($matches[1]));
                    $cleanSphere = preg_replace('/[^\p{L}\p{N}\s,\.-]/u', '', $cleanSphere);
                    if (!empty($cleanSphere)) {
                        $sphere = trim($cleanSphere);
                    }
                }

                // 2. НАЗВАНИЕ ПРОЕКТА (Плашка на картинке: RadioMight, СтройМонтаж, Отель Агни)
                $title = '';

                // Находим все внутренние дочерние элементы с коротким текстом
                $nodes = $xpath->query('.//*[not(self::script) and not(self::style)]', $card);
                $candidates = [];

                foreach ($nodes as $node) {
                    $text = trim($node->textContent);
                    // Игнорируем длинные описания и блоки с текстом "Услуга"
                    if (!empty($text) && !str_contains(mb_strtolower($text), 'услуг') && mb_strlen($text) < 40) {
                        if ($node->childNodes->length <= 1) {
                            $candidates[] = $text;
                        }
                    }
                }

                // Берем первую короткую плашку
                if (!empty($candidates)) {
                    $title = $candidates[0];
                }

                // Резервный поиск по alt / title картинки
                if (empty($title)) {
                    $imgs = $xpath->query('.//img', $card);
                    if ($imgs->length > 0) {
                        $title = $imgs->item(0)->getAttribute('alt') ?: $imgs->item(0)->getAttribute('title');
                    }
                }

                $title = preg_replace('/^Услуги?\s*:\s*/ui', '', $title);
                $title = trim(preg_replace('/\s+/', ' ', $title));

                if (empty($title) || mb_strlen($title) < 2 || str_contains(mb_strtolower($title), 'услуг')) {
                    continue;
                }

                $titleKey = mb_strtolower($title);
                if (in_array($titleKey, $processedTitles)) {
                    continue; // Пропускаем дубли
                }

                // 3. ИЗОБРАЖЕНИЕ
                $imgSrc = '';
                $imgs = $xpath->query('.//img', $card);
                if ($imgs->length > 0) {
                    $img = $imgs->item(0);
                    $imgSrc = $img->getAttribute('data-src') 
                           ?: $img->getAttribute('data-original') 
                           ?: $img->getAttribute('src');
                    
                    if (str_contains($imgSrc, ' ')) {
                        $imgSrc = explode(' ', trim($imgSrc))[0];
                    }
                }

                if (empty($imgSrc)) {
                    $styleNodes = $xpath->query('.//*[@style]', $card);
                    foreach ($styleNodes as $sNode) {
                        $style = $sNode->getAttribute('style');
                        if (preg_match('/url\([\'"]?(.*?)[\'"]?\)/i', $style, $m)) {
                            $imgSrc = $m[1];
                            break;
                        }
                    }
                }

                // 4. ССЫЛКА НА ПРОЕКТ
                $projectUrl = 'https://siluetstudio.com/portfolio';
                if ($card->nodeName === 'a' && $card->hasAttribute('href')) {
                    $projectUrl = $card->getAttribute('href');
                } else {
                    $links = $xpath->query('.//a[@href]', $card);
                    if ($links->length > 0) {
                        $projectUrl = $links->item(0)->getAttribute('href');
                    }
                }
                if ($projectUrl && !str_starts_with($projectUrl, 'http')) {
                    $projectUrl = 'https://siluetstudio.com/' . ltrim($projectUrl, '/');
                }

                // 5. СКАЧИВАНИЕ КАРТИНКИ
                $coverPath = null;
                if (!empty($imgSrc)) {
                    if (!str_starts_with($imgSrc, 'http')) {
                        $imgSrc = 'https://siluetstudio.com/' . ltrim($imgSrc, '/');
                    }

                    try {
                        $imgRes = Http::withoutVerifying()->get($imgSrc);
                        if ($imgRes->successful() && strlen($imgRes->body()) > 500) {
                            $ext = pathinfo(parse_url($imgSrc, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                            $filename = 'projects/' . Str::random(20) . '.' . $ext;
                            Storage::disk('public')->put($filename, $imgRes->body());
                            $coverPath = $filename;
                        }
                    } catch (\Exception $e) {
                        // Ошибки скачивания отдельного файла игнорируем
                    }
                }

                // СОХРАНЕНИЕ
                Project::create([
                    'title'       => $title,
                    'sphere'      => $sphere,
                    'year'        => date('Y'),
                    'description' => "Разработка и реализация проекта «{$title}». Сфера: {$sphere}.",
                    'project_url' => $projectUrl,
                    'cover_image' => $coverPath,
                ]);

                $processedTitles[] = $titleKey;
                $pageAdded++;
                $totalAdded++;
                $this->info("✓ [{$totalAdded}] {$title} — {$sphere}");
            }

            // Если на новой странице нет ни одного нового проекта — завершаем
            if ($pageAdded === 0 && $page > 1) {
                break;
            }
        }

        $this->info("Успешно загружено проектов: {$totalAdded}");
        return 0;
    }
}