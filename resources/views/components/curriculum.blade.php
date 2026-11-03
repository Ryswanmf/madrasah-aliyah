<!-- Kurikulum Section (Green Backdrop with School / Siswa/i Image Blend) -->
<section id="kurikulum" 
         class="py-12 sm:py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900" 
         x-data="{ activeTab: 'kemenag' }">
  
  <!-- 1. Background Image & Islamic Green Gradient Overlay -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <!-- School & Siswa/i Photo Background -->
    <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" 
         alt="Siswa/i Belajar MA Darun Najah" 
         loading="lazy" decoding="async"
         class="w-full h-full object-cover object-center opacity-25 filter saturate-150">
    <!-- Rich Green Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/95 via-emerald-900/90 to-emerald-950"></div>
    <!-- Islamic Pattern Backdrop Overlay -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-8 sm:mb-12 text-center sm:text-left">
      <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 bg-emerald-900/90 text-amber-300 text-[10px] sm:text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-3 sm:mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Program Pendidikan</span>
      </div>
      <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
        Kurikulum Terpadu & <span class="text-amber-400">Unggulan</span>
      </h2>
      <p class="mt-2.5 sm:mt-4 text-xs sm:text-base lg:text-lg text-emerald-100/90 leading-relaxed">
        Integrasi harmonis antara kurikulum nasional Kemenag RI, keilmuan agama Islam Ahlussunnah wal Jama'ah, dan kecakapan kemandirian siswa/i.
      </p>
    </div>

    <!-- Tab Navigation (Modern Green / Gold Tabs) -->
    <div class="flex flex-wrap gap-1.5 sm:gap-3 mb-6 sm:mb-10 border-b border-emerald-800/80 pb-3">
      <button @click="activeTab = 'kemenag'"
              :class="activeTab === 'kemenag' ? 'bg-amber-400 text-emerald-950 font-bold shadow-lg shadow-amber-400/20 border-b-2 border-amber-600' : 'bg-emerald-900/80 text-emerald-100 hover:bg-emerald-800 hover:text-white border border-emerald-700/60 font-medium'"
              class="px-3 sm:px-5 py-2 sm:py-3 rounded-lg text-[10px] sm:text-xs uppercase tracking-wider transition-all duration-200 flex items-center gap-1.5 sm:gap-2.5 cursor-pointer">
        <i class="fa-solid fa-graduation-cap text-xs" :class="activeTab === 'kemenag' ? 'text-emerald-950' : 'text-amber-400'"></i>
        <span>Kemenag & Nasional</span>
      </button>

      <button @click="activeTab = 'pesantren'"
              :class="activeTab === 'pesantren' ? 'bg-amber-400 text-emerald-950 font-bold shadow-lg shadow-amber-400/20 border-b-2 border-amber-600' : 'bg-emerald-900/80 text-emerald-100 hover:bg-emerald-800 hover:text-white border border-emerald-700/60 font-medium'"
              class="px-3 sm:px-5 py-2 sm:py-3 rounded-lg text-[10px] sm:text-xs uppercase tracking-wider transition-all duration-200 flex items-center gap-1.5 sm:gap-2.5 cursor-pointer">
        <i class="fa-solid fa-book-quran text-xs" :class="activeTab === 'pesantren' ? 'text-emerald-950' : 'text-amber-400'"></i>
        <span>Kitab Kuning Salaf</span>
      </button>

      <button @click="activeTab = 'vokasi'"
              :class="activeTab === 'vokasi' ? 'bg-amber-400 text-emerald-950 font-bold shadow-lg shadow-amber-400/20 border-b-2 border-amber-600' : 'bg-emerald-900/80 text-emerald-100 hover:bg-emerald-800 hover:text-white border border-emerald-700/60 font-medium'"
              class="px-3 sm:px-5 py-2 sm:py-3 rounded-lg text-[10px] sm:text-xs uppercase tracking-wider transition-all duration-200 flex items-center gap-1.5 sm:gap-2.5 cursor-pointer">
        <i class="fa-solid fa-screwdriver-wrench text-xs" :class="activeTab === 'vokasi' ? 'text-emerald-950' : 'text-amber-400'"></i>
        <span>Vokasi & Keterampilan</span>
      </button>
    </div>

    <!-- Tab Content 1: Kemenag (2 Columns Mobile, 3 Columns Desktop) -->
    <div x-show="activeTab === 'kemenag'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
      
      <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
        <div>
          <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
            <i class="fa-solid fa-flask-vial"></i>
          </div>
          <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Peminatan MIPA / Sains</h3>
          <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
            Matematika terapan, Fisika, Kimia, dan Biologi dilengkapi praktikum laboratorium untuk persiapan kuliah di perguruan tinggi negeri maupun swasta.
          </p>
        </div>
      </div>

      <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
        <div>
          <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
            <i class="fa-solid fa-landmark"></i>
          </div>
          <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Peminatan IPS / Sosial</h3>
          <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
            Sosiologi, Ekonomi syariah, Geografi, dan Sejarah Nusantara yang menanamkan kesadaran sosial, kebangsaan, dan wirausaha.
          </p>
        </div>
      </div>

      <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between col-span-2 md:col-span-1">
        <div>
          <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
            <i class="fa-solid fa-kaaba"></i>
          </div>
          <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Peminatan Keagamaan Islam</h3>
          <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
            Al-Qur'an Hadits, Fiqih Ushul Fiqih, Akidah Akhlak, Bahasa Arab Intensif, dan Sejarah Kebudayaan Islam (SKI) standar Kemenag.
          </p>
        </div>
      </div>

    </div>

    <!-- Tab Content 2: Pesantren (2 Columns Mobile, 3 Columns Desktop) -->
    <div x-show="activeTab === 'pesantren'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-cloak
         class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
      
      @php
        $kitabDisplay = ($homeCurricula ?? \App\Models\Curriculum::active()->get())->where('type', 'kitab')->take(3);
      @endphp

      @if($kitabDisplay->isNotEmpty())
        @foreach($kitabDisplay as $kitab)
          <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between {{ $loop->last && $loop->count % 2 != 0 ? 'col-span-2 md:col-span-1' : '' }}">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                <i class="{{ $kitab->icon ?? 'fa-solid fa-book' }}"></i>
              </div>
              <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-1.5 py-0.5 rounded inline-block mb-1">
                {{ $kitab->category_label ?? 'Kajian Salaf' }}
              </span>
              <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">{{ $kitab->title }}</h3>
              @if($kitab->author)
                <p class="text-[10px] sm:text-xs text-amber-700 font-semibold mb-1 sm:mb-2 truncate">{{ $kitab->author }}</p>
              @endif
              <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                {{ $kitab->description }}
              </p>
            </div>
          </div>
        @endforeach
      @else
        <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
          <div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
              <i class="fa-solid fa-book"></i>
            </div>
            <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Nahwu & Shorof</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
              Kajian kitab matan Jurumiyah, Imrithi, hingga Alfiyah Ibnu Malik sebagai kunci membuka khazanah literatur kitab kuning klasik.
            </p>
          </div>
        </div>

        <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
          <div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
              <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Fiqih Madzhab Syafi'i</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
              Fathul Qorib, Safinatun Naja, Taqrib, dan Sullamul Munajat untuk bekal ibadah amaliah harian, muamalah, dan hukum Islam.
            </p>
          </div>
        </div>

        <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between col-span-2 md:col-span-1">
          <div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
              <i class="fa-solid fa-heart"></i>
            </div>
            <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Akhlak & Tasawuf</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
              Ta'limul Muta'allim, Bidayatul Hidayah, dan Al-Washoya untuk pembentukan etika kepribadian Islami dan adab penuntut ilmu.
            </p>
          </div>
        </div>
      @endif

    </div>

    <!-- Tab Content 3: Vokasi (2 Columns Mobile, 3 Columns Desktop) -->
    <div x-show="activeTab === 'vokasi'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-cloak
         class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
      
      @php
        $vokasiDisplay = ($homeCurricula ?? \App\Models\Curriculum::active()->get())->where('type', 'vokasi')->take(3);
      @endphp

      @if($vokasiDisplay->isNotEmpty())
        @foreach($vokasiDisplay as $vok)
          <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between {{ $loop->last && $loop->count % 2 != 0 ? 'col-span-2 md:col-span-1' : '' }}">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-sky-100 text-sky-800 border border-sky-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                <i class="{{ $vok->icon ?? 'fa-solid fa-laptop-code' }}"></i>
              </div>
              <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-sky-800 bg-sky-100 px-1.5 py-0.5 rounded inline-block mb-1">
                {{ $vok->category_label ?? 'Kecakapan Siswa' }}
              </span>
              <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">{{ $vok->title }}</h3>
              <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                {{ $vok->description }}
              </p>
            </div>
          </div>
        @endforeach
      @else
        <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
          <div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-sky-100 text-sky-800 border border-sky-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
              <i class="fa-solid fa-laptop-code"></i>
            </div>
            <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Komputer & Literasi Digital</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
              Aplikasi perkantoran, pengetikan cepat bahasa Arab/Latin, dan desain grafis kreatif untuk media dakwah digital.
            </p>
          </div>
        </div>

        <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
          <div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
              <i class="fa-solid fa-seedling"></i>
            </div>
            <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Pertanian & Pangan</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
              Edukasi budidaya tanaman dan pemanfaatan lahan produktif madrasah untuk membentuk etos kerja keras siswa/i.
            </p>
          </div>
        </div>

        <div class="bg-white text-slate-800 p-3.5 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between col-span-2 md:col-span-1">
          <div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-purple-100 text-purple-800 border border-purple-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
              <i class="fa-solid fa-store"></i>
            </div>
            <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Kewirausahaan Siswa</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
              Praktik perniagaan islami di koperasi madrasah, manajemen kas kecil, dan kreasi produk bernilai jual.
            </p>
          </div>
        </div>
      @endif

    </div>

    <!-- Tombol Lihat Kurikulum Lengkap Lainnya -->
    <div class="mt-8 sm:mt-12 text-center">
      <a href="{{ route('kurikulum') }}" 
         class="inline-flex items-center gap-2.5 sm:gap-3 px-6 sm:px-8 py-3 sm:py-3.5 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-amber-400/20 hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-amber-600">
        <span>Lihat Kurikulum & Program Lengkap</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
      <p class="mt-2.5 sm:mt-3 text-xs text-emerald-200/80">
        Pelajari integrasi kurikulum Kemenag RI, jenjang kitab kuning salafiyah, program tahfidz Qur'an, dan vokasi kemandirian.
      </p>
    </div>

  </div>
</section>
