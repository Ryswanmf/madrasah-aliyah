@extends('layouts.app')

@section('title', 'Ekstrakurikuler & Pengembangan Bakat Siswa/i • Madrasah Aliyah Darun Najah')

@section('content')
<!-- Extracurricular Page Container -->
<div class="bg-slate-50 min-h-screen">

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg') }}" 
           alt="Aktivitas Ekstrakurikuler MA Darun Najah" 
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
        <span class="text-amber-300">Ekstrakulikuler Siswa/i</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Pengembangan Bakat, Seni & Kepemimpinan</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Ekstrakurikuler & <span class="text-amber-400">Potensi Siswa/i</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Wadah menyalurkan minat, mengasah kecakapan kepemimpinan, melestarikan seni budaya Islam, membina ketangguhan fisik bela diri, dan membekali kemandirian siswa/i MA Darun Najah Sambikarto.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Main Extracurricular Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Category Filter Tabs (Soft Rounded Style with Link Navigation) -->
      <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-200">
        <div class="flex flex-wrap gap-2 sm:gap-2.5">
          <a href="{{ route('ekstrakulikuler', ['kategori' => 'all']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? 'all') === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>Semua Ekstrakurikuler</span>
          </a>

          <a href="{{ route('ekstrakulikuler', ['kategori' => 'seni']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'seni' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-drum"></i>
            <span>Seni Islami & Bahasa</span>
          </a>

          <a href="{{ route('ekstrakulikuler', ['kategori' => 'olahraga']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'olahraga' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Olahraga & Bela Diri</span>
          </a>

          <a href="{{ route('ekstrakulikuler', ['kategori' => 'organisasi']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'organisasi' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-campground"></i>
            <span>Kepanduan & Organisasi</span>
          </a>

          <a href="{{ route('ekstrakulikuler', ['kategori' => 'vokasi']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'vokasi' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-laptop-code"></i>
            <span>TIK & Keterampilan</span>
          </a>
        </div>

        @if(isset($extracurriculars) && $extracurriculars->total() > 0)
        <div class="text-xs text-slate-500 font-medium">
          Total: <strong class="text-emerald-900">{{ $extracurriculars->total() }}</strong> Ekstrakurikuler
        </div>
        @endif
      </div>

      <!-- Grid of Extracurricular Cards (Mobile: 2 Kolom, Tablet: 2 Kolom, Desktop: 3 Kolom) -->
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
        @forelse($extracurriculars ?? [] as $item)
        @php
          $theme = $item->color_theme;
        @endphp
        <div class="bg-white border-t-4 {{ $theme['border'] }} border-x border-b border-slate-200 rounded-xl p-3.5 sm:p-6 shadow-xs hover:shadow-xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
          <div>
            <!-- Card Header: Icon & Badge -->
            <div class="flex items-center justify-between gap-2 mb-3 sm:mb-4">
              <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg flex items-center justify-center text-lg sm:text-xl shadow-xs shrink-0 {{ $theme['icon_bg'] }}">
                <i class="{{ $item->display_icon }}"></i>
              </div>
              @if($item->badge)
              <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-md max-w-[60%] truncate {{ $theme['badge'] }}">
                {{ $item->badge }}
              </span>
              @endif
            </div>

            <!-- Card Title & Description -->
            <h3 class="text-xs sm:text-base lg:text-lg font-bold text-slate-900 mb-1.5 sm:mb-2 leading-snug line-clamp-2">
              {{ $item->name }}
            </h3>
            <p class="text-[11px] sm:text-xs lg:text-sm text-slate-600 leading-relaxed line-clamp-3 sm:line-clamp-4">
              {{ $item->description }}
            </p>
          </div>

          <!-- Card Footer: Schedule & Coach -->
          <div class="mt-4 sm:mt-6 pt-3 sm:pt-4 border-t border-slate-100 space-y-1 sm:space-y-1.5 text-[10px] sm:text-xs text-slate-500">
            @if($item->schedule)
            <div class="flex items-center gap-1.5 sm:gap-2">
              <i class="fa-regular fa-clock text-emerald-700 w-3.5 shrink-0 text-[10px] sm:text-xs"></i>
              <span class="truncate">{{ $item->schedule }}</span>
            </div>
            @endif
            @if($item->coach)
            <div class="flex items-center gap-1.5 sm:gap-2">
              <i class="fa-solid fa-user-check text-amber-600 w-3.5 shrink-0 text-[10px] sm:text-xs"></i>
              <span class="truncate">{{ $item->coach }}</span>
            </div>
            @endif
          </div>
        </div>
        @empty
        <div class="col-span-2 sm:col-span-2 lg:col-span-3 py-16 text-center bg-white border border-slate-200 rounded-2xl p-8">
          <div class="w-16 h-16 mx-auto mb-4 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center text-3xl">
            <i class="fa-solid fa-layer-group"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900">Belum Ada Ekstrakurikuler</h3>
          <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto mt-1">
            Data ekstrakurikuler untuk kategori ini belum tersedia atau sedang diperbarui.
          </p>
          @if(($currentCategory ?? 'all') !== 'all')
          <a href="{{ route('ekstrakulikuler', ['kategori' => 'all']) }}" 
             class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-900 text-amber-300 text-xs font-bold rounded-lg border border-amber-400 shadow-sm">
            <i class="fa-solid fa-rotate-left"></i>
            <span>Tampilkan Semua Ekstrakurikuler</span>
          </a>
          @endif
        </div>
        @endforelse
      </div>

      <!-- 3. Pagination (Tampil otomatis bila melebihi 9 item) -->
      @if (isset($extracurriculars) && $extracurriculars->hasPages())
        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-200">
          <div class="text-xs text-slate-500 text-center sm:text-left">
            Menampilkan <span class="font-bold text-slate-700">{{ $extracurriculars->firstItem() }}</span> - 
            <span class="font-bold text-slate-700">{{ $extracurriculars->lastItem() }}</span> dari total 
            <span class="font-bold text-emerald-800">{{ $extracurriculars->total() }}</span> ekstrakurikuler
          </div>

          <nav class="flex items-center gap-1.5 flex-wrap justify-center">
            {{-- Previous Page Link --}}
            @if ($extracurriculars->onFirstPage())
              <span class="px-3.5 py-2 rounded-lg bg-slate-100 text-slate-400 text-xs font-bold border border-slate-200 cursor-not-allowed">
                <i class="fa-solid fa-chevron-left mr-1"></i> Prev
              </span>
            @else
              <a href="{{ $extracurriculars->previousPageUrl() }}" 
                 class="px-3.5 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 hover:text-emerald-950 text-xs font-bold border border-slate-300 hover:border-emerald-600 shadow-xs transition-colors">
                <i class="fa-solid fa-chevron-left mr-1"></i> Prev
              </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($extracurriculars->getUrlRange(1, $extracurriculars->lastPage()) as $page => $url)
              @if ($page == $extracurriculars->currentPage())
                <span class="w-9 h-9 rounded-lg bg-emerald-900 text-amber-300 text-xs font-extrabold border-2 border-amber-400 flex items-center justify-center shadow-md">
                  {{ $page }}
                </span>
              @else
                <a href="{{ $url }}" 
                   class="w-9 h-9 rounded-lg bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-900 text-xs font-bold border border-slate-300 hover:border-emerald-600 flex items-center justify-center transition-colors shadow-xs">
                  {{ $page }}
                </a>
              @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($extracurriculars->hasMorePages())
              <a href="{{ $extracurriculars->nextPageUrl() }}" 
                 class="px-3.5 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 hover:text-emerald-950 text-xs font-bold border border-slate-300 hover:border-emerald-600 shadow-xs transition-colors">
                Next <i class="fa-solid fa-chevron-right ml-1"></i>
              </a>
            @else
              <span class="px-3.5 py-2 rounded-lg bg-slate-100 text-slate-400 text-xs font-bold border border-slate-200 cursor-not-allowed">
                Next <i class="fa-solid fa-chevron-right ml-1"></i>
              </span>
            @endif
          </nav>
        </div>
      @endif

      <!-- 4. Prestasi & Rekam Jejak Unggulan -->
      <div class="mt-16 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="max-w-2xl mb-8">
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
            Prestasi Siswa/i
          </span>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-3">
            Jejak Kejuaraan & Prestasi Ekstrakurikuler
          </h3>
          <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Siswa/i MA Darun Najah Sambikarto aktif menorehkan prestasi di berbagai kompetisi seni Islam, olahraga, dan kepanduan.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-trophy"></i>
            </div>
            <div>
              <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Juara 1 Kabupaten</span>
              <h4 class="font-bold text-sm text-slate-900 mt-0.5">Festival Hadroh Klasik</h4>
              <p class="text-xs text-slate-500 mt-1">Grup Hadroh Ash-Shofwah berhasil membawa pulang piala kejuaraan seni Islam Lampung Timur.</p>
            </div>
          </div>

          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-medal"></i>
            </div>
            <div>
              <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700">Juara 2 Kaligrafi</span>
              <h4 class="font-bold text-sm text-slate-900 mt-0.5">MTQ Pelajar Antar-Madrasah</h4>
              <p class="text-xs text-slate-500 mt-1">Cabang Khat Naskhi dan Kontemporer siswa/i MA berhasil lolos seleksi hingga tingkat provinsi.</p>
            </div>
          </div>

          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-award"></i>
            </div>
            <div>
              <span class="text-[10px] font-bold uppercase tracking-wider text-sky-700">Juara Pencak Silat</span>
              <h4 class="font-bold text-sm text-slate-900 mt-0.5">Kejurda Silat Pagar Nusa</h4>
              <p class="text-xs text-slate-500 mt-1">Meraih medali perak dan perunggu pada nomor tanding remaja se-Karesidenan Lampung.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. CTA Card -->
      <div class="mt-12 bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-trophy"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Penerimaan Siswa/i Baru (PPDB)</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Siap Menyalurkan Minat & Meraih Prestasi Bersama Kami?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Daftarkan putra-putri Anda di MA Darun Najah Sambikarto sekarang juga secara online. Kembangkan bakat seni, olahraga, dan kepemimpinan dalam lingkungan madrasah yang religius dan asri.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ url('/') }}#ppdb" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Daftar PPDB Online</span>
            </a>

            <a href="{{ route('galeri') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-solid fa-images"></i>
              <span>Lihat Foto Dokumentasi</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
