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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:ital,wght@0,500;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif-title { font-family: 'Lora', serif; }
    </style>
</head>
<body class="bg-slate-50/60 text-slate-800 min-h-screen antialiased selection:bg-indigo-600 selection:text-white">

    <!-- НАВИГАЦИЯ -->
    <nav class="border-b border-slate-200/80 bg-white/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-indigo-600 inline-block"></span>
                <span class="font-serif-title text-xl font-semibold tracking-tight text-slate-900">Александра</span>
            </div>
            <span class="text-xs uppercase tracking-widest text-indigo-700 font-semibold bg-indigo-50 px-3 py-1.5 rounded-full border border-indigo-100">
                Head of Web Dev / Senior PM
            </span>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="max-w-6xl mx-auto px-6 pt-16 pb-16 border-b border-slate-200">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-md mb-6 border border-indigo-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                    Управление & Стратегия
                </div>
                <h1 class="font-serif-title text-4xl sm:text-5xl text-slate-900 leading-[1.2] mb-6 font-semibold">
                    Создаю предсказуемые процессы и сильные web-продукты для бизнеса.
                </h1>
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                    Руковожу командами разработки полного цикла. 
                    Оцифровываю хаос, защищаю бюджеты, внедряю прозрачный трекинг и гарантирую сдачу IT-проектов в срок.
                </p>
            </div>
            
            <!-- Яркий блок метрик -->
            <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 text-white p-8 rounded-2xl shadow-xl shadow-indigo-950/10 space-y-6 relative overflow-hidden border border-slate-800">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="font-serif-title text-4xl font-semibold text-indigo-400">12+ лет</div>
                    <div class="text-xs text-slate-300 uppercase tracking-wider mt-1 font-medium">Опыта руководства отделом</div>
                </div>
                <div class="border-t border-slate-800 pt-6 relative z-10">
                    <div class="font-serif-title text-4xl font-semibold text-emerald-400">100+</div>
                    <div class="text-xs text-slate-300 uppercase tracking-wider mt-1 font-medium">Сданных проектов без штрафов</div>
                </div>
                <div class="border-t border-slate-800 pt-6 relative z-10">
                    <div class="font-serif-title text-4xl font-semibold text-amber-400">100%</div>
                    <div class="text-xs text-slate-300 uppercase tracking-wider mt-1 font-medium">Контроля в Битрикс24 & Аналитика</div>
                </div>
            </div>
        </div>
    </header>

    <!-- РАЗДЕЛ С ПРОЕКТАМИ -->
    <main class="max-w-6xl mx-auto px-6 py-16" x-data="{ selectedSphere: 'all', selectedYear: 'all' }">
        
        <!-- Заголовок и Фильтры -->
        <div class="mb-12 border-b border-slate-200 pb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="font-serif-title text-3xl text-slate-900 font-semibold">Избранные кейсы</h2>
                    <p class="text-sm text-slate-500 mt-1">Реализованные проекты, задачи и бизнес-результаты</p>
                </div>
            </div>

            <!-- Фильтры -->
            <div class="space-y-4 bg-white p-5 rounded-xl border border-slate-200/80 shadow-sm">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 mr-2">Сфера:</span>
                    <button 
                        @click="selectedSphere = 'all'" 
                        :class="selectedSphere === 'all' ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-600/30' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="px-3.5 py-1.5 text-xs font-medium rounded-lg transition-all duration-200">
                        Все сферы
                    </button>
                    @foreach($spheres as $sphere)
                    <button 
                        @click="selectedSphere = '{{ $sphere }}'" 
                        :class="selectedSphere === '{{ $sphere }}' ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-600/30' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="px-3.5 py-1.5 text-xs font-medium rounded-lg transition-all duration-200">
                        {{ $sphere }}
                    </button>
                    @endforeach
                </div>

                <div class="flex flex-wrap items-center gap-2 border-t border-slate-100 pt-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 mr-2">Год:</span>
                    <button 
                        @click="selectedYear = 'all'" 
                        :class="selectedYear === 'all' ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-600/30' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="px-3.5 py-1.5 text-xs font-medium rounded-lg transition-all duration-200">
                        Все года
                    </button>
                    @foreach($years as $year)
                    <button 
                        @click="selectedYear = '{{ $year }}'" 
                        :class="selectedYear === '{{ $year }}' ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-600/30' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="px-3.5 py-1.5 text-xs font-medium rounded-lg transition-all duration-200">
                        {{ $year }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- КАРТОЧКИ КЕЙСОВ -->
        <div class="space-y-12">
            @forelse($projects as $project)
                <article 
                    x-show="(selectedSphere === 'all' || selectedSphere === '{{ $project->sphere }}') && (selectedYear === 'all' || selectedYear === '{{ $project->year }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="group bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 hover:border-indigo-200 transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Картинка (Полноцветная + Smooth Scale) -->
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="aspect-[4/3] rounded-xl overflow-hidden relative border border-slate-200 bg-slate-100">
                            @if($project->cover_image)
                                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                    <span class="font-serif-title italic text-sm">Без изображения</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Контент кейса -->
                    <div class="lg:col-span-7 order-1 lg:order-2 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 text-[11px] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-md">
                                    {{ $project->sphere }}
                                </span>
                                <span class="bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-md">
                                    {{ $project->year }}
                                </span>
                            </div>
                            
                            <h3 class="font-serif-title text-2xl sm:text-3xl text-slate-900 font-semibold mb-4 group-hover:text-indigo-600 transition-colors">
                                {{ $project->title }}
                            </h3>
                            
                            <p class="text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line mb-6 font-normal">
                                {{ $project->description }}
                            </p>
                        </div>

                        @if($project->project_url)
                            <div>
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-semibold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-4 py-2.5 rounded-lg border border-indigo-100 transition-all">
                                    Перейти к проекту
                                    <span>→</span>
                                </a>
                            </div>
                        @endif
                    </div>

                </article>
            @empty
                <div class="py-12 text-center text-slate-400 font-serif-title italic">
                    Проекты пока не добавлены. Зайдите в <a href="/admin" class="text-indigo-600 underline">админ-панель</a> для добавления.
                </div>
            @endforelse
        </div>

    </main>

    <footer class="border-t border-slate-200 py-10 bg-white text-center text-slate-500 text-xs uppercase tracking-widest font-medium">
        © {{ date('Y') }} Александра — Руководство web-разработкой
    </footer>

</body>
</html>