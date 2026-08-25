<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Александра — Руководитель web-разработки & Senior PM</title>
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen selection:bg-indigo-500 selection:text-white antialiased">

    <!-- HERO SECTION -->
    <header class="relative overflow-hidden border-b border-slate-800/80 bg-slate-900/40">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <!-- Роль / Бейдж -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold tracking-wide uppercase mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Head of Web Development / Senior PM
            </div>

            <!-- Главное имя и оффер -->
            <h1 class="text-3xl sm:text-5xl font-bold text-white tracking-tight leading-tight max-w-4xl mb-6">
                Привет! Я Александра — руководитель web-разработки и Senior PM.
            </h1>
            
            <p class="text-slate-400 text-lg sm:text-xl leading-relaxed max-w-3xl mb-12">
                Управляю производственными командами и IT-проектами полного цикла. 
                <span class="text-slate-200 font-medium">Оцифровываю процессы, защищаю бюджеты и гарантирую предсказуемый результат.</span>
            </p>

            <!-- 3 Ключевые метрики (Bento Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800/80 hover:border-slate-700/80 transition-all">
                    <div class="text-3xl sm:text-4xl font-extrabold text-indigo-400 mb-2">12+ лет</div>
                    <p class="text-sm text-slate-300 font-medium leading-snug">опыта руководства отделом разработки</p>
                </div>
                
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800/80 hover:border-slate-700/80 transition-all">
                    <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 mb-2">100+</div>
                    <p class="text-sm text-slate-300 font-medium leading-snug">сданных проектов без срывов дедлайнов и штрафных санкций</p>
                </div>

                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800/80 hover:border-slate-700/80 transition-all">
                    <div class="text-3xl sm:text-4xl font-extrabold text-purple-400 mb-2">100%</div>
                    <p class="text-sm text-slate-300 font-medium leading-snug">контроля: глубокая аналитика, прозрачный трекинг в Битрикс24 и личный контроль</p>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT (ПОРТФОЛИО С ФИЛЬТРАМИ) -->
    <main class="max-w-6xl mx-auto px-6 py-16" x-data="{ selectedSphere: 'all', selectedYear: 'all' }">
        
        <!-- Заголовок секции -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-2">Проекты под моим руководством</h2>
                <p class="text-slate-400 text-sm">Управление реализацией, контроль качества и решение бизнес-задач</p>
            </div>
        </div>

        <!-- ДВОЙНОЙ ВЗАИМОДОПОЛНЯЕМЫЙ ФИЛЬТР -->
        <div class="bg-slate-900/60 p-6 rounded-2xl border border-slate-800 mb-12 space-y-6">
            
            <!-- Фильтр по сферам -->
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Сфера бизнеса:</label>
                <div class="flex flex-wrap gap-2">
                    <button 
                        @click="selectedSphere = 'all'" 
                        :class="selectedSphere === 'all' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700'"
                        class="px-4 py-2 rounded-xl text-sm font-medium border transition-all">
                        Все сферы
                    </button>
                    @foreach($spheres as $sphere)
                    <button 
                        @click="selectedSphere = '{{ $sphere }}'" 
                        :class="selectedSphere === '{{ $sphere }}' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700'"
                        class="px-4 py-2 rounded-xl text-sm font-medium border transition-all">
                        {{ $sphere }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Разделительная линия -->
            <div class="border-t border-slate-800/60"></div>

            <!-- Фильтр по годам -->
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Год реализации:</label>
                <div class="flex flex-wrap gap-2">
                    <button 
                        @click="selectedYear = 'all'" 
                        :class="selectedYear === 'all' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700'"
                        class="px-4 py-2 rounded-xl text-sm font-medium border transition-all">
                        Все года
                    </button>
                    @foreach($years as $year)
                    <button 
                        @click="selectedYear = '{{ $year }}'" 
                        :class="selectedYear === '{{ $year }}' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700'"
                        class="px-4 py-2 rounded-xl text-sm font-medium border transition-all">
                        {{ $year }}
                    </button>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- СЕТКА ПРОЕКТОВ (Uniform Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($projects as $project)
                <div 
                    x-show="(selectedSphere === 'all' || selectedSphere === '{{ $project->sphere }}') && (selectedYear === 'all' || selectedYear === '{{ $project->year }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="group rounded-2xl bg-slate-900/80 border border-slate-800/80 overflow-hidden flex flex-col hover:border-slate-700 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10">
                    
                    <!-- Обложка -->
                    <div class="relative h-56 bg-slate-950 overflow-hidden border-b border-slate-800">
                        @if($project->cover_image)
                            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-600 bg-slate-900">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <!-- Бэйджи сбоку -->
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-lg bg-slate-950/80 backdrop-blur-md border border-slate-700/80 text-xs font-semibold text-slate-200">
                                {{ $project->sphere }}
                            </span>
                            <span class="px-3 py-1 rounded-lg bg-indigo-950/80 backdrop-blur-md border border-indigo-700/80 text-xs font-semibold text-indigo-300">
                                {{ $project->year }}
                            </span>
                        </div>
                    </div>

                    <!-- Контент карточки -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-indigo-400 transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-slate-400 text-sm leading-relaxed mb-6 whitespace-pre-line">
                                {{ $project->description }}
                            </p>
                        </div>

                        <!-- Ссылка если заполнена -->
                        @if($project->project_url)
                            <div class="pt-4 border-t border-slate-800/80">
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                                    Открыть проект
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-500">
                    Проекты пока не добавлены. Зайдите в <a href="/admin" class="text-indigo-400 underline">админ-панель</a> и создайте первый проект!
                </div>
            @endforelse
        </div>

    </main>

    <footer class="border-t border-slate-800/80 py-8 text-center text-slate-500 text-xs">
        © {{ date('Y') }} Александра. Руководство web-разработкой.
    </footer>

</body>
</html>