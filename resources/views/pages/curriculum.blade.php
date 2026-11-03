@extends('layouts.app')

@section('title', 'Kurikulum Terpadu & Program Unggulan • Madrasah Aliyah Darun Najah')

@section('content')
<!-- Curriculum Page Container -->
<div class="bg-slate-50 min-h-screen" 
     x-data="{ 
       activePillar: 'kemenag',
       activeGrade: '10'
     }">

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" 
           alt="Kurikulum MA Darun Najah" 
           class="w-full h-full object-cover object-center opacity-20 filter saturate-150">
      <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/95 via-emerald-900/90 to-emerald-950"></div>
      <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Breadcrumb -->
      <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-emerald-200/80 mb-6">
        <a href="{{ url('/') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
          <i class="fa-solid fa-house text-[11px]"></i>
          <span>Beranda</span>
        </a>
        <span class="text-emerald-700">/</span>
        <span class="text-amber-300">Kurikulum Pendidikan</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Integrasi Holistik Sains & Agama</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Struktur Kurikulum & <span class="text-amber-400">Program Unggulan</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Mengintegrasikan kurikulum resmi Kementerian Agama RI, pengkajian kitab kuning salafiyah bersanad ulama, program tahfidz Al-Qur'an, dan kecakapan vokasi praktis siswa/i.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Four Main Pillars Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Section Title -->
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
          Landasan Kurikulum
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
          4 Pilar Pendidikan Madrasah Aliyah Darun Najah
        </h2>
        <p class="mt-2 text-xs sm:text-sm text-slate-600">
          Dirancang untuk melahirkan generasi mutafaqqih fiddin yang berwawasan ilmiah, berakhlak mulia, dan mandiri.
        </p>
      </div>

      <!-- 4 Pillars Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-12 sm:mb-16">
        @php
          $colors = [
            ['border' => 'border-emerald-600', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-800', 'border_icon' => 'border-emerald-200', 'check' => 'text-emerald-600'],
            ['border' => 'border-amber-500', 'bg' => 'bg-amber-50', 'text' => 'text-amber-800', 'border_icon' => 'border-amber-200', 'check' => 'text-amber-600'],
            ['border' => 'border-sky-600', 'bg' => 'bg-sky-50', 'text' => 'text-sky-800', 'border_icon' => 'border-sky-200', 'check' => 'text-sky-600'],
            ['border' => 'border-purple-600', 'bg' => 'bg-purple-50', 'text' => 'text-purple-800', 'border_icon' => 'border-purple-200', 'check' => 'text-purple-600'],
          ];
        @endphp

        @if(isset($pillars) && $pillars->isNotEmpty())
          @foreach($pillars as $index => $pillar)
            @php $theme = $colors[$index % 4]; @endphp
            <div class="bg-white p-3.5 sm:p-6 border-t-4 {{ $theme['border'] }} border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
              <div>
                <div class="w-9 h-9 sm:w-12 sm:h-12 {{ $theme['bg'] }} {{ $theme['text'] }} border {{ $theme['border_icon'] }} rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                  <i class="{{ $pillar->icon ?? 'fa-solid fa-graduation-cap' }}"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-xs sm:text-base mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">{{ $pillar->title }}</h3>
                <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                  {{ $pillar->description }}
                </p>
              </div>
              @if(!empty($pillar->points) && is_array($pillar->points))
                <ul class="mt-2.5 sm:mt-3 space-y-0.5 sm:space-y-1 text-[10px] sm:text-xs text-slate-500 border-t border-slate-100 pt-2 sm:pt-3">
                  @foreach($pillar->points as $pt)
                    <li class="flex items-center gap-1 sm:gap-1.5">
                      <i class="fa-solid fa-check {{ $theme['check'] }} text-[9px] sm:text-[10px] shrink-0"></i>
                      <span class="truncate">{{ $pt }}</span>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
          @endforeach
        @else
          <!-- Fallback Pillar 1 -->
          <div class="bg-white p-3.5 sm:p-6 border-t-4 border-emerald-600 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-xs sm:text-base mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">1. Kurikulum Kemenag</h3>
              <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                Standar kurikulum nasional terakreditasi mencakup sains, sosial humaniora, dan rumpun Pendidikan Agama Islam (PAI).
              </p>
            </div>
            <ul class="mt-2.5 sm:mt-3 space-y-0.5 sm:space-y-1 text-[10px] sm:text-xs text-slate-500 border-t border-slate-100 pt-2 sm:pt-3">
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Peminatan MIPA / Sains</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Peminatan IPS / Sosial</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Rumpun PAI & Bahasa Arab</span></li>
            </ul>
          </div>

          <!-- Fallback Pillar 2 -->
          <div class="bg-white p-3.5 sm:p-6 border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-amber-50 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                <i class="fa-solid fa-book-quran"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-xs sm:text-base mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">2. Pesantren Salafiyah</h3>
              <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                Pengkajian literatur kitab kuning (turats) bersanad madzhab Syafi'i dengan metode sorogan, bandongan, dan musyawarah halaqoh.
              </p>
            </div>
            <ul class="mt-2.5 sm:mt-3 space-y-0.5 sm:space-y-1 text-[10px] sm:text-xs text-slate-500 border-t border-slate-100 pt-2 sm:pt-3">
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-amber-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Gramatika Nahwu & Shorof</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-amber-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Fiqih Syafi'iyyah Klasik</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-amber-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Akhlakul Karimah & Tasawuf</span></li>
            </ul>
          </div>

          <!-- Fallback Pillar 3 -->
          <div class="bg-white p-3.5 sm:p-6 border-t-4 border-sky-600 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-sky-50 text-sky-800 border border-sky-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                <i class="fa-solid fa-kaaba"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-xs sm:text-base mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">3. Tahfidzul Qur'an</h3>
              <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                Program hafalan Al-Qur'an bersanad dengan bimbingan tajwid makharijul huruf, talaqqi harian, dan mutaba'ah setoran intensif.
              </p>
            </div>
            <ul class="mt-2.5 sm:mt-3 space-y-0.5 sm:space-y-1 text-[10px] sm:text-xs text-slate-500 border-t border-slate-100 pt-2 sm:pt-3">
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-sky-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Beasiswa Tahfidz 3 Juz</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-sky-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Talaqqi & Muroja'ah</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-sky-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Khotmil Qur'an Bil Ghoib</span></li>
            </ul>
          </div>

          <!-- Fallback Pillar 4 -->
          <div class="bg-white p-3.5 sm:p-6 border-t-4 border-purple-600 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-purple-50 text-purple-800 border border-purple-200 rounded-lg flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-4 shrink-0">
                <i class="fa-solid fa-screwdriver-wrench"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-xs sm:text-base mb-1 sm:mb-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">4. Vokasi Kemandirian</h3>
              <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-none">
                Pembekalan keterampilan terapan guna menyiapkan siswa/i yang tangguh, produktif, dan memiliki kecakapan hidup modern.
              </p>
            </div>
            <ul class="mt-2.5 sm:mt-3 space-y-0.5 sm:space-y-1 text-[10px] sm:text-xs text-slate-500 border-t border-slate-100 pt-2 sm:pt-3">
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-purple-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Literasi Digital Siswa/i</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-purple-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Kewirausahaan Mandiri</span></li>
              <li class="flex items-center gap-1 sm:gap-1.5"><i class="fa-solid fa-check text-purple-600 text-[9px] sm:text-[10px] shrink-0"></i> <span class="truncate">Manajemen Koperasi</span></li>
            </ul>
          </div>
        @endif

      </div>

      <!-- 3. Detail Kurikulum Pesantren (Kajian Kitab Kuning Berjenjang) -->
      <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm mb-16">
        <div class="max-w-3xl mb-8">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 text-amber-800 text-xs font-bold uppercase tracking-wider rounded-md mb-2 border border-amber-200">
            <i class="fa-solid fa-book-open"></i>
            <span>Kurikulum Salafiyah Berjenjang</span>
          </div>
          <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900">
            Daftar Kitab Turats yang Dipelajari per Tingkat
          </h3>
          <p class="text-xs sm:text-sm text-slate-600 mt-1">
            Materi kitab kuning diajarkan secara terstruktur dari tingkat dasar hingga tingkat mahir di bawah asuhan para Asatidz dan Masyayikh.
          </p>
        </div>

        <!-- Grade Navigation Tabs -->
        <div class="flex flex-wrap gap-2 mb-6 border-b border-slate-200 pb-3">
          <button @click="activeGrade = '10'" 
                  :class="activeGrade === '10' ? 'bg-emerald-800 text-white font-bold shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                  class="px-5 py-2.5 rounded-lg text-xs uppercase tracking-wider transition-colors cursor-pointer">
            Tingkat Kelas X (Ula)
          </button>
          <button @click="activeGrade = '11'" 
                  :class="activeGrade === '11' ? 'bg-emerald-800 text-white font-bold shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                  class="px-5 py-2.5 rounded-lg text-xs uppercase tracking-wider transition-colors cursor-pointer">
            Tingkat Kelas XI (Wustha)
          </button>
          <button @click="activeGrade = '12'" 
                  :class="activeGrade === '12' ? 'bg-emerald-800 text-white font-bold shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium'"
                  class="px-5 py-2.5 rounded-lg text-xs uppercase tracking-wider transition-colors cursor-pointer">
            Tingkat Kelas XII (Ulya)
          </button>
        </div>

        <!-- Content Kelas X: 2 Columns Mobile (2 2), 3 Columns Desktop -->
        <div x-show="activeGrade === '10'" class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
          @if(isset($grade10) && $grade10->isNotEmpty())
            @foreach($grade10 as $kitab)
              <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-1">
                    <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-1.5 py-0.5 rounded truncate max-w-[80%]">
                      {{ $kitab->category_label ?? 'Kajian Salaf' }}
                    </span>
                    @if($kitab->icon)
                      <i class="{{ $kitab->icon }} text-slate-400 text-xs"></i>
                    @endif
                  </div>
                  <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">{{ $kitab->title }}</h4>
                  @if($kitab->author)
                    <p class="text-[10px] sm:text-[11px] text-amber-700 font-medium mt-0.5 truncate">{{ $kitab->author }}</p>
                  @endif
                  <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">{{ $kitab->description }}</p>
                </div>
                @if(!empty($kitab->points) && is_array($kitab->points))
                  <ul class="mt-2 sm:mt-2.5 pt-2 border-t border-slate-200/60 space-y-0.5 sm:space-y-1">
                    @foreach($kitab->points as $pt)
                      <li class="flex items-center gap-1 sm:gap-1.5 text-[10px] sm:text-[11px] text-slate-500">
                        <i class="fa-solid fa-check text-emerald-600 text-[8px] sm:text-[9px] shrink-0"></i>
                        <span class="truncate">{{ $pt }}</span>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>
            @endforeach
          @else
            <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl flex flex-col justify-between">
              <div>
                <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-1.5 py-0.5 rounded">Nahwu & Kaidah Arab</span>
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Matan Al-Jurumiyyah</h4>
                <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">Karya Syaikh Ash-Shanhaji. Fondasi tata bahasa Arab, i'rob kalimat, dan struktur kata dasar.</p>
              </div>
            </div>
            <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl flex flex-col justify-between">
              <div>
                <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-1.5 py-0.5 rounded">Fiqih Ibadah Dasar</span>
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Safinatun Najah</h4>
                <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">Karya Syaikh Salim bin Samir Al-Hadhrami. Kaidah bersuci (thaharah), sholat, dan puasa.</p>
              </div>
            </div>
          @endif
        </div>

        <!-- Content Kelas XI: 2 Columns Mobile (2 2), 3 Columns Desktop -->
        <div x-show="activeGrade === '11'" x-cloak class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
          @if(isset($grade11) && $grade11->isNotEmpty())
            @foreach($grade11 as $kitab)
              <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-1">
                    <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-1.5 py-0.5 rounded truncate max-w-[80%]">
                      {{ $kitab->category_label ?? 'Kajian Salaf' }}
                    </span>
                    @if($kitab->icon)
                      <i class="{{ $kitab->icon }} text-slate-400 text-xs"></i>
                    @endif
                  </div>
                  <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">{{ $kitab->title }}</h4>
                  @if($kitab->author)
                    <p class="text-[10px] sm:text-[11px] text-amber-700 font-medium mt-0.5 truncate">{{ $kitab->author }}</p>
                  @endif
                  <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">{{ $kitab->description }}</p>
                </div>
                @if(!empty($kitab->points) && is_array($kitab->points))
                  <ul class="mt-2 sm:mt-2.5 pt-2 border-t border-slate-200/60 space-y-0.5 sm:space-y-1">
                    @foreach($kitab->points as $pt)
                      <li class="flex items-center gap-1 sm:gap-1.5 text-[10px] sm:text-[11px] text-slate-500">
                        <i class="fa-solid fa-check text-amber-600 text-[8px] sm:text-[9px] shrink-0"></i>
                        <span class="truncate">{{ $pt }}</span>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>
            @endforeach
          @else
            <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl flex flex-col justify-between">
              <div>
                <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-1.5 py-0.5 rounded">Nahwu Menengah</span>
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Nazhom Al-Imrithi</h4>
                <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">Karya Syaikh Syarafuddin Yahya Al-Imrithi. Syair kaidah nahwu tingkat menengah dan pendalaman i'rob.</p>
              </div>
            </div>
          @endif
        </div>

        <!-- Content Kelas XII: 2 Columns Mobile (2 2), 3 Columns Desktop -->
        <div x-show="activeGrade === '12'" x-cloak class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
          @if(isset($grade12) && $grade12->isNotEmpty())
            @foreach($grade12 as $kitab)
              <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl hover:shadow-sm transition-all flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-1">
                    <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-sky-800 bg-sky-100 px-1.5 py-0.5 rounded truncate max-w-[80%]">
                      {{ $kitab->category_label ?? 'Kajian Salaf' }}
                    </span>
                    @if($kitab->icon)
                      <i class="{{ $kitab->icon }} text-slate-400 text-xs"></i>
                    @endif
                  </div>
                  <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">{{ $kitab->title }}</h4>
                  @if($kitab->author)
                    <p class="text-[10px] sm:text-[11px] text-amber-700 font-medium mt-0.5 truncate">{{ $kitab->author }}</p>
                  @endif
                  <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">{{ $kitab->description }}</p>
                </div>
                @if(!empty($kitab->points) && is_array($kitab->points))
                  <ul class="mt-2 sm:mt-2.5 pt-2 border-t border-slate-200/60 space-y-0.5 sm:space-y-1">
                    @foreach($kitab->points as $pt)
                      <li class="flex items-center gap-1 sm:gap-1.5 text-[10px] sm:text-[11px] text-slate-500">
                        <i class="fa-solid fa-check text-sky-600 text-[8px] sm:text-[9px] shrink-0"></i>
                        <span class="truncate">{{ $pt }}</span>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>
            @endforeach
          @else
            <div class="p-3 sm:p-4 bg-slate-50 border border-slate-200 rounded-xl flex flex-col justify-between">
              <div>
                <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-1.5 py-0.5 rounded">Nahwu Tingkat Tinggi</span>
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 mt-1.5 sm:mt-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-auto">Alfiyyah Ibnu Malik</h4>
                <p class="text-[10px] sm:text-xs text-slate-600 mt-1 leading-relaxed line-clamp-3 sm:line-clamp-none">Karya Syaikh Muhammad bin Malik. Seribu bait syair kaidah gramatika Arab klasik tingkat tinggi.</p>
              </div>
            </div>
          @endif
        </div>
      </div>

      <!-- 4. Rutinitas Pembiasaan Amaliah Siswa/i -->
      <div class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 mb-16">
        <div class="max-w-3xl mb-8">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-2 border border-amber-400/30">
            <i class="fa-solid fa-hands-praying"></i>
            <span>Pendidikan Karakter & Spiritualitas</span>
          </div>
          <h3 class="text-xl sm:text-2xl font-extrabold text-white">
            Program Pembiasaan Amaliah Harian & Mingguan
          </h3>
          <p class="text-xs sm:text-sm text-emerald-100/90 mt-1">
            Menanamkan kedisiplinan ibadah dan karakter siswa/i melalui rutinitas spiritual yang konsisten.
          </p>
        </div>

        <!-- Amaliah Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
          <div class="bg-emerald-900/60 p-3.5 sm:p-4 rounded-xl border border-emerald-700/60 flex flex-col justify-between">
            <div>
              <div class="text-amber-400 text-xl sm:text-2xl mb-1.5 sm:mb-2"><i class="fa-solid fa-sun"></i></div>
              <h4 class="font-bold text-xs sm:text-sm text-white leading-tight">Sholat Dhuha Harian</h4>
              <p class="text-[10px] sm:text-xs text-emerald-200/90 mt-1 leading-relaxed">Dilaksanakan berjamaah setiap pagi sebelum jam pelajaran madrasah dimulai.</p>
            </div>
          </div>

          <div class="bg-emerald-900/60 p-3.5 sm:p-4 rounded-xl border border-emerald-700/60 flex flex-col justify-between">
            <div>
              <div class="text-amber-400 text-xl sm:text-2xl mb-1.5 sm:mb-2"><i class="fa-solid fa-moon"></i></div>
              <h4 class="font-bold text-xs sm:text-sm text-white leading-tight">Qiyamul Lail & Subuh</h4>
              <p class="text-[10px] sm:text-xs text-emerald-200/90 mt-1 leading-relaxed">Sholat tahajud, witir, dan sholat subuh berjamaah dilanjutkan wirid Ratib Al-Haddad.</p>
            </div>
          </div>

          <div class="bg-emerald-900/60 p-3.5 sm:p-4 rounded-xl border border-emerald-700/60 flex flex-col justify-between">
            <div>
              <div class="text-amber-400 text-xl sm:text-2xl mb-1.5 sm:mb-2"><i class="fa-solid fa-microphone"></i></div>
              <h4 class="font-bold text-xs sm:text-sm text-white leading-tight">Khitobah 3 Bahasa</h4>
              <p class="text-[10px] sm:text-xs text-emerald-200/90 mt-1 leading-relaxed">Latihan pidato mingguan dalam bahasa Arab, Inggris, dan Indonesia untuk melatih mental.</p>
            </div>
          </div>

          <div class="bg-emerald-900/60 p-3.5 sm:p-4 rounded-xl border border-emerald-700/60 flex flex-col justify-between">
            <div>
              <div class="text-amber-400 text-xl sm:text-2xl mb-1.5 sm:mb-2"><i class="fa-solid fa-users-rectangle"></i></div>
              <h4 class="font-bold text-xs sm:text-sm text-white leading-tight">Musyawarah Halaqoh</h4>
              <p class="text-[10px] sm:text-xs text-emerald-200/90 mt-1 leading-relaxed">Diskusi keagamaan dan kajian ilmiah siswa/i membahas ibadah amaliah dan fikih kontemporer.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. Profil Kelulusan (Output Alumni) -->
      <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm mb-12">
        <div class="text-center max-w-2xl mx-auto mb-8">
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
            Target Capaian
          </span>
          <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-3">
            Profil Lulusan Madrasah Aliyah Darun Najah
          </h3>
          <p class="mt-2 text-xs sm:text-sm text-slate-600">
            Standar kompetensi dan keunggulan yang dimiliki setiap siswa/i setelah menuntaskan pendidikan.
          </p>
        </div>

        <!-- Profil Kelulusan Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
          <div class="p-3.5 sm:p-5 rounded-xl bg-slate-50 border border-slate-200 text-center flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-base sm:text-xl mx-auto mb-2 sm:mb-3 font-bold shrink-0">1</div>
              <h4 class="font-bold text-xs sm:text-sm text-slate-900 leading-tight">Lanjut Kuliah PTN/PTKIN</h4>
              <p class="text-[10px] sm:text-xs text-slate-500 mt-1 leading-relaxed">Mampu bersaing menembus perguruan tinggi negeri favorit maupun beasiswa Timur Tengah.</p>
            </div>
          </div>

          <div class="p-3.5 sm:p-5 rounded-xl bg-slate-50 border border-slate-200 text-center flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-base sm:text-xl mx-auto mb-2 sm:mb-3 font-bold shrink-0">2</div>
              <h4 class="font-bold text-xs sm:text-sm text-slate-900 leading-tight">Kecakapan Baca Kitab</h4>
              <p class="text-[10px] sm:text-xs text-slate-500 mt-1 leading-relaxed">Menguasai dasar gramatika Arab dan mampu membaca serta memahami kitab turats kuning gundul.</p>
            </div>
          </div>

          <div class="p-3.5 sm:p-5 rounded-xl bg-slate-50 border border-slate-200 text-center flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 rounded-full bg-sky-100 text-sky-800 flex items-center justify-center text-base sm:text-xl mx-auto mb-2 sm:mb-3 font-bold shrink-0">3</div>
              <h4 class="font-bold text-xs sm:text-sm text-slate-900 leading-tight">Integritas Akhlakul Karimah</h4>
              <p class="text-[10px] sm:text-xs text-slate-500 mt-1 leading-relaxed">Memiliki sopan santun, ketawadhu'an kepada orang tua dan guru, serta kepedulian sosial tinggi.</p>
            </div>
          </div>

          <div class="p-3.5 sm:p-5 rounded-xl bg-slate-50 border border-slate-200 text-center flex flex-col justify-between">
            <div>
              <div class="w-9 h-9 sm:w-12 sm:h-12 rounded-full bg-purple-100 text-purple-800 flex items-center justify-center text-base sm:text-xl mx-auto mb-2 sm:mb-3 font-bold shrink-0">4</div>
              <h4 class="font-bold text-xs sm:text-sm text-slate-900 leading-tight">Keterampilan Hidup & TIK</h4>
              <p class="text-[10px] sm:text-xs text-slate-500 mt-1 leading-relaxed">Mampu mengoperasikan komputer, memanfaatkan internet positif, dan memiliki etos wirausaha mandiri.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 6. CTA Card -->
      <div class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Penerimaan Siswa/i Baru (PPDB)</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Siap Mengembangkan Potensi Ilmiah & Karakter Siswa/i?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Daftarkan putra-putri Anda sekarang di MA Darun Najah Sambikarto secara online 24 jam atau hubungi tim sekretariat kami.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ url('/') }}#ppdb" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Daftar PPDB Online</span>
            </a>

            <a href="{{ route('faq') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-solid fa-circle-question"></i>
              <span>Lihat FAQ Biaya & Asrama</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
