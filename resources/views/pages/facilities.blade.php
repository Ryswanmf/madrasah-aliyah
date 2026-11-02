@extends('layouts.app')

@section('title', 'Sarana & Prasarana Lengkap • MA Darun Najah Sambikarto')

@section('content')
<!-- Facilities Page Container -->
<div class="bg-slate-50 min-h-screen" 
     x-data="{ 
       modalOpen: false, 
       activeImg: '', 
       activeTitle: '', 
       activeDesc: '',
       openLightbox(img, title, desc = '') {
         this.activeImg = img;
         this.activeTitle = title;
         this.activeDesc = desc;
         this.modalOpen = true;
       }
     }">

  <!-- 1. Hero Header Banner (Signature Green & Facility Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" 
           alt="Gedung MA Darun Najah Sambikarto" 
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
        <span class="text-amber-300">Sarana & Prasarana</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Fasilitas Terpadu & Modern</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Sarana & Prasarana <span class="text-amber-400">Lengkap</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          MA Darun Najah Sambikarto menyediakan fasilitas belajar, beribadah, hunian asrama santri mukim, dan sarana olahraga yang asri, bersih, dan representatif guna mendukung prestasi dan tumbuh kembang santri.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Main Facilities Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Category Filter Tabs (Soft Rounded Style with Link Navigation) -->
      <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-200">
        <div class="flex flex-wrap gap-2 sm:gap-2.5">
          <a href="{{ route('fasilitas', ['kategori' => 'all']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? 'all') === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-border-all"></i>
            <span>Semua Fasilitas</span>
          </a>

          <a href="{{ route('fasilitas', ['kategori' => 'akademik']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'akademik' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-school"></i>
            <span>Gedung & Kelas</span>
          </a>

          <a href="{{ route('fasilitas', ['kategori' => 'asrama']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'asrama' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-hotel"></i>
            <span>Asrama Santri</span>
          </a>

          <a href="{{ route('fasilitas', ['kategori' => 'ibadah']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'ibadah' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-mosque"></i>
            <span>Masjid & Religi</span>
          </a>

          <a href="{{ route('fasilitas', ['kategori' => 'olahraga']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'olahraga' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-futbol"></i>
            <span>Sarana Olahraga</span>
          </a>

          <a href="{{ route('fasilitas', ['kategori' => 'penunjang']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'penunjang' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-laptop-code"></i>
            <span>Laboratorium & TIK</span>
          </a>
        </div>

        @if(isset($facilities) && $facilities->total() > 0)
        <div class="text-xs text-slate-500 font-medium">
          Total: <strong class="text-emerald-900">{{ $facilities->total() }}</strong> Fasilitas
        </div>
        @endif
      </div>

      <!-- Facilities Grid (Tampilan Mobile 2-2 / Desktop 3 Kolom) -->
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
        @forelse($facilities ?? [] as $item)
        @php
          $borderClass = match($item->category) {
            'akademik' => 'border-emerald-600',
            'asrama' => 'border-amber-500',
            'olahraga' => 'border-blue-600',
            'ibadah' => 'border-purple-600',
            'penunjang' => 'border-teal-600',
            default => 'border-emerald-700',
          };
          $imgUrl = $item->image_url;
          $descForModal = $item->details ?: $item->description;
        @endphp
        <div @click="openLightbox('{{ $imgUrl }}', '{{ addslashes($item->name) }}', '{{ addslashes($descForModal) }}')"
             class="group relative bg-white border-t-4 {{ $borderClass }} border-x border-b border-slate-200 rounded-xl overflow-hidden shadow-xs hover:shadow-xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 cursor-pointer flex flex-col justify-between">
          <div>
            <!-- Thumbnail Visual -->
            <div class="aspect-4/3 sm:aspect-16/10 overflow-hidden bg-slate-100 relative">
              <img src="{{ $imgUrl }}" 
                   alt="{{ $item->name }}" 
                   loading="lazy"
                   decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              
              <!-- Hover Zoom Button -->
              <span class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-emerald-950/85 text-amber-300 text-[10px] sm:text-xs px-2 sm:px-2.5 py-1 sm:py-1.5 rounded-md border border-emerald-700/60 shadow-md backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1.5">
                <i class="fa-solid fa-expand text-[10px] sm:text-[11px]"></i>
                <span class="hidden sm:inline font-semibold text-[11px]">Perbesar</span>
              </span>

              <!-- Category Badge -->
              <div class="absolute bottom-1.5 left-1.5 sm:bottom-3 sm:left-3 bg-emerald-900/90 text-white text-[9px] sm:text-[11px] font-semibold px-1.5 sm:px-2.5 py-0.5 sm:py-1 rounded-md shadow backdrop-blur-xs flex items-center gap-1 sm:gap-1.5 max-w-[92%] truncate">
                <i class="{{ $item->category_icon }} text-amber-300 text-[9px] sm:text-[11px]"></i>
                <span class="truncate">{{ $item->category_label }}</span>
              </div>
            </div>

            <!-- Card Content Body -->
            <div class="p-3 sm:p-5 lg:p-6">
              <h3 class="font-bold text-slate-900 text-xs sm:text-base lg:text-lg group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                {{ $item->name }}
              </h3>
              <p class="text-[11px] sm:text-xs lg:text-sm text-slate-600 mt-1 sm:mt-2 leading-relaxed line-clamp-2 sm:line-clamp-3">
                {{ $item->description }}
              </p>
            </div>
          </div>

          <!-- Card Footer Action -->
          <div class="px-3 sm:px-5 lg:px-6 pb-3 sm:pb-5 pt-0">
            <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between text-[10px] sm:text-xs text-emerald-700 font-semibold">
              <span class="truncate">Lihat foto</span>
              <i class="fa-solid fa-arrow-right text-[10px] sm:text-xs group-hover:translate-x-1 transition-transform shrink-0 ml-1"></i>
            </div>
          </div>
        </div>
        @empty
        <div class="col-span-2 sm:col-span-2 lg:col-span-3 py-16 text-center bg-white border border-slate-200 rounded-2xl p-8">
          <div class="w-16 h-16 mx-auto mb-4 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center text-3xl">
            <i class="fa-solid fa-building-circle-xmark"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900">Belum Ada Sarana Fasilitas</h3>
          <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto mt-1">
            Data fasilitas untuk kategori ini belum tersedia atau sedang dalam pembaruan oleh pihak madrasah.
          </p>
          @if(($currentCategory ?? 'all') !== 'all')
          <a href="{{ route('fasilitas', ['kategori' => 'all']) }}" 
             class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-900 text-amber-300 text-xs font-bold rounded-lg border border-amber-400 shadow-sm">
            <i class="fa-solid fa-rotate-left"></i>
            <span>Tampilkan Semua Fasilitas</span>
          </a>
          @endif
        </div>
        @endforelse
      </div>

      <!-- 3. Pagination (Tampil otomatis apabila fasilitas melebihi 9 item) -->
      @if (isset($facilities) && $facilities->hasPages())
        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-200">
          <div class="text-xs text-slate-500 text-center sm:text-left">
            Menampilkan <span class="font-bold text-slate-700">{{ $facilities->firstItem() }}</span> - 
            <span class="font-bold text-slate-700">{{ $facilities->lastItem() }}</span> dari total 
            <span class="font-bold text-emerald-800">{{ $facilities->total() }}</span> fasilitas
          </div>

          <nav class="flex items-center gap-1.5 flex-wrap justify-center">
            {{-- Previous Page Link --}}
            @if ($facilities->onFirstPage())
              <span class="px-3.5 py-2 rounded-lg bg-slate-100 text-slate-400 text-xs font-bold border border-slate-200 cursor-not-allowed">
                <i class="fa-solid fa-chevron-left mr-1"></i> Prev
              </span>
            @else
              <a href="{{ $facilities->previousPageUrl() }}" 
                 class="px-3.5 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 hover:text-emerald-950 text-xs font-bold border border-slate-300 hover:border-emerald-600 shadow-xs transition-colors">
                <i class="fa-solid fa-chevron-left mr-1"></i> Prev
              </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($facilities->getUrlRange(1, $facilities->lastPage()) as $page => $url)
              @if ($page == $facilities->currentPage())
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
            @if ($facilities->hasMorePages())
              <a href="{{ $facilities->nextPageUrl() }}" 
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

      <!-- 4. Key Standouts Grid -->
      <div class="mt-16 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="text-center max-w-2xl mx-auto mb-8">
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
            Standar Sarana Madrasah
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
            Kenyamanan & Keasrian Lingkungan Belajar
          </h2>
          <p class="mt-2 text-xs sm:text-sm text-slate-600">
            Dirancang khusus untuk mendukung konsentrasi menuntut ilmu agama dan sains di pedesaan yang sejuk.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg mb-3">
              <i class="fa-solid fa-tree"></i>
            </div>
            <h4 class="font-bold text-sm text-slate-900">Lingkungan Asri</h4>
            <p class="text-xs text-slate-500 mt-1">Jauh dari kebisingan kota, udara bersih, dan suasana pedesaan yang tenang.</p>
          </div>

          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg mb-3">
              <i class="fa-solid fa-droplet"></i>
            </div>
            <h4 class="font-bold text-sm text-slate-900">Air Bersih Alami</h4>
            <p class="text-xs text-slate-500 mt-1">Sumber air tanah melimpah dan higienis untuk wudhu dan MCK santri mukim.</p>
          </div>

          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg mb-3">
              <i class="fa-solid fa-bolt"></i>
            </div>
            <h4 class="font-bold text-sm text-slate-900">Pasokan Daya Stabil</h4>
            <p class="text-xs text-slate-500 mt-1">Kelistrikan terjamin dengan sistem cadangan genset untuk kelancaran kegiatan.</p>
          </div>

          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg mb-3">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <h4 class="font-bold text-sm text-slate-900">Bimbingan 24 Jam</h4>
            <p class="text-xs text-slate-500 mt-1">Santri dibersamai asatidz dan pengasuh dalam setiap rutinitas keseharian.</p>
          </div>
        </div>
      </div>

      <!-- 5. CTA Card -->
      <div class="mt-14 bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-building-columns"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Penerimaan Santri Baru (PPDB)</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Tertarik Belajar & Tinggal di Kampus Darun Najah?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Daftarkan putra-putri Anda sekarang juga secara online atau kunjungi langsung kampus kami di Sambikarto untuk survei asrama dan fasilitas.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ url('/') }}#ppdb" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Daftar PPDB Online</span>
            </a>

            <a href="https://wa.me/6285658973426?text=Assalamu'alaikum%20Admin%20MA%20Darun%20Najah,%20saya%20ingin%20bertanya%20seputar%20fasilitas%20dan%20asrama%20santri." 
               target="_blank" 
               rel="noopener noreferrer" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-brands fa-whatsapp text-sm"></i>
              <span>Tanya Fasilitas via WA</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Lightbox Modal Dialog (Soft Rounded Style) -->
  <div x-show="modalOpen" 
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @keydown.escape.window="modalOpen = false"
       x-cloak
       class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-sm">
    <div @click.away="modalOpen = false" class="relative max-w-4xl w-full bg-slate-900 rounded-2xl overflow-hidden shadow-2xl border-2 border-emerald-700">
      
      <!-- Close Button -->
      <button @click="modalOpen = false" 
              class="absolute top-3.5 right-3.5 z-10 w-11 h-11 bg-slate-800/95 text-white hover:bg-amber-500 hover:text-slate-950 rounded-lg flex items-center justify-center transition-all border border-slate-600 shadow-lg cursor-pointer"
              aria-label="Tutup Foto Fasilitas">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <!-- Modal Image -->
      <div class="max-h-[72vh] flex items-center justify-center bg-black/60 p-2">
        <img :src="activeImg" :alt="activeTitle" class="max-h-[70vh] w-auto max-w-full object-contain rounded-lg">
      </div>

      <!-- Modal Caption -->
      <div class="p-4 sm:p-5 bg-slate-900 text-white border-t-2 border-amber-400">
        <div class="flex items-center justify-between">
          <p x-text="activeTitle" class="font-bold text-sm sm:text-base text-white"></p>
          <span class="text-xs text-amber-300 font-mono uppercase tracking-wider flex items-center gap-1.5 shrink-0 ml-4">
            <i class="fa-solid fa-building-columns"></i>
            <span>MA Darun Najah</span>
          </span>
        </div>
        <p x-show="activeDesc" x-text="activeDesc" class="mt-1 text-xs text-slate-300 leading-relaxed"></p>
      </div>

    </div>
  </div>

</div>
@endsection
