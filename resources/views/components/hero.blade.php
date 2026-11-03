@props(['heroSlides' => null, 'homeSetting' => null])

@php
    $slides = $heroSlides ?? \App\Models\HeroSlide::active()->orderBy('order', 'asc')->get();
    $setting = $homeSetting ?? \App\Models\HomeSetting::first();
    $slideCount = $slides->count();
@endphp

<!-- Hero Section (Modern Soft Institutional Style) -->
<section id="beranda" 
         class="relative bg-emerald-950 text-white overflow-hidden border-b border-emerald-900" 
         x-data="{ 
           activeSlide: 0, 
           totalSlides: {{ max($slideCount, 1) }}, 
           timer: null,
           autoplay() {
             if (this.totalSlides > 1) {
               this.timer = setInterval(() => {
                 this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
               }, 6000);
             }
           },
           stopAutoplay() {
             clearInterval(this.timer);
           },
           next() {
             if (this.totalSlides > 1) {
               this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
             }
           },
           prev() {
             if (this.totalSlides > 1) {
               this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
             }
           }
         }"
         x-init="autoplay()"
         @mouseenter="stopAutoplay()"
         @mouseleave="autoplay()">

  <!-- 1. Running Text / Ticker Pengumuman Sekolah (Soft Modern) -->
  @if(($setting->is_ticker_active ?? true) && !empty($setting->ticker_text ?? null))
  @php
    $formattedTicker = trim(preg_replace('/\r\n|\r|\n/', ' • ', $setting->ticker_text));
  @endphp
  <div class="bg-amber-500 text-emerald-950 font-medium text-xs sm:text-sm py-2 px-4 shadow-sm relative z-20 flex items-center overflow-hidden border-b border-amber-600">
    <!-- Label Pengumuman -->
    <div class="shrink-0 flex items-center gap-1.5 font-bold uppercase tracking-widest text-[11px] sm:text-xs bg-emerald-950 text-amber-300 px-3 py-1 border-l-2 border-amber-300 rounded-md mr-4 shadow-sm">
      <i class="fa-solid fa-bullhorn text-amber-400 animate-pulse"></i>
      <span>Pengumuman</span>
    </div>

    <!-- Ticker Running Text Content -->
    <div class="overflow-hidden whitespace-nowrap flex-1">
      <div class="animate-marquee flex items-center font-semibold text-xs sm:text-sm">
        <div class="flex items-center gap-6 shrink-0 pr-6">
          <span>{{ $formattedTicker }}</span>
          <span>•</span>
        </div>
        <div class="flex items-center gap-6 shrink-0 pr-6" aria-hidden="true">
          <span>{{ $formattedTicker }}</span>
          <span>•</span>
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- 2. Hero Carousel / Slider Container -->
  <div class="relative min-h-[580px] sm:min-h-[620px] lg:min-h-[660px] flex items-center">
    
    <!-- Islamic Pattern Backdrop Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none z-10 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:28px_28px]"></div>

    <!-- SLIDES BACKGROUND IMAGES -->
    @forelse($slides as $index => $slide)
    <div x-show="activeSlide === {{ $index }}" 
         x-transition:enter="transition-opacity ease-in-out duration-700"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in-out duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute inset-0 z-0">
      <img src="{{ $slide->image_url }}" 
           alt="{{ $slide->title }}" 
           @if($index === 0) loading="eager" fetchpriority="high" @else loading="lazy" decoding="async" @endif
           class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/95 via-emerald-950/85 to-emerald-900/60 sm:via-emerald-950/80"></div>
    </div>
    @empty
    <div class="absolute inset-0 z-0">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-1.jpg') : asset('assets/images/gallery-1.jpg') }}" 
           alt="Siswa/i MA Darun Najah" 
           loading="eager" fetchpriority="high"
           class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/95 via-emerald-950/85 to-emerald-900/60 sm:via-emerald-950/80"></div>
    </div>
    @endforelse

    @if($slideCount > 1)
    <!-- Slider Navigation Buttons (Soft Rounded) -->
    <button @click="prev()" 
            type="button"
            aria-label="Slide Sebelumnya"
            class="hidden md:flex absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-30 w-11 h-11 bg-emerald-950/80 hover:bg-emerald-900 text-white border border-emerald-700/80 rounded-lg items-center justify-center transition-all duration-200 hover:scale-105 shadow-lg backdrop-blur-xs cursor-pointer">
      <i class="fa-solid fa-chevron-left text-sm"></i>
    </button>
    <button @click="next()" 
            type="button"
            aria-label="Slide Selanjutnya"
            class="hidden md:flex absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-30 w-11 h-11 bg-emerald-950/80 hover:bg-emerald-900 text-white border border-emerald-700/80 rounded-lg items-center justify-center transition-all duration-200 hover:scale-105 shadow-lg backdrop-blur-xs cursor-pointer">
      <i class="fa-solid fa-chevron-right text-sm"></i>
    </button>
    @endif

    <!-- Slide Content Container -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        <!-- Left Side: Main Text & Action CTA -->
        <div class="lg:col-span-7 text-center lg:text-left">
          @forelse($slides as $index => $slide)
          <div x-show="activeSlide === {{ $index }}" 
               x-transition:enter="transition-all ease-out duration-500 delay-100"
               x-transition:enter-start="opacity-0 translate-y-3"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="space-y-6">
            
            <!-- Identity Badges -->
            <div class="inline-flex flex-wrap items-center justify-center lg:justify-start gap-2.5">
              @if(!empty($slide->badge_1))
              <span class="inline-flex items-center gap-1.5 bg-emerald-900/90 text-amber-300 border-l-2 border-amber-400 rounded-md text-xs font-semibold px-3 py-1 shadow-sm">
                <i class="fa-solid fa-moon text-amber-400"></i> {{ $slide->badge_1 }}
              </span>
              @endif
              @if(!empty($slide->badge_2))
              <span class="inline-flex items-center gap-1.5 bg-amber-500/20 text-amber-300 border-l-2 border-amber-400 rounded-md text-xs font-semibold px-3 py-1">
                <i class="fa-solid fa-shield-halved text-amber-400"></i> {{ $slide->badge_2 }}
              </span>
              @endif
            </div>

            <!-- Dynamic Headline -->
            <div>
              @if(!empty($slide->subtitle))
              <p class="text-xs sm:text-sm font-bold uppercase tracking-widest text-amber-400 mb-2">
                {{ $slide->subtitle }}
              </p>
              @endif

              <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight drop-shadow-md">
                @if(!empty($slide->title_highlight) && str_contains($slide->title, $slide->title_highlight))
                  {!! str_replace($slide->title_highlight, '<span class="text-amber-400">' . e($slide->title_highlight) . '</span>', nl2br(e($slide->title))) !!}
                @elseif(!empty($slide->title_highlight))
                  {{ $slide->title }} <br>
                  <span class="text-amber-400">{{ $slide->title_highlight }}</span>
                @else
                  {{ $slide->title }}
                @endif
              </h1>

              @if(!empty($slide->description))
              <p class="mt-4 text-sm sm:text-base lg:text-lg text-emerald-100/90 max-w-2xl font-normal leading-relaxed">
                {{ $slide->description }}
              </p>
              @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3.5 justify-center lg:justify-start pt-2">
              @if(!empty($slide->button_text))
              <a href="{{ $slide->button_url ?: route('ppdb') }}" 
                 class="inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-emerald-950 font-bold text-xs sm:text-sm uppercase tracking-wider px-7 py-3.5 rounded-lg shadow-lg shadow-amber-500/25 hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5 border-b-2 border-amber-700">
                <i class="fa-solid fa-graduation-cap text-base"></i>
                <span>{{ $slide->button_text }}</span>
              </a>
              @endif

              @if(!empty($slide->button_secondary_text))
              <a href="{{ $slide->button_secondary_url ?: ($contact ? $contact->getWaLink() : 'https://wa.me/6285658973426') }}" 
                 target="_blank" rel="noopener noreferrer"
                 class="inline-flex items-center justify-center gap-2.5 bg-emerald-900/80 hover:bg-emerald-800 text-white border border-emerald-600/70 rounded-lg font-semibold text-xs sm:text-sm uppercase tracking-wider px-6 py-3.5 backdrop-blur-xs shadow-md transition-all duration-200">
                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i>
                <span>{{ $slide->button_secondary_text }}</span>
              </a>
              @endif
            </div>

            <!-- Mini Badges Informasi Statistik -->
            <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs text-emerald-200/90 border-t border-emerald-800/60 font-medium">
              @if(!empty($setting->badge_stat_1))
              <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                <span>{{ $setting->badge_stat_1 }}</span>
              </div>
              @endif
              @if(!empty($setting->badge_stat_2))
              <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                <span>{{ $setting->badge_stat_2 }}</span>
              </div>
              @endif
              @if(!empty($setting->badge_stat_3))
              <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                <span>{{ $setting->badge_stat_3 }}</span>
              </div>
              @endif
            </div>

          </div>
          @empty
          <div class="space-y-6">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
              Madrasah Aliyah <br>
              <span class="text-amber-400">Darun Najah</span> Sambikarto
            </h1>
            <p class="text-sm sm:text-base text-emerald-100/90">
              Perpaduan harmonis kurikulum Kementerian Agama RI dan pengkajian kitab kuning salafiyah.
            </p>
          </div>
          @endforelse
        </div>

        <!-- Right Side: Sambutan Kepala Madrasah / Guru -->
        <div class="lg:col-span-5 flex justify-center">
          <div class="relative w-full max-w-sm sm:max-w-md bg-emerald-900/90 backdrop-blur-md rounded-2xl border-t-4 border-amber-400 border-x border-b border-emerald-700/60 shadow-2xl p-5 sm:p-6 text-left">
            
            <!-- Header Card Sambutan -->
            <div class="flex items-center gap-4 pb-4 border-b border-emerald-800/80">
              @if(!empty($setting->leader_image_url))
                <img src="{{ $setting->leader_image_url }}" alt="{{ $setting->leader_name ?? 'Kepala Madrasah' }}" loading="lazy" decoding="async" class="w-12 h-12 rounded-xl object-cover border border-amber-400 shadow-md shrink-0">
              @else
                <div class="w-12 h-12 bg-emerald-950 border border-amber-400 rounded-xl text-amber-400 flex items-center justify-center font-bold text-xl shrink-0 shadow-md">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
              @endif
              <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300 block">{{ $setting->welcome_badge ?? 'Sambutan Kepala Madrasah' }}</span>
                <h3 class="text-sm sm:text-base font-bold text-white leading-snug">
                  {{ $setting->welcome_title ?? 'Madrasah Aliyah Darun Najah' }}
                </h3>
                <p class="text-[11px] text-emerald-300">{{ $setting->welcome_subtitle ?? 'Sambikarto, Sekampung, Lampung Timur' }}</p>
              </div>
            </div>

            <!-- Quote Text -->
            <div class="py-4 space-y-2">
              <div class="text-amber-400 text-xl font-serif">“</div>
              <p class="text-xs sm:text-sm text-emerald-100 leading-relaxed italic -mt-3">
                {{ $setting->welcome_quote ?? 'Assalamu’alaikum Warahmatullahi Wabarakatuh. Selamat datang di portal resmi Madrasah Aliyah Darun Najah Sambikarto. Kami berkomitmen menyelenggarakan pendidikan menengah Islam formal yang unggul secara akademis, berwawasan sains teknologi, dan berakhlakul karimah guna membekali peserta didik menuju masa depan gemilang.' }}
              </p>
              <div class="pt-2">
                <p class="text-xs font-bold text-amber-300">{{ $setting->leader_name ?? 'H. Masruri, S.Pd.I, M.Pd.' }}</p>
                <p class="text-[11px] text-emerald-300">{{ $setting->leader_role ?? 'Kepala Madrasah Aliyah' }}</p>
              </div>
            </div>

            <!-- School Official Identifiers (NPSN / NSM) -->
            <div class="pt-3 border-t border-emerald-800/80 grid grid-cols-2 gap-2 text-center text-xs">
              <div class="bg-emerald-950/80 p-2.5 rounded-lg border-l-2 border-amber-400 text-left">
                <span class="text-[10px] text-slate-400 block font-medium uppercase tracking-wider">Jenjang</span>
                <strong class="text-amber-300 font-bold">{{ $setting->school_level ?? 'Madrasah Aliyah' }}</strong>
              </div>
              <div class="bg-emerald-950/80 p-2.5 rounded-lg border-l-2 border-emerald-400 text-left">
                <span class="text-[10px] text-slate-400 block font-medium uppercase tracking-wider">Status</span>
                <strong class="text-emerald-300 font-bold">{{ $setting->accreditation_status ?? 'Terakreditasi' }}</strong>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    @if($slideCount > 1)
    <!-- Slide Indicators -->
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
      <template x-for="(slide, index) in totalSlides" :key="index">
        <button @click="activeSlide = index" 
                type="button" 
                :aria-label="'Pindah ke slide ' + (index + 1)"
                class="transition-all duration-300 h-1.5 rounded-full cursor-pointer"
                :class="activeSlide === index ? 'w-8 bg-amber-400' : 'w-3 bg-white/40 hover:bg-white/70'"></button>
      </template>
    </div>
    @endif

  </div>

  <!-- 3. Four Quick Access Cards -->
  <div class="relative z-20 bg-emerald-950/80 border-t border-emerald-800/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Card 1 -->
        <a href="{{ $setting?->quick_card_1_url ?: route('ppdb') }}" 
           class="group p-4 bg-emerald-900/60 hover:bg-emerald-900 border-t-2 border-amber-400 border-x border-b border-emerald-800/80 rounded-xl transition-all duration-300 flex items-center gap-3.5 shadow-sm hover:shadow-md hover:-translate-y-0.5">
          <div class="w-11 h-11 bg-amber-500 text-emerald-950 border border-amber-300 rounded-lg flex items-center justify-center text-lg font-bold shadow-sm shrink-0 group-hover:scale-105 transition-transform">
            <i class="{{ $setting?->quick_card_1_icon ?: 'fa-solid fa-graduation-cap' }}"></i>
          </div>
          <div>
            <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-amber-300 transition-colors uppercase tracking-wider">
              {{ $setting?->quick_card_1_title ?: 'PPDB Online 2026' }}
            </h4>
            <p class="text-xs text-emerald-300/90 mt-0.5">
              {{ $setting?->quick_card_1_desc ?: 'Pendaftaran & Cek Status' }}
            </p>
          </div>
        </a>

        <!-- Card 2 -->
        <a href="{{ $setting?->quick_card_2_url ?: '#kurikulum' }}" 
           class="group p-4 bg-emerald-900/60 hover:bg-emerald-900 border-t-2 border-emerald-400 border-x border-b border-emerald-800/80 rounded-xl transition-all duration-300 flex items-center gap-3.5 shadow-sm hover:shadow-md hover:-translate-y-0.5">
          <div class="w-11 h-11 bg-emerald-600 text-white border border-emerald-400 rounded-lg flex items-center justify-center text-lg font-bold shadow-sm shrink-0 group-hover:scale-105 transition-transform">
            <i class="{{ $setting?->quick_card_2_icon ?: 'fa-solid fa-book-open' }}"></i>
          </div>
          <div>
            <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-amber-300 transition-colors uppercase tracking-wider">
              {{ $setting?->quick_card_2_title ?: 'Kurikulum Terpadu' }}
            </h4>
            <p class="text-xs text-emerald-300/90 mt-0.5">
              {{ $setting?->quick_card_2_desc ?: 'Kemenag RI & Kitab Kuning' }}
            </p>
          </div>
        </a>

        <!-- Card 3 -->
        <a href="{{ $setting?->quick_card_3_url ?: '#fasilitas' }}" 
           class="group p-4 bg-emerald-900/60 hover:bg-emerald-900 border-t-2 border-sky-400 border-x border-b border-emerald-800/80 rounded-xl transition-all duration-300 flex items-center gap-3.5 shadow-sm hover:shadow-md hover:-translate-y-0.5">
          <div class="w-11 h-11 bg-sky-600 text-white border border-sky-400 rounded-lg flex items-center justify-center text-lg font-bold shadow-sm shrink-0 group-hover:scale-105 transition-transform">
            <i class="{{ $setting?->quick_card_3_icon ?: 'fa-solid fa-building-columns' }}"></i>
          </div>
          <div>
            <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-amber-300 transition-colors uppercase tracking-wider">
              {{ $setting?->quick_card_3_title ?: 'Sarana & Asrama' }}
            </h4>
            <p class="text-xs text-emerald-300/90 mt-0.5">
              {{ $setting?->quick_card_3_desc ?: 'Gedung & Komplek Mukim' }}
            </p>
          </div>
        </a>

        <!-- Card 4 -->
        <a href="{{ $setting?->quick_card_4_url ?: '#berita' }}" 
           class="group p-4 bg-emerald-900/60 hover:bg-emerald-900 border-t-2 border-amber-500 border-x border-b border-emerald-800/80 rounded-xl transition-all duration-300 flex items-center gap-3.5 shadow-sm hover:shadow-md hover:-translate-y-0.5">
          <div class="w-11 h-11 bg-amber-600 text-white border border-amber-400 rounded-lg flex items-center justify-center text-lg font-bold shadow-sm shrink-0 group-hover:scale-105 transition-transform">
            <i class="{{ $setting?->quick_card_4_icon ?: 'fa-solid fa-newspaper' }}"></i>
          </div>
          <div>
            <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-amber-300 transition-colors uppercase tracking-wider">
              {{ $setting?->quick_card_4_title ?: 'Warta & Berita' }}
            </h4>
            <p class="text-xs text-emerald-300/90 mt-0.5">
              {{ $setting?->quick_card_4_desc ?: 'Prestasi & Agenda Madrasah' }}
            </p>
          </div>
        </a>

      </div>
    </div>
  </div>

</section>