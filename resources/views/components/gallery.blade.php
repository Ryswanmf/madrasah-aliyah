<!-- Galeri Dokumentasi Section (Clean White Background) -->
<section id="galeri" 
         class="py-16 lg:py-24 bg-white relative scroll-mt-16 border-b border-slate-200" 
         x-data="{ 
           modalOpen: false, 
           modalImg: '', 
           modalTitle: '',
           openPreview(img, title) {
             this.modalImg = img;
             this.modalTitle = title;
             this.modalOpen = true;
           }
         }">
  <span id="gallery" class="absolute -top-20"></span>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-12 text-center sm:text-left">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-950 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Dokumentasi & Potret</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Galeri Aktivitas <span class="text-emerald-700">Madrasah</span>
      </h2>
      <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
        Potret kebersamaan siswa/i, suasana pembelajaran interaktif, kajian keislaman, dan dinamika kegiatan siswa/i di Madrasah Aliyah Darun Najah.
      </p>
    </div>

    <!-- Gallery Grid (Soft Rounded Frames) -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
      @if(isset($homeGalleries) && count($homeGalleries) > 0)
        @foreach($homeGalleries as $item)
          <div @click="openPreview('{{ $item->image_url }}', '{{ addslashes($item->title) }}')"
               class="group relative overflow-hidden bg-slate-100 border-2 border-slate-200 hover:border-emerald-600 rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer aspect-4/3 sm:aspect-square flex flex-col justify-end">
            <img src="{{ $item->image_url }}" 
                 alt="{{ $item->title }}" 
                 loading="lazy"
                 decoding="async"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-emerald-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
              <div class="text-white flex-1 pr-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300 block mb-0.5">{{ $item->category_label }}</span>
                <p class="text-xs sm:text-sm font-bold line-clamp-2 leading-tight">{{ $item->title }}</p>
              </div>
              <span class="w-8 h-8 bg-emerald-900 border border-amber-400/60 text-amber-300 rounded-md flex items-center justify-center text-xs shrink-0 shadow-md">
                <i class="fa-solid fa-expand"></i>
              </span>
            </div>
          </div>
        @endforeach
      @else
        <!-- Fallback 8 static items -->
        @foreach([
          ['assets/images/gallery-1.jpg', 'Aktivitas Belajar Siswa/i', 'Kegiatan'],
          ['assets/images/gallery-2.jpg', 'Kebersamaan Siswa/i', 'Siswa/i'],
          ['assets/images/gallery-3.jpg', 'Kajian Kitab Kuning', 'Bimbingan'],
          ['assets/images/gallery-4.jpg', 'Rutinitas Harian', 'Madrasah'],
          ['assets/images/gedung-1.jpg', 'Gedung Utama Madrasah', 'Fasilitas'],
          ['assets/images/gedung-2.jpg', 'Gedung Asrama Siswa/i', 'Asrama'],
          ['assets/images/gedung-3.jpg', 'Masjid Kampus', 'Ibadah'],
          ['assets/images/gedung-4.jpg', 'Ruang Kelas & Belajar', 'Kelas'],
        ] as $f)
          <div @click="openPreview('{{ function_exists('webp_asset') ? webp_asset($f[0]) : asset($f[0]) }}', '{{ $f[1] }}')"
               class="group relative overflow-hidden bg-slate-100 border-2 border-slate-200 hover:border-emerald-600 rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer aspect-4/3 sm:aspect-square flex flex-col justify-end">
            <img src="{{ function_exists('webp_asset') ? webp_asset($f[0]) : asset($f[0]) }}" alt="{{ $f[1] }}" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-emerald-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
              <div class="text-white flex-1 pr-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300 block mb-0.5">{{ $f[2] }}</span>
                <p class="text-xs sm:text-sm font-bold line-clamp-2 leading-tight">{{ $f[1] }}</p>
              </div>
              <span class="w-8 h-8 bg-emerald-900 border border-amber-400/60 text-amber-300 rounded-md flex items-center justify-center text-xs shrink-0 shadow-md">
                <i class="fa-solid fa-expand"></i>
              </span>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <!-- Tombol Lihat Galeri Lengkap Lainnya (Aksen Elegan di atas Latar Putih) -->
    <div class="mt-12 text-center">
      <a href="{{ route('galeri') }}" 
         class="inline-flex items-center gap-3 px-8 py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-emerald-950">
        <span>Lihat Semua Galeri ({{ \App\Models\Gallery::where('is_published', true)->count() }} Foto)</span>
        <i class="fa-solid fa-arrow-right text-amber-400"></i>
      </a>
      <p class="mt-3 text-xs text-slate-500">
        Jelajahi seluruh dokumentasi kegiatan wisuda, ekstrakurikuler, pembiasaan ibadah, dan album foto siswa/i.
      </p>
    </div>

  </div>

  <!-- Lightbox Modal Preview Dialog -->
  <div x-show="modalOpen" 
       x-transition:enter="transition-opacity ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @keydown.escape.window="modalOpen = false"
       @click="modalOpen = false"
       class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4"
       x-cloak>
    
    <div @click.stop class="relative max-w-4xl w-full bg-slate-900 rounded-2xl overflow-hidden border-2 border-emerald-700 shadow-2xl">
      <button @click="modalOpen = false" 
              class="absolute top-4 right-4 z-10 w-9 h-9 bg-slate-800/90 text-white hover:bg-amber-500 hover:text-slate-950 rounded-lg flex items-center justify-center transition-all border border-slate-600 shadow-md">
        <i class="fa-solid fa-xmark text-base"></i>
      </button>

      <div class="max-h-[75vh] flex items-center justify-center bg-black/60 p-2">
        <img :src="modalImg" :alt="modalTitle" class="max-h-[72vh] w-auto max-w-full object-contain rounded-lg">
      </div>

      <div class="p-4 sm:p-5 bg-slate-900 border-t-2 border-amber-400 flex items-center justify-between text-white">
        <p class="text-sm sm:text-base font-bold text-white" x-text="modalTitle"></p>
        <span class="text-xs text-amber-300 font-mono uppercase tracking-wider flex items-center gap-1.5 shrink-0 ml-4">
          <i class="fa-solid fa-camera"></i>
          <span>Dokumentasi MA Darun Najah</span>
        </span>
      </div>
    </div>
  </div>

</section>
