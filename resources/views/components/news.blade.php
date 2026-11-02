@props(['featuredNews' => null])

<!-- Berita & Informasi Terkini Section (Green Backdrop with School / Santri Image Blend) -->
<section id="berita" 
         class="py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900 scroll-mt-16">
  
  <!-- 1. Background Image & Islamic Green Gradient Overlay -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <!-- Santri / School Activity Photo Background -->
    <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-1.jpg') : asset('assets/images/gallery-1.jpg') }}" 
         alt="Aktivitas Santri MA Darun Najah" 
         loading="lazy" decoding="async"
         class="w-full h-full object-cover object-center opacity-25 filter saturate-150">
    <!-- Rich Green Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/95 via-emerald-900/90 to-emerald-950"></div>
    <!-- Islamic Pattern Backdrop Overlay -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
      <div class="max-w-3xl text-center sm:text-left">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Warta & Pengumuman</span>
        </div>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Berita & Informasi <span class="text-amber-400">Terbaru</span>
        </h2>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Kilas kegiatan madrasah, prestasi gemilang santri, dan pengumuman resmi civitas akademika MA Darun Najah Sambikarto.
        </p>
      </div>
      <div class="mt-6 md:mt-0 text-center sm:text-left">
        <a href="#ppdb" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-bold text-amber-400 hover:text-amber-300 transition-colors border-b-2 border-amber-400 pb-1">
          <span>Lihat Pengumuman PPDB</span>
          <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
      </div>
    </div>

    <!-- News Cards Grid (4 Cards Berjejer di Desktop - Khusus Berita Unggulan) -->
    @php
      $homeArticles = $featuredNews ?? \App\Models\News::published()->featured()->orderBy('published_at', 'desc')->take(4)->get();
      if ($homeArticles->isEmpty()) {
        $homeArticles = \App\Models\News::published()->orderBy('published_at', 'desc')->take(4)->get();
      }
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @if($homeArticles->isNotEmpty())
        @foreach($homeArticles as $item)
          <article class="bg-white text-slate-800 border-t-4 border-emerald-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
            <a href="{{ route('berita.detail', $item->slug) }}" class="block">
              <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
                <img src="{{ $item->image_url }}" 
                     alt="{{ $item->title }}" 
                     loading="lazy"
                     decoding="async"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 left-3 bg-emerald-950/90 text-amber-300 border-l-3 border-amber-400 rounded-md text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 shadow-md backdrop-blur-xs">
                  {{ $item->category }}
                </span>
                @if($item->is_featured)
                  <span class="absolute top-3 right-3 bg-amber-400 text-emerald-950 font-black text-[10px] uppercase tracking-wider px-2 py-0.5 rounded shadow flex items-center gap-1 z-10">
                    <i class="fa-solid fa-star text-[9px]"></i>
                    <span>Unggulan</span>
                  </span>
                @endif
              </div>
              <div class="p-5">
                <div class="flex items-center gap-2 text-xs text-slate-500 mb-2.5 font-mono">
                  <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-emerald-600"></i> {{ $item->formatted_date }}</span>
                  <span>•</span>
                  <span class="truncate max-w-[100px]">{{ $item->author }}</span>
                </div>
                <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                  {{ $item->title }}
                </h3>
                <p class="mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                  {{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                </p>
              </div>
            </a>
            <div class="px-5 pb-5 pt-0">
              <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('berita.detail', $item->slug) }}" class="text-xs font-bold text-emerald-700 hover:text-amber-600 flex items-center gap-1 uppercase tracking-wider">
                  <span>Baca</span>
                  <i class="fa-solid fa-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
                <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                  {{ $item->reading_time }}
                </span>
              </div>
            </div>
          </article>
        @endforeach
      @else
        <!-- Article 1: PPDB -->
        <article class="bg-white text-slate-800 border-t-4 border-emerald-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div>
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" 
                   alt="Penerimaan Santri Baru MA Darun Najah" 
                   loading="lazy"
                   decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-3 left-3 bg-emerald-950/90 text-amber-300 border-l-3 border-amber-400 rounded-md text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 shadow-md backdrop-blur-xs">
                PPDB 2026/2027
              </span>
            </div>
            <div class="p-5">
              <div class="flex items-center gap-2 text-xs text-slate-500 mb-2.5 font-mono">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-emerald-600"></i> 2 Nov 2026</span>
                <span>•</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user text-emerald-600"></i> Humas MA</span>
              </div>
              <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                Pembukaan PPDB MA Darun Najah Sambikarto T.A 2026/2027
              </h3>
              <p class="mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Pendaftaran santri baru kini telah dibuka secara online melalui website resmi dengan jalur reguler dan beasiswa tahfidz Qur'an.
              </p>
            </div>
          </div>
          <div class="px-5 pb-5 pt-0">
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
              <a href="#ppdb" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1 uppercase tracking-wider">
                <span>Daftar</span>
                <i class="fa-solid fa-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
              </a>
              <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                Online 24 Jam
              </span>
            </div>
          </div>
        </article>

        <!-- Article 2: Prestasi Santri -->
        <article class="bg-white text-slate-800 border-t-4 border-amber-500 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div>
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg') }}" 
                   alt="Kegiatan Santri Darun Najah" 
                   loading="lazy" decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-3 left-3 bg-emerald-950/90 text-amber-300 border-l-3 border-amber-400 rounded-md text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 shadow-md backdrop-blur-xs">
                Prestasi Santri
              </span>
            </div>
            <div class="p-5">
              <div class="flex items-center gap-2 text-xs text-slate-500 mb-2.5 font-mono">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-emerald-600"></i> 28 Okt 2026</span>
                <span>•</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user text-emerald-600"></i> Kesiswaan</span>
              </div>
              <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                Santri Raih Juara Seni Hadroh & Kaligrafi Tingkat Kabupaten
              </h3>
              <p class="mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Grup Hadroh Ash-Shofwah dan santri kaligrafi madrasah sukses memboyong piala kejuaraan festival seni Islam se-Lampung Timur.
              </p>
            </div>
          </div>
          <div class="px-5 pb-5 pt-0">
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
              <span class="text-xs font-semibold text-slate-600 flex items-center gap-1">
                <i class="fa-solid fa-trophy text-amber-500 text-xs"></i>
                <span>Seni Islam</span>
              </span>
              <span class="text-[10px] font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                Juara 1
              </span>
            </div>
          </div>
        </article>

        <!-- Article 3: Kepesantrenan -->
        <article class="bg-white text-slate-800 border-t-4 border-sky-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div>
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" 
                   alt="Kajian Kitab Kuning Pesantren" 
                   loading="lazy" decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-3 left-3 bg-emerald-950/90 text-amber-300 border-l-3 border-amber-400 rounded-md text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 shadow-md backdrop-blur-xs">
                Kepesantrenan
              </span>
            </div>
            <div class="p-5">
              <div class="flex items-center gap-2 text-xs text-slate-500 mb-2.5 font-mono">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-emerald-600"></i> 15 Okt 2026</span>
                <span>•</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user text-emerald-600"></i> Asatidz</span>
              </div>
              <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                Kajian Kitab Kuning Rutin & Pembekalan Akhlakul Karimah
              </h3>
              <p class="mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Memperdalam pemahaman kitab turats para ulama salaf guna membekali santri akhir dengan akidah kokoh dan akhlak mulia.
              </p>
            </div>
          </div>
          <div class="px-5 pb-5 pt-0">
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
              <span class="text-xs font-semibold text-slate-600 flex items-center gap-1">
                <i class="fa-solid fa-book-quran text-emerald-600 text-xs"></i>
                <span>Kitab Salaf</span>
              </span>
              <span class="text-[10px] font-semibold text-sky-700 bg-sky-50 px-2 py-0.5 rounded border border-sky-200">
                Rutin Mingguan
              </span>
            </div>
          </div>
        </article>

        <!-- Article 4: Vokasi & Keterampilan Santri -->
        <article class="bg-white text-slate-800 border-t-4 border-purple-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div>
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/facility-thumb-1.jpg') : asset('assets/images/facility-thumb-1.jpg') }}" 
                   alt="Pelatihan Digital & Vokasi Santri" 
                   loading="lazy" decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-3 left-3 bg-emerald-950/90 text-amber-300 border-l-3 border-amber-400 rounded-md text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 shadow-md backdrop-blur-xs">
                Vokasi Mandiri
              </span>
            </div>
            <div class="p-5">
              <div class="flex items-center gap-2 text-xs text-slate-500 mb-2.5 font-mono">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-emerald-600"></i> 10 Okt 2026</span>
                <span>•</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user text-emerald-600"></i> Pembina TIK</span>
              </div>
              <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
                Workshop Literasi Digital & Keterampilan Desain Grafis Santri
              </h3>
              <p class="mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Pelatihan pemanfaatan teknologi informasi, desain grafis, dan multimedia berbasis laboratorium komputer untuk kemandirian santri.
              </p>
            </div>
          </div>
          <div class="px-5 pb-5 pt-0">
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
              <span class="text-xs font-semibold text-slate-600 flex items-center gap-1">
                <i class="fa-solid fa-laptop-code text-purple-600 text-xs"></i>
                <span>Kecakapan TIK</span>
              </span>
              <span class="text-[10px] font-semibold text-purple-700 bg-purple-50 px-2 py-0.5 rounded border border-purple-200">
                Pelatihan
              </span>
            </div>
          </div>
        </article>
      @endif

    </div>

    </div>

    <!-- Tombol Lihat Berita & Pengumuman Lainnya -->
    <div class="mt-12 text-center">
      <a href="{{ route('berita') }}" 
         class="inline-flex items-center gap-3 px-8 py-3.5 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-amber-400/20 hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-amber-600">
        <span>Lihat Berita & Pengumuman Lainnya</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
      <p class="mt-3 text-xs text-emerald-200/80">
        Jelajahi seluruh warta kegiatan, pengumuman ujian, kalender akademik, dan prestasi santri MA Darun Najah.
      </p>
    </div>

  </div>
</section>
