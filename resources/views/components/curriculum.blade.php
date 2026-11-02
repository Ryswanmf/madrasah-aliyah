<!-- Kurikulum Section (Green Backdrop with School / Santri Image Blend) -->
<section id="kurikulum" 
         class="py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900" 
         x-data="{ activeTab: 'kemenag' }">
  
  <!-- 1. Background Image & Islamic Green Gradient Overlay -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <!-- School & Santri Photo Background -->
    <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" 
         alt="Santri Belajar MA Darun Najah" 
         loading="lazy" decoding="async"
         class="w-full h-full object-cover object-center opacity-25 filter saturate-150">
    <!-- Rich Green Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/95 via-emerald-900/90 to-emerald-950"></div>
    <!-- Islamic Pattern Backdrop Overlay -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-12 text-center sm:text-left">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Program Pendidikan</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
        Kurikulum Terpadu & <span class="text-amber-400">Unggulan</span>
      </h2>
      <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
        Integrasi harmonis antara sains modern, keilmuan agama bersanad para ulama salaf, dan kecakapan kemandirian santri.
      </p>
    </div>

    <!-- Tab Navigation (Modern Green / Gold Tabs) -->
    <div class="flex flex-wrap gap-2 sm:gap-3 mb-10 border-b border-emerald-800/80 pb-3">
      <button @click="activeTab = 'kemenag'"
              :class="activeTab === 'kemenag' ? 'bg-amber-400 text-emerald-950 font-bold shadow-lg shadow-amber-400/20 border-b-2 border-amber-600' : 'bg-emerald-900/80 text-emerald-100 hover:bg-emerald-800 hover:text-white border border-emerald-700/60 font-medium'"
              class="px-5 py-3 rounded-lg text-xs sm:text-sm uppercase tracking-wider transition-all duration-200 flex items-center gap-2.5 cursor-pointer">
        <i class="fa-solid fa-graduation-cap" :class="activeTab === 'kemenag' ? 'text-emerald-950' : 'text-amber-400'"></i>
        <span>Kurikulum Kemenag & Nasional</span>
      </button>

      <button @click="activeTab = 'pesantren'"
              :class="activeTab === 'pesantren' ? 'bg-amber-400 text-emerald-950 font-bold shadow-lg shadow-amber-400/20 border-b-2 border-amber-600' : 'bg-emerald-900/80 text-emerald-100 hover:bg-emerald-800 hover:text-white border border-emerald-700/60 font-medium'"
              class="px-5 py-3 rounded-lg text-xs sm:text-sm uppercase tracking-wider transition-all duration-200 flex items-center gap-2.5 cursor-pointer">
        <i class="fa-solid fa-book-quran" :class="activeTab === 'pesantren' ? 'text-emerald-950' : 'text-amber-400'"></i>
        <span>Pesantren Salafiyah (Kitab Kuning)</span>
      </button>

      <button @click="activeTab = 'vokasi'"
              :class="activeTab === 'vokasi' ? 'bg-amber-400 text-emerald-950 font-bold shadow-lg shadow-amber-400/20 border-b-2 border-amber-600' : 'bg-emerald-900/80 text-emerald-100 hover:bg-emerald-800 hover:text-white border border-emerald-700/60 font-medium'"
              class="px-5 py-3 rounded-lg text-xs sm:text-sm uppercase tracking-wider transition-all duration-200 flex items-center gap-2.5 cursor-pointer">
        <i class="fa-solid fa-screwdriver-wrench" :class="activeTab === 'vokasi' ? 'text-emerald-950' : 'text-amber-400'"></i>
        <span>Vokasi & Keterampilan Santri</span>
      </button>
    </div>

    <!-- Tab Content 1: Kemenag -->
    <div x-show="activeTab === 'kemenag'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
        <div class="w-12 h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-xl mb-4">
          <i class="fa-solid fa-flask-vial"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Peminatan MIPA / Sains</h3>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
          Matematika terapan, Fisika, Kimia, dan Biologi dilengkapi praktikum laboratorium untuk persiapan kuliah di perguruan tinggi negeri maupun swasta.
        </p>
      </div>

      <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
        <div class="w-12 h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-xl mb-4">
          <i class="fa-solid fa-landmark"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Peminatan IPS / Sosial</h3>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
          Sosiologi, Ekonomi syariah, Geografi, dan Sejarah Nusantara yang menanamkan kesadaran sosial, kebangsaan, dan wirausaha.
        </p>
      </div>

      <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
        <div class="w-12 h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-xl mb-4">
          <i class="fa-solid fa-kaaba"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Peminatan Keagamaan Islam</h3>
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
          Al-Qur'an Hadits, Fiqih Ushul Fiqih, Akidah Akhlak, Bahasa Arab Intensif, dan Sejarah Kebudayaan Islam (SKI) standar Kemenag.
        </p>
      </div>

    </div>

    <!-- Tab Content 2: Pesantren -->
    <div x-show="activeTab === 'pesantren'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-cloak
         class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
      @php
        $kitabDisplay = ($homeCurricula ?? \App\Models\Curriculum::active()->get())->where('type', 'kitab')->take(3);
      @endphp

      @if($kitabDisplay->isNotEmpty())
        @foreach($kitabDisplay as $kitab)
          <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
            <div class="w-12 h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-xl mb-4">
              <i class="{{ $kitab->icon ?? 'fa-solid fa-book' }}"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-2 py-0.5 rounded inline-block mb-1">
              {{ $kitab->category_label ?? 'Kajian Salaf' }}
            </span>
            <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $kitab->title }}</h3>
            @if($kitab->author)
              <p class="text-xs text-amber-700 font-semibold mb-2">{{ $kitab->author }}</p>
            @endif
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
              {{ $kitab->description }}
            </p>
          </div>
        @endforeach
      @else
        <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
          <div class="w-12 h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-book"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-2">Gramatika Arab (Nahwu & Shorof)</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Kajian kitab matan Jurumiyah, Imrithi, hingga Alfiyah Ibnu Malik sebagai kunci membuka khazanah literatur kitab kuning klasik.
          </p>
        </div>

        <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
          <div class="w-12 h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-scale-balanced"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-2">Fiqih Madzhab Syafi'i</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Fathul Qorib, Safinatun Naja, Taqrib, dan Sullamul Munajat untuk bekal ibadah amaliah harian, muamalah, dan hukum Islam.
          </p>
        </div>

        <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-amber-500 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
          <div class="w-12 h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-heart"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-2">Akhlak & Tasawuf</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Ta'limul Muta'allim, Bidayatul Hidayah, dan Al-Washoya untuk pembentukan etika kesantrian, adab penuntut ilmu, dan ketulusan hati.
          </p>
        </div>
      @endif

    </div>

    <!-- Tab Content 3: Vokasi -->
    <div x-show="activeTab === 'vokasi'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-cloak
         class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
      @php
        $vokasiDisplay = ($homeCurricula ?? \App\Models\Curriculum::active()->get())->where('type', 'vokasi')->take(3);
      @endphp

      @if($vokasiDisplay->isNotEmpty())
        @foreach($vokasiDisplay as $vok)
          <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
            <div class="w-12 h-12 bg-sky-100 text-sky-800 border border-sky-200 rounded-lg flex items-center justify-center text-xl mb-4">
              <i class="{{ $vok->icon ?? 'fa-solid fa-laptop-code' }}"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-wider text-sky-800 bg-sky-100 px-2 py-0.5 rounded inline-block mb-1">
              {{ $vok->category_label ?? 'Kecakapan Santri' }}
            </span>
            <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $vok->title }}</h3>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
              {{ $vok->description }}
            </p>
          </div>
        @endforeach
      @else
        <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
          <div class="w-12 h-12 bg-sky-100 text-sky-800 border border-sky-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-laptop-code"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-2">Komputer & Literasi Digital</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Aplikasi perkantoran, pengetikan cepat bahasa Arab/Latin, dan desain grafis kreatif untuk media dakwah digital.
          </p>
        </div>

        <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
          <div class="w-12 h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-seedling"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-2">Pertanian & Kemandirian Pangan</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Edukasi budidaya tanaman dan pemanfaatan lahan produktif pesantren untuk membentuk etos kerja keras santri.
          </p>
        </div>

        <div class="bg-white text-slate-800 p-6 sm:p-7 border-t-4 border-sky-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
          <div class="w-12 h-12 bg-purple-100 text-purple-800 border border-purple-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-store"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 mb-2">Kewirausahaan Santri</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Praktik perniagaan islami di koperasi santri, manajemen kas kecil, dan keterampilan pembuatan produk bernilai tambah.
          </p>
        </div>
      @endif

    </div>

    <!-- Tombol Lihat Kurikulum Lengkap Lainnya -->
    <div class="mt-12 text-center">
      <a href="{{ route('kurikulum') }}" 
         class="inline-flex items-center gap-3 px-8 py-3.5 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-amber-400/20 hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-amber-600">
        <span>Lihat Kurikulum & Program Lengkap</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
      <p class="mt-3 text-xs text-emerald-200/80">
        Pelajari integrasi kurikulum Kemenag RI, jenjang kitab kuning salafiyah, program tahfidz Qur'an, dan vokasi kemandirian.
      </p>
    </div>

  </div>
</section>
