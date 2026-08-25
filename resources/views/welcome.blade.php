<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] ?? 'Александра' }} — {{ $settings['site_role'] ?? 'Head of Web Dev & Senior PM' }}</title>
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts: Lora (Serif) & Inter (Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:ital,wght@0,500;0,600;1,400;1,600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif-title { font-family: 'Lora', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen antialiased selection:bg-amber-400 selection:text-slate-950" x-data="{ modalOpen: false, modalProject: {} }">

    <!-- НАВИГАЦИЯ -->
    <nav class="border-b border-slate-200 bg-white/90 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="w-3.5 h-3.5 bg-amber-400 inline-block rounded-sm shadow-sm"></span>
                <span class="font-serif-title text-xl font-semibold tracking-tight text-slate-900">
                    {{ $settings['site_name'] ?? 'Александра' }}
                </span>
            </div>
            
            <div class="flex items-center gap-4" x-data="{ copied: false }">
                <span class="hidden sm:inline-block text-xs uppercase tracking-widest text-slate-600 font-semibold bg-slate-100 px-3 py-1.5 rounded-md border border-slate-200">
                    {{ $settings['site_role'] ?? 'HEAD OF WEB DEV / SENIOR PM' }}
                </span>
                <button 
                    @click="navigator.clipboard.writeText('{{ $settings['contact_email'] ?? 'alexandra@example.com' }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                    class="text-xs font-bold uppercase tracking-wider bg-amber-400 hover:bg-amber-500 text-slate-950 px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-sm">
                    <span x-text="copied ? 'Скопировано!' : '{{ addslashes($settings['btn_contact_text'] ?? 'Написать') }}'"></span>
                    <span class="w-2 h-2 rounded-full bg-slate-950" x-show="!copied"></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="max-w-6xl mx-auto px-6 pt-12 pb-16 border-b border-slate-200">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
            
            <!-- Левый блок -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-900 bg-amber-400/20 px-3 py-1 rounded-md mb-6 border border-amber-400/40">
                        <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                        {{ $settings['hero_badge'] ?? 'Управление & Стратегия' }}
                    </div>
                    <h1 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl text-slate-900 leading-[1.2] mb-6 font-semibold">
                        {{ $settings['hero_title'] ?? 'Создаю предсказуемые процессы и сильные web-продукты для бизнеса.' }}
                    </h1>
                    <p class="text-base text-slate-600 leading-relaxed font-normal max-w-xl">
                        {{ $settings['hero_description'] ?? 'Руковожу командами разработки полного цикла. Оцифровываю хаос, защищаю бюджеты, внедряю прозрачный трекинг и гарантирую сдачу IT-проектов в срок.' }}
                    </p>
                </div>
            </div>
            
            <!-- Правый блок с метриками -->
            <div class="lg:col-span-5 bg-slate-950 text-white p-8 rounded-2xl shadow-xl space-y-6 relative overflow-hidden border-t-4 border-amber-400">
                <div class="relative z-10">
                    <div class="font-serif-title text-4xl font-semibold text-amber-400">
                        {{ $settings['stat_1_value'] ?? '12+ лет' }}
                    </div>
                    <div class="text-xs text-slate-300 uppercase tracking-wider mt-1 font-medium">
                        {{ $settings['stat_1_label'] ?? 'ОПЫТА РУКОВОДСТВА ОТДЕЛОМ' }}
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-6 relative z-10">
                    <div class="font-serif-title text-4xl font-semibold text-amber-400">
                        {{ $settings['stat_2_value'] ?? '100+' }}
                    </div>
                    <div class="text-xs text-slate-300 uppercase tracking-wider mt-1 font-medium">
                        {{ $settings['stat_2_label'] ?? 'СДАННЫХ ПРОЕКТОВ БЕЗ ШТРАФОВ' }}
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-6 relative z-10">
                    <div class="font-serif-title text-4xl font-semibold text-amber-400">
                        {{ $settings['stat_3_value'] ?? '100%' }}
                    </div>
                    <div class="text-xs text-slate-300 uppercase tracking-wider mt-1 font-medium">
                        {{ $settings['stat_3_label'] ?? 'КОНТРОЛЯ В БИТРИКС24 & АНАЛИТИКА' }}
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- РАЗДЕЛ С ПРОЕКТАМИ -->
    <main class="max-w-6xl mx-auto px-6 py-16" x-data="{ selectedSphere: 'all', selectedYear: 'all' }">
        
        <!-- Заголовок и фильтры -->
        <div class="mb-12 border-b border-slate-200 pb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="font-serif-title text-3xl text-slate-900 font-semibold">
                        {{ $settings['cases_title'] ?? 'Избранные кейсы' }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ $settings['cases_subtitle'] ?? 'Реализованные проекты, задачи и бизнес-результаты' }}
                    </p>
                </div>
            </div>

            <!-- Интерактивные фильтры -->
            <div class="space-y-4 bg-white p-6 rounded-2xl border border-slate-200/90 shadow-sm">
                <!-- Сфера -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2 min-w-[60px]">Сфера:</span>
                    <button 
                        @click="selectedSphere = 'all'" 
                        :class="selectedSphere === 'all' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        Все сферы
                    </button>
                    @foreach($spheres as $sphere)
                    <button 
                        @click="selectedSphere = '{{ $sphere }}'" 
                        :class="selectedSphere === '{{ $sphere }}' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        {{ $sphere }}
                    </button>
                    @endforeach
                </div>

                <!-- Год -->
                <div class="flex flex-wrap items-center gap-2 border-t border-slate-100 pt-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2 min-w-[60px]">Год:</span>
                    <button 
                        @click="selectedYear = 'all'" 
                        :class="selectedYear === 'all' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        Все года
                    </button>
                    @foreach($years as $year)
                    <button 
                        @click="selectedYear = '{{ $year }}'" 
                        :class="selectedYear === '{{ $year }}' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        {{ $year }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- КАРТОЧКИ КЕЙСОВ -->
        <div class="space-y-10">
            @forelse($projects as $project)
                <article 
                    x-show="(selectedSphere === 'all' || selectedSphere === '{{ $project->sphere }}') && (selectedYear === 'all' || selectedYear === '{{ $project->year }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="group bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-amber-400/60 transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative overflow-hidden">
                    
                    <div class="w-3 h-3 bg-amber-400 absolute top-0 right-0"></div>

                    <!-- Картинка -->
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="aspect-[4/3] rounded-xl overflow-hidden relative border border-slate-200 bg-slate-100">
                            @if($project->cover_image)
                                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                    <span class="font-serif-title italic text-sm">Без обложки</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Контент -->
                    <div class="lg:col-span-7 order-1 lg:order-2 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="bg-amber-400/15 text-slate-900 border border-amber-400/30 text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md">
                                    {{ $project->sphere }}
                                </span>
                                <span class="bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-md">
                                    {{ $project->year }}
                                </span>
                            </div>
                            
                            <h3 class="font-serif-title text-2xl sm:text-3xl text-slate-900 font-semibold mb-4 group-hover:text-amber-600 transition-colors">
                                {{ $project->title }}
                            </h3>
                            
                            <p class="text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line mb-6 font-normal">
                                {{ Str::limit($project->description, 200) }}
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <button 
                                @click="modalProject = { 
                                    title: '{{ addslashes($project->title) }}', 
                                    sphere: '{{ $project->sphere }}', 
                                    year: '{{ $project->year }}', 
                                    description: '{{ addslashes($project->description) }}',
                                    url: '{{ $project->project_url }}',
                                    image: '{{ $project->cover_image ? asset('storage/' . $project->cover_image) : '' }}'
                                }; modalOpen = true"
                                class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-950 bg-slate-100 hover:bg-amber-400 px-4 py-2.5 rounded-lg border border-slate-200 hover:border-amber-400 transition-all">
                                Быстрый просмотр
                            </button>

                            @if($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-amber-600 hover:text-amber-700">
                                    Перейти на сайт <span>→</span>
                                </a>
                            @endif
                        </div>
                    </div>

                </article>
            @empty
                <div class="py-12 text-center text-slate-400 font-serif-title italic bg-white rounded-2xl border border-dashed border-slate-200">
                    Проекты не найдены.
                </div>
            @endforelse
        </div>

    </main>

    <!-- МОДАЛЬНОЕ ОКНО -->
    <div 
        x-show="modalOpen" 
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div 
            @click.away="modalOpen = false" 
            class="bg-white rounded-2xl max-w-3xl w-full p-6 sm:p-8 border-t-4 border-amber-400 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            
            <button @click="modalOpen = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-800 text-xl font-bold p-2">✕</button>

            <div class="flex items-center gap-2 mb-4">
                <span class="bg-amber-400/20 text-slate-900 text-xs font-bold uppercase px-3 py-1 rounded-md" x-text="modalProject.sphere"></span>
                <span class="bg-slate-100 text-slate-600 text-xs font-semibold uppercase px-3 py-1 rounded-md" x-text="modalProject.year"></span>
            </div>

            <h3 class="font-serif-title text-2xl sm:text-3xl font-bold text-slate-900 mb-6" x-text="modalProject.title"></h3>

            <template x-if="modalProject.image">
                <img :src="modalProject.image" class="w-full h-64 sm:h-80 object-cover rounded-xl border border-slate-200 mb-6">
            </template>

            <p class="text-slate-700 text-base leading-relaxed whitespace-pre-line mb-8 font-normal" x-text="modalProject.description"></p>

            <div class="flex justify-between items-center border-t border-slate-100 pt-6">
                <button @click="modalOpen = false" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-800">
                    Закрыть
                </button>

                <template x-if="modalProject.url">
                    <a :href="modalProject.url" target="_blank" class="bg-amber-400 hover:bg-amber-500 text-slate-950 text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-lg transition shadow-sm">
                        Открыть проект →
                    </a>
                </template>
            </div>
        </div>
    </div>

    <!-- ФУТЕР -->
    <footer class="border-t border-slate-200 py-10 bg-white text-center text-slate-500 text-xs uppercase tracking-widest font-medium">
        © {{ date('Y') }} {{ $settings['site_name'] ?? 'Александра' }} — {{ $settings['site_role'] ?? 'Head of Web Development' }}
    </footer>

</body>
</html>