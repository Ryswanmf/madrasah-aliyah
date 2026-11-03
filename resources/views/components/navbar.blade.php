<!-- Header & Navbar with Alpine.js -->
<div x-data="{ 
       mobileOpen: false, 
       scrolled: false,
       toggleMobile() {
         this.mobileOpen = !this.mobileOpen;
       },
       closeMobile() {
         this.mobileOpen = false;
       }
     }" 
     x-init="$watch('mobileOpen', value => {
       if (value) {
         document.body.style.overflow = 'hidden';
       } else {
         document.body.style.overflow = '';
       }
     })"
     @keydown.escape.window="closeMobile()">

  <!-- Fixed Navbar Header -->
  <header @scroll.window="scrolled = (window.pageYOffset > 20)"
          :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md py-2.5' : 'bg-white shadow-sm py-3.5'"
          class="fixed top-0 left-0 right-0 z-40 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between gap-4">
        
        <!-- Logo & Brand Info -->
        <a href="{{ url('/') }}#beranda" class="flex items-center gap-2.5 sm:gap-3 group min-w-0">
          <img src="{{ !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png')) }}" 
               alt="Logo {{ $siteSetting->site_name ?? 'Madrasah Aliyah Darun Najah' }}" 
               decoding="async"
               class="w-10 h-10 sm:w-11 sm:h-11 object-contain transition-transform duration-300 group-hover:scale-105 shrink-0">
          <div class="flex flex-col min-w-0">
            <span class="text-sm sm:text-base lg:text-lg font-bold text-emerald-950 tracking-tight leading-tight group-hover:text-emerald-700 transition-colors truncate">
              {{ $siteSetting->site_name ?? 'Madrasah Aliyah Darun Najah' }}
            </span>
            <span class="text-[10px] sm:text-xs font-medium text-amber-600 truncate">
              {{ $siteSetting->site_tagline ?? 'Sambikarto, Sekampung, Lampung Timur' }}
            </span>
          </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-6 xl:gap-8 font-medium text-sm text-slate-700">
          <!-- 1. Beranda -->
          <a href="{{ url('/') }}#beranda" 
             class="hover:text-emerald-700 transition-colors py-1 relative hover:after:w-full after:w-0 after:h-0.5 after:bg-emerald-600 after:absolute after:bottom-0 after:left-0 after:transition-all after:duration-300">
            Beranda
          </a>

          <!-- 2. Profil Dropdown (Sejarah, Dewan Guru, Fasilitas, Ekstrakulikuler, FAQ) -->
          <div class="relative py-1" 
               x-data="{ dropdownOpen: false }" 
               @mouseenter="dropdownOpen = true" 
               @mouseleave="dropdownOpen = false"
               @click.outside="dropdownOpen = false">
            <button @click="dropdownOpen = !dropdownOpen" 
                    type="button" 
                    class="flex items-center gap-1.5 hover:text-emerald-700 transition-colors focus:outline-none cursor-pointer py-1">
              <span>Profil</span>
              <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" 
                 :class="dropdownOpen ? 'rotate-180 text-emerald-700' : 'text-slate-400'"></i>
            </button>

            <!-- Dropdown Popup Menu -->
            <div x-show="dropdownOpen"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                 x-cloak
                 class="absolute top-full left-0 w-56 bg-white border border-slate-200 border-t-2 border-t-emerald-700 rounded-xl shadow-xl py-2 mt-2 z-50 overflow-hidden">
              <a href="{{ route('sejarah') }}" 
                 @click="dropdownOpen = false" 
                 class="flex items-center gap-2.5 px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors border-b border-slate-100">
                <i class="fa-solid fa-landmark text-emerald-600 w-4"></i>
                <span>Sejarah Lembaga</span>
              </a>
              <a href="{{ route('guru') }}" 
                 @click="dropdownOpen = false" 
                 class="flex items-center gap-2.5 px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors border-b border-slate-100">
                <i class="fa-solid fa-chalkboard-user text-emerald-600 w-4"></i>
                <span>Dewan Guru & Asatidz</span>
              </a>
              <a href="{{ route('fasilitas') }}" 
                 @click="dropdownOpen = false" 
                 class="flex items-center gap-2.5 px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors border-b border-slate-100">
                <i class="fa-solid fa-building text-emerald-600 w-4"></i>
                <span>Fasilitas</span>
              </a>
              <a href="{{ route('ekstrakulikuler') }}" 
                 @click="dropdownOpen = false" 
                 class="flex items-center gap-2.5 px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors border-b border-slate-100">
                <i class="fa-solid fa-trophy text-emerald-600 w-4"></i>
                <span>Ekstrakulikuler</span>
              </a>
              <a href="{{ route('faq') }}" 
                 @click="dropdownOpen = false" 
                 class="flex items-center gap-2.5 px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
                <i class="fa-solid fa-circle-question text-emerald-600 w-4"></i>
                <span>Tanya Jawab</span>
              </a>
            </div>
          </div>

          <!-- 3. Berita -->
          <a href="{{ route('berita') }}" 
             class="hover:text-emerald-700 transition-colors py-1 relative hover:after:w-full after:w-0 after:h-0.5 after:bg-emerald-600 after:absolute after:bottom-0 after:left-0 after:transition-all after:duration-300">
            Berita
          </a>

          <!-- 4. Kurikulum -->
          <a href="{{ route('kurikulum') }}" 
             class="hover:text-emerald-700 transition-colors py-1 relative hover:after:w-full after:w-0 after:h-0.5 after:bg-emerald-600 after:absolute after:bottom-0 after:left-0 after:transition-all after:duration-300">
            Kurikulum
          </a>

          <!-- 5. Gallery -->
          <a href="{{ route('galeri') }}" 
             class="hover:text-emerald-700 transition-colors py-1 relative hover:after:w-full after:w-0 after:h-0.5 after:bg-emerald-600 after:absolute after:bottom-0 after:left-0 after:transition-all after:duration-300">
            Gallery
          </a>

          <!-- 6. Kontak -->
          <a href="{{ route('kontak') }}" 
             class="hover:text-emerald-700 transition-colors py-1 relative hover:after:w-full after:w-0 after:h-0.5 after:bg-emerald-600 after:absolute after:bottom-0 after:left-0 after:transition-all after:duration-300">
            Kontak
          </a>
        </nav>

        <!-- Right Side: CTA Button Desktop & Mobile Hamburger Button -->
        <div class="flex items-center gap-3">
          <!-- Desktop CTA Button -->
          <div class="hidden lg:flex items-center gap-2.5">
            <a href="{{ route('ppdb') }}" 
               class="inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-emerald-950">
              <i class="fa-solid fa-graduation-cap text-amber-400"></i>
              <span>Daftar PPDB</span>
            </a>
          </div>

          <!-- Mobile Hamburger Button -->
          <button @click="toggleMobile()" 
                  type="button" 
                  class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 active:scale-95 border border-slate-200/90 shadow-2xs focus:outline-none transition-all cursor-pointer shrink-0" 
                  :aria-expanded="mobileOpen ? 'true' : 'false'"
                  aria-label="Menu Utama">
            <i class="fa-solid fa-bars text-lg text-emerald-900"></i>
          </button>
        </div>

      </div>
    </div>
  </header>

  <!-- Mobile Drawer Backdrop (z-50) -->
  <div x-show="mobileOpen" 
       x-transition:enter="transition-opacity ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @click="closeMobile()"
       x-cloak
       class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 lg:hidden"></div>

  <!-- Mobile Drawer Panel (z-50) -->
  <div x-show="mobileOpen" 
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="translate-x-full"
       x-cloak
       class="fixed inset-y-0 right-0 w-[86vw] max-w-sm bg-white shadow-2xl z-50 flex flex-col lg:hidden border-l border-emerald-100">
    
    <!-- Drawer Top Header (Emerald Theme) -->
    <div class="px-5 py-4 border-b border-emerald-950 bg-gradient-to-r from-emerald-900 via-emerald-850 to-emerald-900 text-white flex items-center justify-between shrink-0 shadow-sm">
      <div class="flex items-center gap-3 min-w-0 pr-2">
        <div class="w-10 h-10 rounded-xl bg-white p-1 shadow-sm shrink-0 flex items-center justify-center">
          <img src="{{ !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png')) }}" 
               alt="Logo {{ $siteSetting->site_name ?? 'Madrasah Aliyah Darun Najah' }}" 
               class="w-full h-full object-contain">
        </div>
        <div class="flex flex-col min-w-0">
          <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300 leading-tight">Madrasah Aliyah</span>
          <span class="text-sm font-bold text-white truncate leading-tight">Darun Najah</span>
          <span class="text-[10px] text-amber-300/90 truncate leading-tight mt-0.5">{{ $siteSetting->site_tagline ?? 'Sambikarto, Sekampung, Lampung Timur' }}</span>
        </div>
      </div>
      <button @click="closeMobile()" 
              type="button"
              class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 active:scale-95 text-white flex items-center justify-center shrink-0 transition-colors focus:outline-none cursor-pointer"
              aria-label="Tutup Menu">
        <i class="fa-solid fa-xmark text-base"></i>
      </button>
    </div>

    <!-- Drawer Navigation Body (Scrollable) -->
    <div class="flex-1 overflow-y-auto px-4 py-4 space-y-1 overscroll-contain">
      <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Navigasi Utama</p>

      <!-- 1. Beranda -->
      <a @click="closeMobile()" href="{{ url('/') }}#beranda" 
         class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:text-emerald-900 hover:bg-emerald-50/80 transition-all active:scale-[0.99]">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-xs">
            <i class="fa-solid fa-house"></i>
          </div>
          <span class="font-semibold text-sm">Beranda</span>
        </div>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all"></i>
      </a>

      <!-- 2. Profil Dropdown (Accordion) -->
      <div x-data="{ subOpen: false }" class="space-y-1">
        <button @click="subOpen = !subOpen" 
                type="button" 
                class="w-full group flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:text-emerald-900 hover:bg-emerald-50/80 transition-all cursor-pointer">
          <div class="flex items-center gap-3 min-w-0">
            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-xs">
              <i class="fa-solid fa-landmark"></i>
            </div>
            <span class="font-semibold text-sm">Profil</span>
          </div>
          <div class="flex items-center gap-1.5 text-xs text-slate-400">
            <span class="text-[11px] font-normal text-slate-400" x-text="subOpen ? 'Tutup' : 'Lihat'">Lihat</span>
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" 
               :class="subOpen ? 'rotate-180 text-emerald-700' : 'text-slate-400'"></i>
          </div>
        </button>
        
        <div x-show="subOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             x-cloak
             class="ml-4 pl-3 border-l-2 border-emerald-500/40 space-y-1 my-1.5">
          <a @click="closeMobile()" href="{{ route('sejarah') }}" 
             class="flex items-center gap-2.5 py-2 px-2.5 text-xs font-medium text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/70 rounded-lg transition-colors">
            <i class="fa-solid fa-book-bookmark text-xs text-emerald-600 w-4 text-center"></i>
            <span>Sejarah Lembaga</span>
          </a>
          <a @click="closeMobile()" href="{{ route('guru') }}" 
             class="flex items-center gap-2.5 py-2 px-2.5 text-xs font-medium text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/70 rounded-lg transition-colors">
            <i class="fa-solid fa-chalkboard-user text-xs text-emerald-600 w-4 text-center"></i>
            <span>Dewan Guru & Asatidz</span>
          </a>
          <a @click="closeMobile()" href="{{ route('fasilitas') }}" 
             class="flex items-center gap-2.5 py-2 px-2.5 text-xs font-medium text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/70 rounded-lg transition-colors">
            <i class="fa-solid fa-building text-xs text-emerald-600 w-4 text-center"></i>
            <span>Fasilitas</span>
          </a>
          <a @click="closeMobile()" href="{{ route('ekstrakulikuler') }}" 
             class="flex items-center gap-2.5 py-2 px-2.5 text-xs font-medium text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/70 rounded-lg transition-colors">
            <i class="fa-solid fa-trophy text-xs text-emerald-600 w-4 text-center"></i>
            <span>Ekstrakulikuler</span>
          </a>
          <a @click="closeMobile()" href="{{ route('faq') }}" 
             class="flex items-center gap-2.5 py-2 px-2.5 text-xs font-medium text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/70 rounded-lg transition-colors">
            <i class="fa-solid fa-circle-question text-xs text-emerald-600 w-4 text-center"></i>
            <span>Tanya Jawab (FAQ)</span>
          </a>
        </div>
      </div>

      <!-- 3. Berita -->
      <a @click="closeMobile()" href="{{ route('berita') }}" 
         class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:text-emerald-900 hover:bg-emerald-50/80 transition-all active:scale-[0.99]">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-xs">
            <i class="fa-solid fa-newspaper"></i>
          </div>
          <span class="font-semibold text-sm">Berita</span>
        </div>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all"></i>
      </a>

      <!-- 4. Kurikulum -->
      <a @click="closeMobile()" href="{{ route('kurikulum') }}" 
         class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:text-emerald-900 hover:bg-emerald-50/80 transition-all active:scale-[0.99]">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-xs">
            <i class="fa-solid fa-book-open"></i>
          </div>
          <span class="font-semibold text-sm">Kurikulum</span>
        </div>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all"></i>
      </a>

      <!-- 5. Galeri -->
      <a @click="closeMobile()" href="{{ route('galeri') }}" 
         class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:text-emerald-900 hover:bg-emerald-50/80 transition-all active:scale-[0.99]">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-xs">
            <i class="fa-solid fa-images"></i>
          </div>
          <span class="font-semibold text-sm">Galeri</span>
        </div>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all"></i>
      </a>

      <!-- 6. Kontak -->
      <a @click="closeMobile()" href="{{ route('kontak') }}" 
         class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:text-emerald-900 hover:bg-emerald-50/80 transition-all active:scale-[0.99]">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors text-xs">
            <i class="fa-solid fa-map-location-dot"></i>
          </div>
          <span class="font-semibold text-sm">Kontak</span>
        </div>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all"></i>
      </a>
    </div>

    <!-- Drawer Mobile Footer -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/90 shrink-0 space-y-2.5">
      <a @click="closeMobile()" href="{{ route('ppdb') }}" 
         class="w-full flex items-center justify-center gap-2.5 bg-gradient-to-r from-emerald-800 to-emerald-700 hover:from-emerald-900 hover:to-emerald-800 text-white font-bold text-xs uppercase tracking-wider py-3.5 px-4 rounded-xl shadow-md shadow-emerald-900/10 active:scale-98 transition-all border-b-2 border-emerald-950">
        <i class="fa-solid fa-graduation-cap text-amber-400 text-sm"></i>
        <span>Daftar PPDB Online</span>
      </a>

      @if($contact && $contact->email)
        <a href="mailto:{{ $contact->email }}"
           class="flex items-center justify-center gap-2 p-2 rounded-lg text-slate-600 hover:text-emerald-800 hover:bg-white text-xs transition-colors">
          <i class="fa-regular fa-envelope text-slate-400"></i>
          <span class="truncate">{{ $contact->email }}</span>
        </a>
      @endif

      <p class="text-[11px] text-center text-slate-400 font-mono">
        {{ $ppdbSetting?->academic_year ?? 'Tahun Pelajaran 2026/2027' }}
      </p>
    </div>

  </div>

</div>
<!-- Header Spacer -->
<div class="h-16 lg:h-20"></div>
