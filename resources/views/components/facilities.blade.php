@props(['homeFacilities' => null])

@php
  $facilitiesList = $homeFacilities ?? \App\Models\Facility::active()->orderBy('order', 'asc')->take(4)->get();
@endphp

<!-- Fasilitas Section (Green Backdrop with School / Facility Image Blend) -->
<section id="fasilitas" 
         class="py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900 scroll-mt-16" 
         x-data="{ 
           modalOpen: false, 
           activeImg: '', 
           activeTitle: '',
           openLightbox(img, title) {
             this.activeImg = img;
             this.activeTitle = title;
             this.modalOpen = true;
           }
         }">
  
  <!-- 1. Background Image & Islamic Green Gradient Overlay -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <!-- School Facility Photo Background -->
    <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" 
         alt="Sarana Prasarana MA Darun Najah" 
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
        <span>Sarana & Prasarana</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
        Fasilitas Representatif & <span class="text-amber-400">Modern</span>
      </h2>
      <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
        Lingkungan belajar yang asri, kondusif, dan representatif di Sambikarto untuk menunjang kenyamanan serta tumbuh kembang potensi santri.
      </p>
    </div>

    <!-- Gallery Grid (Soft Rounded High-Contrast Cards) -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
      
      @forelse($facilitiesList as $facility)
      @php
        $borderClass = match($facility->category ?? '') {
          'akademik' => 'border-emerald-500',
          'asrama' => 'border-amber-500',
          'olahraga' => 'border-sky-500',
          'ibadah' => 'border-purple-500',
          'penunjang' => 'border-teal-500',
          default => 'border-emerald-600',
        };
        $catLabel = match($facility->category ?? '') {
          'akademik' => 'Akademik',
          'asrama' => 'Asrama',
          'olahraga' => 'Olahraga',
          'ibadah' => 'Masjid',
          'penunjang' => 'Lab & TIK',
          default => 'Fasilitas',
        };
        $catIcon = match($facility->category ?? '') {
          'akademik' => 'fa-solid fa-school',
          'asrama' => 'fa-solid fa-hotel',
          'olahraga' => 'fa-solid fa-futbol',
          'ibadah' => 'fa-solid fa-mosque',
          'penunjang' => 'fa-solid fa-laptop-code',
          default => 'fa-solid fa-building-columns',
        };
        $imgUrl = $facility->image_url;
      @endphp
      <div @click="openLightbox('{{ $imgUrl }}', '{{ addslashes($facility->name) }}')"
           class="group relative bg-white text-slate-800 border-t-4 {{ $borderClass }} rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer flex flex-col justify-between">
        <div>
          <div class="aspect-4/3 overflow-hidden bg-slate-100 relative">
            <img src="{{ $imgUrl }}" alt="{{ $facility->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <span class="absolute top-2 sm:top-3 right-2 sm:right-3 bg-emerald-950/85 text-amber-300 text-[10px] sm:text-xs px-2 sm:px-2.5 py-1 sm:py-1.5 rounded-md border border-emerald-700/60 shadow-md backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1 sm:gap-1.5">
              <i class="fa-solid fa-expand text-[10px]"></i>
              <span class="font-semibold text-[10px] hidden sm:inline">Perbesar</span>
            </span>
            <div class="absolute bottom-2 sm:bottom-3 left-2 sm:left-3 bg-emerald-900/90 text-white text-[10px] sm:text-[11px] font-semibold px-2 sm:px-2.5 py-1 rounded-md shadow backdrop-blur-xs flex items-center gap-1 sm:gap-1.5">
              <i class="{{ $catIcon }} text-amber-300"></i>
              <span>{{ $catLabel }}</span>
            </div>
          </div>
          <div class="p-3 sm:p-5">
            <h3 class="font-bold text-slate-900 text-xs sm:text-base group-hover:text-emerald-700 transition-colors line-clamp-1 sm:line-clamp-2">
              {{ $facility->name }}
            </h3>
            <p class="text-[11px] sm:text-xs text-slate-600 mt-1 sm:mt-2 leading-relaxed line-clamp-2">
              {{ $facility->description }}
            </p>
          </div>
        </div>
        <div class="px-3 sm:px-5 pb-3 sm:pb-5 pt-0">
          <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] sm:text-xs text-emerald-700 font-semibold">
            <span class="hidden sm:inline">Lihat Dokumentasi</span>
            <span class="sm:hidden">Detail</span>
            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
          </div>
        </div>
      </div>
      @empty
      <!-- Fallback 1 -->
      <div @click="openLightbox('{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}', 'Gedung Utama Madrasah & Ruang Kelas')"
           class="group relative bg-white text-slate-800 border-t-4 border-emerald-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer flex flex-col justify-between">
        <div>
          <div class="aspect-4/3 overflow-hidden bg-slate-100 relative">
            <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" alt="Gedung Madrasah" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute bottom-3 left-3 bg-emerald-900/90 text-white text-[11px] font-semibold px-2.5 py-1 rounded-md shadow backdrop-blur-xs flex items-center gap-1.5">
              <i class="fa-solid fa-school text-amber-300"></i>
              <span>Akademik</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="font-bold text-slate-900 text-base group-hover:text-emerald-700 transition-colors">
              Gedung Utama & Kelas
            </h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
              Ruang belajar representatif berlantai keramik, sirkulasi udara sejuk, dan proyektor multimedia.
            </p>
          </div>
        </div>
      </div>
      @endforelse

    </div>

    <!-- Tombol Lihat Fasilitas Lainnya (Navigasi ke Halaman Lengkap) -->
    <div class="mt-12 text-center">
      <a href="{{ route('fasilitas') }}" 
         class="inline-flex items-center gap-3 px-8 py-3.5 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-amber-400/20 hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-amber-600">
        <span>Lihat Fasilitas Lainnya</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
      <p class="mt-3 text-xs text-emerald-200/80">
        Jelajahi laboratorium, perpustakaan, asrama mukim, sarana olahraga, dan fasilitas penunjang lainnya.
      </p>
    </div>

  </div>

  <!-- Lightbox Modal (Soft Rounded Dialog) -->
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
      <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 w-9 h-9 bg-slate-800/90 text-white hover:bg-amber-500 hover:text-slate-950 rounded-lg flex items-center justify-center transition-all border border-slate-600 shadow-md">
        <i class="fa-solid fa-xmark text-base"></i>
      </button>

      <!-- Modal Image -->
      <div class="max-h-[75vh] flex items-center justify-center bg-black/60 p-2">
        <img :src="activeImg" :alt="activeTitle" class="max-h-[72vh] w-auto max-w-full object-contain rounded-lg">
      </div>

      <!-- Modal Caption -->
      <div class="p-4 bg-slate-900 text-white flex items-center justify-between border-t-2 border-amber-400">
        <p x-text="activeTitle" class="font-bold text-sm sm:text-base text-white"></p>
        <span class="text-xs text-amber-300 font-mono uppercase tracking-wider flex items-center gap-1.5">
          <i class="fa-solid fa-building-columns"></i>
          <span>MA Darun Najah Sambikarto</span>
        </span>
      </div>

    </div>
  </div>
</section>