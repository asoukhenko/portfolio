<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Александра — Head of Web Development & Senior PM</title>
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts: Lora (Serif) & Inter (Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Lora:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif-title { font-family: 'Lora', serif; }
    </style>
</head>
<body class="bg-[#FAF8F5] text-stone-800 min-h-screen antialiased selection:bg-stone-900 selection:text-stone-100">

    <!-- НАВИГАЦИЯ -->
    <nav class="border-b border-stone-300/60 py-6">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <span class="font-serif-title text-xl font-medium tracking-tight text-stone-900">Александра</span>
            <span class="text-xs uppercase tracking-widest text-stone-500 font-medium">Head of Web Dev / Senior PM</span>
        </div>
    </nav>

    <!-- HERO SECTION (EDITORIAL INTRO) -->
    <header class="max-w-6xl mx-auto px-6 pt-16 pb-20 border-b border-stone-300/60">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-stone-500 mb-4">Управление & Стратегия</p>
                <h1 class="font-serif-title text-4xl sm:text-6xl text-stone-900 leading-[1.15] mb-8 font-normal">
                    Создаю предсказуемые процессы и сильные web-продукты для бизнеса.
                </h1>
                <p class="text-lg text-stone-600 leading-relaxed max-w-2xl font-light">
                    Руковожу производственными командами разработки полного цикла. 
                    Оцифровываю хаос, защищаю бюджеты, внедряю прозрачный трекинг и гарантирую сдачу IT-проектов в срок.
                </p>
            </div>
            
            <!-- Блок метрик -->
            <div class="lg:col-span-4 bg-stone-100/80 p-8 border-l-2 border-stone-900 space-y-6">
                <div>
                    <div class="font-serif-title text-3xl font-semibold text-stone-900">12+ лет</div>
                    <div class="text-xs text-stone-600 uppercase tracking-wider mt-1">Опыта руководства отделом</div>
                </div>
                <div class="border-t border-stone-200 pt-6">
                    <div class="font-serif-title text-3xl font-semibold text-stone-900">100+</div>
                    <div class="text-xs text-stone-600 uppercase tracking-wider mt-1">Сданных проектов без штрафов</div>
                </div>
                <div class="border-t border-stone-200 pt-6">
                    <div class="font-serif-title text-3xl font-semibold text-stone-900">100%</div>
                    <div class="text-xs text-stone-600 uppercase tracking-wider mt-1">Контроля в Битрикс24 & Аналитика</div>
                </div>
            </div>
        </div>
    </header>

    <!-- РАЗДЕЛ С ПРОЕКТАМИ -->
    <main class="max-w-6xl mx-auto px-6 py-16" x-data="{ selectedSphere: 'all', selectedYear: 'all' }">
        
        <!-- Заголовок и фильтры -->
        <div class="mb-12 border-b border-stone-300/60 pb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="font-serif-title text-3xl text-stone-900">Избранные кейсы</h2>
                    <p class="text-sm text-stone-500 mt-1">Реализованные проекты, задачи и бизнес-результаты</p>
                </div>
            </div>

            <!-- Фильтры -->
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-medium uppercase tracking-wider text-stone-400 mr-2">Сфера:</span>
                    <button 
                        @click="selectedSphere = 'all'" 
                        :class="selectedSphere === 'all' ? 'bg-stone-900 text-stone-100' : 'bg-stone-200/60 text-stone-700 hover:bg-stone-200'"
                        class="px-3 py-1.5 text-xs font-medium transition-colors">
                        Все сферы
                    </button>
                    @foreach($spheres as $sphere)
                    <button 
                        @click="selectedSphere = '{{ $sphere }}'" 
                        :class="selectedSphere === '{{ $sphere }}' ? 'bg-stone-900 text-stone-100' : 'bg-stone-200/60 text-stone-700 hover:bg-stone-200'"
                        class="px-3 py-1.5 text-xs font-medium transition-colors">
                        {{ $sphere }}
                    </button>
                    @endforeach
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-medium uppercase tracking-wider text-stone-400 mr-2">Год:</span>
                    <button 
                        @click="selectedYear = 'all'" 
                        :class="selectedYear === 'all' ? 'bg-stone-900 text-stone-100' : 'bg-stone-200/60 text-stone-700 hover:bg-stone-200'"
                        class="px-3 py-1.5 text-xs font-medium transition-colors">
                        Все года
                    </button>
                    @foreach($years as $year)
                    <button 
                        @click="selectedYear = '{{ $year }}'" 
                        :class="selectedYear === '{{ $year }}' ? 'bg-stone-900 text-stone-100' : 'bg-stone-200/60 text-stone-700 hover:bg-stone-200'"
                        class="px-3 py-1.5 text-xs font-medium transition-colors">
                        {{ $year }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- КАРТОЧКИ КЕЙСОВ (ЖУРНАЛЬНАЯ СЕТКА) -->
        <div class="space-y-16">
            @forelse($projects as $project)
                <article 
                    x-show="(selectedSphere === 'all' || selectedSphere === '{{ $project->sphere }}') && (selectedYear === 'all' || selectedYear === '{{ $project->year }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 y-2"
                    x-transition:enter-end="opacity-100 y-0"
                    class="grid grid-cols-1 lg:grid-cols-12 gap-8 pb-16 border-b border-stone-300/60 items-start">
                    
                    <!-- Обложка -->
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="bg-stone-200 aspect-[4/3] overflow-hidden relative border border-stone-300/50">
                            @if($project->cover_image)
                                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-stone-400 bg-stone-200/50">
                                    <span class="font-serif-title italic text-sm">Без изображения</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Контент кейса -->
                    <div class="lg:col-span-7 order-1 lg:order-2 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center gap-3 text-xs uppercase tracking-widest text-stone-500 font-medium mb-3">
                                <span>{{ $project->sphere }}</span>
                                <span>•</span>
                                <span>{{ $project->year }}</span>
                            </div>
                            
                            <h3 class="font-serif-title text-2xl sm:text-3xl text-stone-900 font-normal mb-4">
                                {{ $project->title }}
                            </h3>
                            
                            <p class="text-stone-600 text-base leading-relaxed font-light whitespace-pre-line mb-6">
                                {{ $project->description }}
                            </p>
                        </div>

                        @if($project->project_url)
                            <div class="pt-2">
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold text-stone-900 hover:text-stone-600 border-b border-stone-900 pb-1 transition-colors">
                                    Перейти к проекту
                                    <span>→</span>
                                </a>
                            </div>
                        @endif
                    </div>

                </article>
            @empty
                <div class="py-12 text-center text-stone-500 font-serif-title italic">
                    Проекты пока не добавлены. Зайдите в <a href="/admin" class="text-stone-900 underline">админ-панель</a> для добавления.
                </div>
            @endforelse
        </div>

    </main>

    <footer class="border-t border-stone-300/60 py-12 text-center text-stone-500 text-xs uppercase tracking-widest">
        © {{ date('Y') }} Александра — Руководство web-разработкой
    </footer>

</body>
</html>