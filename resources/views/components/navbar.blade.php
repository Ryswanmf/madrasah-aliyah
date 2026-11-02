<!-- Header & Navbar with Alpine.js -->
<header x-data="{ mobileOpen: false, scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md py-2.5' : 'bg-white shadow-sm py-3.5'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      
      <!-- Logo & Brand Info -->
      <a href="{{ url('/') }}#beranda" class="flex items-center gap-3 group">
        <img src="{{ !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png')) }}" 
             alt="Logo {{ $siteSetting->site_name ?? 'MA Darun Najah' }}" 
             decoding="async"
             class="w-11 h-11 object-contain transition-transform duration-300 group-hover:scale-105">
        <div class="flex flex-col">
          <span class="text-base sm:text-lg font-bold text-emerald-900 tracking-tight leading-tight group-hover:text-emerald-700 transition-colors">
            {{ $siteSetting->site_name ?? 'PPDN Darun Najah' }}
          </span>
          <span class="text-xs font-medium text-amber-600">
            {{ $siteSetting->site_tagline ?? 'Madrasah Aliyah • Sambikarto' }}
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

          <!-- Dropdown Popup Menu (Soft Rounded Style) -->
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

      <!-- Desktop CTA Button (Soft Rounded) -->
      <div class="hidden lg:flex items-center gap-2.5">
        @if($contact && ($contact->whatsapp || $contact->phone))
          <a href="{{ $contact->getWaLink() }}" target="_blank" rel="noopener noreferrer" 
             class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-emerald-800 hover:text-emerald-950 bg-emerald-50 hover:bg-emerald-100 rounded-lg border border-emerald-200 transition-colors"
             title="Hotline WhatsApp">
            <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
            <span class="hidden xl:inline font-mono">{{ $contact->phone ?: $contact->whatsapp }}</span>
            <span class="xl:hidden">Hotline</span>
          </a>
        @endif

        <a href="{{ route('ppdb') }}" 
           class="inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-emerald-950">
          <i class="fa-solid fa-graduation-cap text-amber-400"></i>
          <span>Daftar PPDB</span>
        </a>
      </div>

      <!-- Mobile Hamburger Button -->
      <button @click="mobileOpen = !mobileOpen" 
              type="button" 
              class="lg:hidden p-2 rounded-lg text-slate-700 hover:text-emerald-700 hover:bg-slate-100 focus:outline-none cursor-pointer transition-colors" 
              aria-label="Toggle Menu">
        <i class="fa-solid text-xl" :class="mobileOpen ? 'fa-xmark' : 'fa-bars'"></i>
      </button>

    </div>
  </div>

  <!-- Mobile Drawer Backdrop -->
  <div x-show="mobileOpen" 
       x-transition:enter="transition-opacity ease-linear duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-linear duration-300"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @click="mobileOpen = false"
       x-cloak
       class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden"></div>

  <!-- Mobile Drawer Menu -->
  <div x-show="mobileOpen" 
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="translate-x-full"
       x-cloak
       class="fixed top-0 right-0 bottom-0 w-72 max-w-[80vw] bg-white rounded-l-2xl shadow-2xl z-50 p-6 flex flex-col justify-between lg:hidden overflow-y-auto">
    
    <div>
      <!-- Drawer Header -->
      <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
        <div class="flex items-center gap-2.5">
          <img src="{{ !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png')) }}" alt="Logo {{ $siteSetting->site_name ?? 'MA' }}" loading="lazy" decoding="async" class="w-9 h-9 object-contain">
          <div class="flex flex-col">
            <span class="text-sm font-bold text-emerald-950">{{ $siteSetting->site_name ?? 'PPDN Darun Najah' }}</span>
            <span class="text-[10px] text-amber-600 font-medium">{{ $siteSetting->site_tagline ?? 'Madrasah Aliyah' }}</span>
          </div>
        </div>
        <button @click="mobileOpen = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <!-- Drawer Nav Links -->
      <nav class="flex flex-col space-y-1.5 text-sm font-medium text-slate-700">
        <!-- 1. Beranda -->
        <a @click="mobileOpen = false" href="{{ url('/') }}#beranda" 
           class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
          <i class="fa-solid fa-house w-5 text-emerald-600"></i>
          <span>Beranda</span>
        </a>

        <!-- 2. Profil Dropdown Mobile -->
        <div x-data="{ subOpen: false }" class="space-y-1">
          <button @click="subOpen = !subOpen" 
                  type="button" 
                  class="w-full flex items-center justify-between p-2.5 rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-colors text-slate-700 font-medium cursor-pointer">
            <div class="flex items-center gap-3">
              <i class="fa-solid fa-landmark w-5 text-emerald-600"></i>
              <span>Profil</span>
            </div>
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" 
               :class="subOpen ? 'rotate-180 text-emerald-700' : 'text-slate-400'"></i>
          </button>
          
          <div x-show="subOpen" 
               x-transition:enter="transition ease-out duration-150"
               x-transition:enter-start="opacity-0 -translate-y-1"
               x-transition:enter-end="opacity-100 translate-y-0"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 translate-y-0"
               x-transition:leave-end="opacity-0 -translate-y-1"
               class="pl-8 pr-2 space-y-1 py-1.5 bg-slate-50/70 rounded-xl">
            <a @click="mobileOpen = false" href="{{ route('sejarah') }}" 
               class="flex items-center gap-2.5 py-2 px-3 text-xs sm:text-sm text-slate-600 hover:text-emerald-800 rounded-lg hover:bg-emerald-50/70">
              <i class="fa-solid fa-book-bookmark text-xs text-emerald-600"></i>
              <span>Sejarah Lembaga</span>
            </a>
            <a @click="mobileOpen = false" href="{{ route('guru') }}" 
               class="flex items-center gap-2.5 py-2 px-3 text-xs sm:text-sm text-slate-600 hover:text-emerald-800 rounded-lg hover:bg-emerald-50/70">
              <i class="fa-solid fa-chalkboard-user text-xs text-emerald-600"></i>
              <span>Dewan Guru & Asatidz</span>
            </a>
            <a @click="mobileOpen = false" href="{{ route('fasilitas') }}" 
               class="flex items-center gap-2.5 py-2 px-3 text-xs sm:text-sm text-slate-600 hover:text-emerald-800 rounded-lg hover:bg-emerald-50/70">
              <i class="fa-solid fa-building text-xs text-emerald-600"></i>
              <span>Fasilitas</span>
            </a>
            <a @click="mobileOpen = false" href="{{ route('ekstrakulikuler') }}" 
               class="flex items-center gap-2.5 py-2 px-3 text-xs sm:text-sm text-slate-600 hover:text-emerald-800 rounded-lg hover:bg-emerald-50/70">
              <i class="fa-solid fa-trophy text-xs text-emerald-600"></i>
              <span>Ekstrakulikuler</span>
            </a>
            <a @click="mobileOpen = false" href="{{ route('faq') }}" 
               class="flex items-center gap-2.5 py-2 px-3 text-xs sm:text-sm text-slate-600 hover:text-emerald-800 rounded-lg hover:bg-emerald-50/70">
              <i class="fa-solid fa-circle-question text-xs text-emerald-600"></i>
              <span>Tanya Jawab</span>
            </a>
          </div>
        </div>

        <!-- 3. Berita -->
        <a @click="mobileOpen = false" href="{{ route('berita') }}" 
           class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
          <i class="fa-solid fa-newspaper w-5 text-emerald-600"></i>
          <span>Berita</span>
        </a>

        <!-- 4. Kurikulum -->
        <a @click="mobileOpen = false" href="{{ route('kurikulum') }}" 
           class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
          <i class="fa-solid fa-book-open w-5 text-emerald-600"></i>
          <span>Kurikulum</span>
        </a>

        <!-- 5. Gallery -->
        <a @click="mobileOpen = false" href="{{ route('galeri') }}" 
           class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
          <i class="fa-solid fa-images w-5 text-emerald-600"></i>
          <span>Gallery</span>
        </a>

        <!-- 6. Kontak -->
        <a @click="mobileOpen = false" href="{{ route('kontak') }}" 
           class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
          <i class="fa-solid fa-map-location-dot w-5 text-emerald-600"></i>
          <span>Kontak</span>
        </a>
      </nav>
    </div>

    <!-- Drawer Mobile CTA (Soft Rounded) -->
    <div class="pt-6 border-t border-slate-100">
      <a @click="mobileOpen = false" href="{{ route('ppdb') }}" 
         class="w-full flex items-center justify-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-xl shadow-md transition-colors border-b-2 border-emerald-950">
        <i class="fa-solid fa-graduation-cap text-amber-400"></i>
        <span>Daftar PPDB Online</span>
      </a>

      @if($contact)
        <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-xs">
          <a href="{{ $contact->getWaLink() }}" target="_blank" rel="noopener noreferrer"
             class="flex items-center gap-2.5 p-2.5 rounded-lg bg-emerald-50 text-emerald-800 font-semibold hover:bg-emerald-100 transition-colors">
            <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i>
            <span class="font-mono">{{ $contact->phone ?: $contact->whatsapp }}</span>
          </a>
          @if($contact->email)
            <a href="mailto:{{ $contact->email }}"
               class="flex items-center gap-2.5 p-2 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors">
              <i class="fa-regular fa-envelope text-slate-400"></i>
              <span class="truncate">{{ $contact->email }}</span>
            </a>
          @endif
        </div>
      @endif

      <p class="text-[11px] text-center text-slate-400 mt-3 font-mono">
        Tahun Ajaran 2026/2027
      </p>
    </div>

  </div>
</header>
<!-- Header Spacer -->
<div class="h-16 lg:h-20"></div>
