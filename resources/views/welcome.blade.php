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
<body class="bg-slate-50 text-slate-800 min-h-screen antialiased selection:bg-amber-400 selection:text-slate-950">

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

    <!-- РАЗДЕЛ С ПРОЕКТАМИ И ЛЕНИВОЙ ПОДГРУЗКОЙ -->
    <main 
        class="max-w-6xl mx-auto px-6 py-16" 
        x-data="portfolioApp"
        @scroll.window.debounce.150ms="
            if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 700)) {
                loadMore();
            }
        ">
        
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
                <!-- Счётчик загруженных проектов -->
                <div class="text-xs text-slate-500 font-medium bg-white px-3.5 py-2 rounded-xl border border-slate-200 shadow-sm self-start md:self-auto">
                    Показано: <span x-text="visibleProjects.length" class="font-bold text-slate-900"></span> из <span x-text="filteredProjects.length" class="font-bold text-slate-900"></span> проектов
                </div>
            </div>

            <!-- Интерактивные фильтры -->
            <div class="space-y-4 bg-white p-6 rounded-2xl border border-slate-200/90 shadow-sm">
                <!-- Сфера -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2 min-w-[60px]">Сфера:</span>
                    <button 
                        @click="setSphere('all')" 
                        :class="selectedSphere === 'all' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        Все сферы
                    </button>
                    @foreach($spheres as $sphere)
                    <button 
                        @click="setSphere('{{ addslashes($sphere) }}')" 
                        :class="selectedSphere === '{{ addslashes($sphere) }}' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        {{ $sphere }}
                    </button>
                    @endforeach
                </div>

                <!-- Год -->
                <div class="flex flex-wrap items-center gap-2 border-t border-slate-100 pt-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2 min-w-[60px]">Год:</span>
                    <button 
                        @click="setYear('all')" 
                        :class="selectedYear === 'all' ? 'bg-amber-400 text-slate-950 font-bold shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">
                        Все года
                    </button>
                    @foreach($years as $year)
                    <button 
                        @click="setYear('{{ $year }}')" 
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
            <template x-for="project in visibleProjects" :key="project.id">
                <article 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="group bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-amber-400/60 transition-all duration-300 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative overflow-hidden">
                    
                    <div class="w-3 h-3 bg-amber-400 absolute top-0 right-0"></div>

                    <!-- Картинка с ленивой загрузкой -->
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="aspect-[4/3] rounded-xl overflow-hidden relative border border-slate-200 bg-slate-100">
                            <template x-if="project.cover_image">
                                <img 
                                    :src="'/storage/' + project.cover_image" 
                                    :alt="project.title" 
                                    loading="lazy"
                                    decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            </template>
                            <template x-if="!project.cover_image">
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                    <span class="font-serif-title italic text-sm">Без обложки</span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Контент -->
                    <div class="lg:col-span-7 order-1 lg:order-2 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span x-text="project.sphere" class="bg-amber-400/15 text-slate-900 border border-amber-400/30 text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md"></span>
                                <span x-text="project.year" class="bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-md"></span>
                            </div>
                            
                            <h3 x-text="project.title" class="font-serif-title text-2xl sm:text-3xl text-slate-900 font-semibold mb-4 group-hover:text-amber-600 transition-colors"></h3>
                            
                            <p x-text="project.description" class="text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line mb-6 font-normal"></p>
                        </div>

                        <template x-if="project.project_url">
                            <div>
                                <a :href="project.project_url" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider bg-amber-400 hover:bg-amber-500 text-slate-950 px-5 py-2.5 rounded-lg transition-all duration-200 shadow-sm">
                                    Перейти на сайт <span>→</span>
                                </a>
                            </div>
                        </template>
                    </div>

                </article>
            </template>

            <!-- Сообщение, если ничего не найдено -->
            <div x-show="filteredProjects.length === 0" x-cloak class="py-12 text-center text-slate-400 font-serif-title italic bg-white rounded-2xl border border-dashed border-slate-200">
                Проекты по выбранным фильтрам не найдены.
            </div>
        </div>

        <!-- ИНДИКАТОР ЛЕНИВОЙ ПОДГРУЗКИ ПРИ СКРОЛЛЕ -->
        <div x-show="visibleLimit < filteredProjects.length" class="text-center pt-12">
            <button @click="loadMore()" class="inline-flex items-center gap-3 px-6 py-3 bg-white hover:bg-slate-100 text-slate-700 font-semibold text-xs uppercase tracking-wider rounded-xl border border-slate-200 shadow-sm transition-all duration-200 cursor-pointer">
                <svg class="animate-spin h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Подгружаем еще проекты...
            </button>
        </div>

    </main>

    <!-- СНИППЕТ С КЛИЕНТСКОЙ ЛОГИКОЙ ALPINE -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('portfolioApp', () => ({
                projects: @json($projects),
                selectedSphere: 'all',
                selectedYear: 'all',
                visibleLimit: 6,
                step: 6,

                get filteredProjects() {
                    return this.projects.filter(p => {
                        const matchSphere = this.selectedSphere === 'all' || p.sphere === this.selectedSphere;
                        const matchYear = this.selectedYear === 'all' || String(p.year) === String(this.selectedYear);
                        return matchSphere && matchYear;
                    });
                },

                get visibleProjects() {
                    return this.filteredProjects.slice(0, this.visibleLimit);
                },

                setSphere(sphere) {
                    this.selectedSphere = sphere;
                    this.visibleLimit = this.step;
                },

                setYear(year) {
                    this.selectedYear = year;
                    this.visibleLimit = this.step;
                },

                loadMore() {
                    if (this.visibleLimit < this.filteredProjects.length) {
                        this.visibleLimit += this.step;
                    }
                }
            }));
        });
    </script>

    <!-- ФУТЕР -->
    <footer class="border-t border-slate-200 py-10 bg-white text-center text-slate-500 text-xs uppercase tracking-widest font-medium">
        © {{ date('Y') }} {{ $settings['site_name'] ?? 'Александра' }} — {{ $settings['site_role'] ?? 'Head of Web Development' }}
    </footer>

</body>
</html>