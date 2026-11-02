@extends('layouts.app')

@section('title', 'Galeri & Dokumentasi Aktivitas Santri • MA Darun Najah Sambikarto')

@section('content')
<!-- Gallery Page Container -->
<div class="bg-slate-50 min-h-screen" 
     x-data="{ 
       modalOpen: false, 
       modalImg: '', 
       modalTitle: '',
       modalTag: '',
       modalDesc: '',
       openLightbox(img, title, tag = '', desc = '') {
         this.modalImg = img;
         this.modalTitle = title;
         this.modalTag = tag;
         this.modalDesc = desc;
         this.modalOpen = true;
       }
     }">

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg') }}" 
           alt="Galeri MA Darun Najah" 
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
        <span class="text-amber-300">Dokumentasi & Galeri Foto</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Dokumentasi & Potret Santri</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Galeri Aktivitas & <span class="text-amber-400">Kehidupan Santri</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Koleksi dokumentasi visual kegiatan belajar mengajar, pengajian kitab kuning, kebersamaan di asrama, ekstrakurikuler, dan momentum bersejarah MA Darun Najah Sambikarto.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Main Gallery Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Category Filter Tabs (Soft Rounded Style with Link Navigation) -->
      <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-200">
        <div class="flex flex-wrap gap-2 sm:gap-2.5">
          <a href="{{ route('galeri', ['kategori' => 'all']) }}" 
             class="px-4 py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ $currentCategory === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-images"></i>
            <span>Semua Dokumentasi</span>
          </a>

          <a href="{{ route('galeri', ['kategori' => 'kegiatan']) }}" 
             class="px-4 py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ $currentCategory === 'kegiatan' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-users"></i>
            <span>Aktivitas & Belajar</span>
          </a>

          <a href="{{ route('galeri', ['kategori' => 'ibadah']) }}" 
             class="px-4 py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ $currentCategory === 'ibadah' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-book-quran"></i>
            <span>Kajian & Ibadah</span>
          </a>

          <a href="{{ route('galeri', ['kategori' => 'sarana']) }}" 
             class="px-4 py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ $currentCategory === 'sarana' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-building"></i>
            <span>Gedung & Sarana</span>
          </a>

          <a href="{{ route('galeri', ['kategori' => 'ekskul']) }}" 
             class="px-4 py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ $currentCategory === 'ekskul' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-trophy"></i>
            <span>Ekskul & Olahraga</span>
          </a>
        </div>

        <!-- Total Count Badge -->
        <div class="text-xs font-medium text-slate-500 flex items-center gap-1.5">
          <i class="fa-regular fa-image text-emerald-700"></i>
          <span>Total: <strong>{{ $galleries->total() }}</strong> Foto</span>
        </div>
      </div>

      <!-- Photo Grid (12 Items Per Page - Soft Rounded Modern Frames) -->
      <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($galleries as $item)
          <div @click="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->category_label) }}', '{{ addslashes($item->description ?? '') }}')"
               class="group relative overflow-hidden bg-white border-2 border-slate-200 hover:border-emerald-600 rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer aspect-4/3 sm:aspect-square flex flex-col justify-end">
            
            <img src="{{ $item->image_url }}" 
                 alt="{{ $item->title }}" 
                 loading="lazy"
                 decoding="async"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/95 via-emerald-950/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
              <div class="text-white flex-1 pr-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300 block mb-0.5">
                  {{ $item->category_label }}
                </span>
                <p class="text-xs sm:text-sm font-bold line-clamp-2 leading-tight">
                  {{ $item->title }}
                </p>
              </div>
              <span class="w-8 h-8 bg-emerald-900 border border-amber-400/60 text-amber-300 rounded-md flex items-center justify-center text-xs shrink-0 shadow-md">
                <i class="fa-solid fa-expand"></i>
              </span>
            </div>
          </div>
        @empty
          <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 p-8">
            <div class="w-16 h-16 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 border border-emerald-200">
              <i class="fa-regular fa-images"></i>
            </div>
            <h3 class="text-base font-bold text-slate-800">Belum Ada Foto dalam Kategori Ini</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
              Foto dokumentasi untuk kategori ini belum diunggah atau dapat dilihat di kategori lainnya.
            </p>
            <a href="{{ route('galeri', ['kategori' => 'all']) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 hover:text-emerald-950 mt-4 uppercase tracking-wider">
              <span>Kembali ke Semua Dokumentasi</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        @endforelse
      </div>

      <!-- 3. Pagination Controls (Muncul Apabila Total Foto Melebihi 12) -->
      @if($galleries->hasPages())
        <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
          <!-- Text Informasi Jumlah Halaman -->
          <div class="text-xs text-slate-600">
            Menampilkan <strong class="text-slate-900">{{ $galleries->firstItem() }}</strong> – <strong class="text-slate-900">{{ $galleries->lastItem() }}</strong> dari <strong class="text-emerald-900 font-extrabold">{{ $galleries->total() }}</strong> foto dokumentasi
          </div>

          <!-- Pagination Links (Styled in Emerald & Amber Accents) -->
          <nav role="navigation" aria-label="Navigasi Halaman Galeri" class="flex items-center gap-1.5">
            {{-- Previous Page Link --}}
            @if ($galleries->onFirstPage())
              <span class="px-3.5 py-2 rounded-lg bg-slate-100 text-slate-400 text-xs font-bold border border-slate-200 cursor-not-allowed">
                <i class="fa-solid fa-chevron-left mr-1"></i> Prev
              </span>
            @else
              <a href="{{ $galleries->previousPageUrl() }}" 
                 class="px-3.5 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 hover:text-emerald-950 text-xs font-bold border border-slate-300 hover:border-emerald-600 shadow-xs transition-colors">
                <i class="fa-solid fa-chevron-left mr-1"></i> Prev
              </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
              @if ($page == $galleries->currentPage())
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
            @if ($galleries->hasMorePages())
              <a href="{{ $galleries->nextPageUrl() }}" 
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

      <!-- 4. Video Dokumentasi Highlight -->
      <div class="mt-16 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="max-w-2xl mb-8">
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
            Video Kilas Santri
          </span>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-3">
            Dokumentasi Video & Sorotan Kegiatan
          </h3>
          <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Simak cuplikan kebersamaan, haflah akhirussanah, dan karya santri MA Darun Najah Sambikarto.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Video 1 -->
          <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-50">
            <div class="relative aspect-16/9 bg-slate-900 flex items-center justify-center">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" alt="Haflah Akhirussanah" loading="lazy" decoding="async" class="w-full h-full object-cover opacity-60">
              <a href="{{ $contact?->youtube_url ?: 'https://youtube.com' }}" target="_blank" rel="noopener noreferrer" 
                 class="absolute w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center text-xl shadow-xl hover:scale-110 transition-transform">
                <i class="fa-solid fa-play ml-0.5"></i>
              </a>
            </div>
            <div class="p-4">
              <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800">Dokumenter Pesantren</span>
              <h4 class="font-bold text-sm text-slate-900 mt-0.5">Kilas Haflah Akhirussanah & Khotmil Qur'an Bil Ghoib</h4>
            </div>
          </div>

          <!-- Video 2 -->
          <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-50">
            <div class="relative aspect-16/9 bg-slate-900 flex items-center justify-center">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg') }}" alt="Profil Madrasah" loading="lazy" decoding="async" class="w-full h-full object-cover opacity-60">
              <a href="{{ $contact?->youtube_url ?: 'https://youtube.com' }}" target="_blank" rel="noopener noreferrer" 
                 class="absolute w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center text-xl shadow-xl hover:scale-110 transition-transform">
                <i class="fa-solid fa-play ml-0.5"></i>
              </a>
            </div>
            <div class="p-4">
              <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800">Profil Kelembagaan</span>
              <h4 class="font-bold text-sm text-slate-900 mt-0.5">Video Profil MA Darun Najah Sambikarto, Sekampung</h4>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. CTA Pendaftaran Santri Baru -->
      <div class="mt-12 bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-camera-retro"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Mari Bergabung Bersama Kami</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Ingin Menjadi Bagian dari Cerita Indah Ini?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Daftarkan putra-putri Anda di MA Darun Najah Sambikarto. Pendaftaran santri baru Tahun Ajaran 2026/2027 telah dibuka secara online dengan jalur reguler dan beasiswa tahfidz.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ route('ppdb') }}" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-user-plus"></i>
              <span>Daftar PPDB Online</span>
            </a>

            <a href="{{ route('kontak') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-solid fa-phone"></i>
              <span>Hubungi Kontak Madrasah</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- 6. Lightbox Modal Component (Modern Clean Viewer) -->
  <div x-show="modalOpen" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @keydown.escape.window="modalOpen = false"
       @click="modalOpen = false"
       class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-md"
       x-cloak>
    
    <div @click.stop class="relative max-w-4xl w-full bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl flex flex-col max-h-[92vh]">
      <!-- Close Button -->
      <button @click="modalOpen = false" 
              class="absolute top-3.5 right-3.5 z-20 w-11 h-11 rounded-full bg-black/70 hover:bg-black/95 text-white flex items-center justify-center transition-colors cursor-pointer border border-white/20 shadow-lg"
              aria-label="Tutup Modal Galeri">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <!-- Image Display Area -->
      <div class="relative bg-black flex items-center justify-center overflow-hidden flex-1 min-h-[300px]">
        <img :src="modalImg" :alt="modalTitle" class="max-h-[68vh] w-auto max-w-full object-contain">
      </div>

      <!-- Caption Footer -->
      <div class="p-4 sm:p-5 bg-slate-900 border-t border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-white">
        <div class="space-y-1">
          <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-amber-400 text-emerald-950" x-text="modalTag"></span>
          <h4 class="text-sm sm:text-base font-bold text-white" x-text="modalTitle"></h4>
          <p class="text-xs text-slate-400" x-show="modalDesc" x-text="modalDesc"></p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
          <a :href="modalImg" download target="_blank" 
             class="px-3.5 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-semibold text-slate-200 transition-colors flex items-center gap-1.5 border border-slate-700">
            <i class="fa-solid fa-arrow-down"></i>
            <span>Buka Gambar Asli</span>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
