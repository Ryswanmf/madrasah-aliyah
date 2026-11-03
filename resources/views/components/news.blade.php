@props(['featuredNews' => null])

<!-- Berita & Informasi Terkini Section (Green Backdrop with School / Siswa/i Image Blend) -->
<section id="berita" 
         class="py-12 sm:py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900 scroll-mt-16">
  
  <!-- 1. Background Image & Islamic Green Gradient Overlay -->
  <div class="absolute inset-0 z-0 pointer-events-none">
    <!-- Siswa/i / School Activity Photo Background -->
    <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-1.jpg') : asset('assets/images/gallery-1.jpg') }}" 
         alt="Aktivitas Siswa/i MA Darun Najah" 
         loading="lazy" decoding="async"
         class="w-full h-full object-cover object-center opacity-25 filter saturate-150">
    <!-- Rich Green Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/95 via-emerald-900/90 to-emerald-950"></div>
    <!-- Islamic Pattern Backdrop Overlay -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 sm:mb-12 gap-5 sm:gap-6">
      <div class="max-w-3xl text-center sm:text-left">
        <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 bg-emerald-900/90 text-amber-300 text-[10px] sm:text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-3 sm:mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Warta & Pengumuman</span>
        </div>
        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Berita & Informasi <span class="text-amber-400">Terbaru</span>
        </h2>
        <p class="mt-2.5 sm:mt-4 text-xs sm:text-base lg:text-lg text-emerald-100/90 leading-relaxed">
          Kilas kegiatan madrasah, prestasi gemilang siswa/i, dan pengumuman resmi civitas akademika Madrasah Aliyah Darun Najah.
        </p>
      </div>
      <div class="mt-2 sm:mt-6 md:mt-0 text-center sm:text-left shrink-0">
        <a href="#ppdb" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-bold text-amber-400 hover:text-amber-300 transition-colors border-b-2 border-amber-400 pb-1">
          <span>Lihat Pengumuman PPDB</span>
          <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
      </div>
    </div>

    <!-- News Cards Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
    @php
      $homeArticles = $featuredNews ?? \App\Models\News::published()->featured()->orderBy('published_at', 'desc')->take(4)->get();
      if ($homeArticles->isEmpty()) {
        $homeArticles = \App\Models\News::published()->orderBy('published_at', 'desc')->take(4)->get();
      }
    @endphp

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
      @if($homeArticles->isNotEmpty())
        @foreach($homeArticles as $item)
          <article class="bg-white text-slate-800 border-t-4 border-emerald-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
            <a href="{{ route('berita.detail', $item->slug) }}" class="block flex flex-col flex-1">
              <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
                <img src="{{ $item->image_url }}" 
                     alt="{{ $item->title }}" 
                     loading="lazy"
                     decoding="async"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-emerald-950/90 text-amber-300 border-l-2 sm:border-l-3 border-amber-400 rounded text-[8px] sm:text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 sm:px-2.5 sm:py-1 shadow-md backdrop-blur-xs truncate max-w-[65%]">
                  {{ $item->category }}
                </span>
                @if($item->is_featured)
                  <span class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-amber-400 text-emerald-950 font-black text-[8px] sm:text-[10px] uppercase tracking-wider px-1.5 py-0.5 rounded shadow flex items-center gap-1 z-10">
                    <i class="fa-solid fa-star text-[8px]"></i>
                    <span class="hidden sm:inline">Unggulan</span>
                  </span>
                @endif
              </div>
              <div class="p-3 sm:p-5 flex flex-col flex-1 justify-between">
                <div>
                  <div class="flex items-center gap-1.5 sm:gap-2 text-[9px] sm:text-xs text-slate-500 mb-1.5 sm:mb-2.5 font-mono truncate">
                    <span class="flex items-center gap-1 shrink-0"><i class="fa-regular fa-calendar text-emerald-600"></i> {{ $item->formatted_date }}</span>
                    <span>•</span>
                    <span class="truncate max-w-[70px] sm:max-w-[100px]">{{ $item->author }}</span>
                  </div>
                  <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-[2.5rem]">
                    {{ $item->title }}
                  </h3>
                </div>
                <p class="hidden sm:block mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                  {{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                </p>
              </div>
            </a>
            <div class="px-3 pb-3 sm:px-5 sm:pb-5 pt-0">
              <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('berita.detail', $item->slug) }}" class="text-[10px] sm:text-xs font-bold text-emerald-700 hover:text-amber-600 flex items-center gap-1 uppercase tracking-wider">
                  <span>Baca</span>
                  <i class="fa-solid fa-chevron-right text-[8px] sm:text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
                <span class="text-[9px] sm:text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200 truncate max-w-[80px] sm:max-w-none">
                  {{ $item->reading_time }}
                </span>
              </div>
            </div>
          </article>
        @endforeach
      @else
        <!-- Article 1: PPDB -->
        <article class="bg-white text-slate-800 border-t-4 border-emerald-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div class="flex flex-col flex-1">
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" 
                   alt="Penerimaan Siswa/i Baru MA Darun Najah" 
                   loading="lazy"
                   decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-emerald-950/90 text-amber-300 border-l-2 sm:border-l-3 border-amber-400 rounded text-[8px] sm:text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 sm:px-2.5 sm:py-1 shadow-md backdrop-blur-xs truncate max-w-[65%]">
                PPDB 2026/2027
              </span>
            </div>
            <div class="p-3 sm:p-5 flex flex-col flex-1 justify-between">
              <div>
                <div class="flex items-center gap-1.5 sm:gap-2 text-[9px] sm:text-xs text-slate-500 mb-1.5 sm:mb-2.5 font-mono truncate">
                  <span class="flex items-center gap-1 shrink-0"><i class="fa-regular fa-calendar text-emerald-600"></i> 2 Nov 2026</span>
                  <span>•</span>
                  <span class="truncate max-w-[70px] sm:max-w-[100px]"><i class="fa-regular fa-user text-emerald-600"></i> Humas MA</span>
                </div>
                <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-[2.5rem]">
                  Pembukaan PPDB MA Darun Najah Sambikarto T.A 2026/2027
                </h3>
              </div>
              <p class="hidden sm:block mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Pendaftaran siswa/i baru kini telah dibuka secara online melalui website resmi dengan jalur reguler dan beasiswa tahfidz Qur'an.
              </p>
            </div>
          </div>
          <div class="px-3 pb-3 sm:px-5 sm:pb-5 pt-0">
            <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between">
              <a href="#ppdb" class="text-[10px] sm:text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1 uppercase tracking-wider">
                <span>Daftar</span>
                <i class="fa-solid fa-chevron-right text-[8px] sm:text-[10px] group-hover:translate-x-1 transition-transform"></i>
              </a>
              <span class="text-[9px] sm:text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">
                Online 24 Jam
              </span>
            </div>
          </div>
        </article>

        <!-- Article 2: Prestasi Siswa/i -->
        <article class="bg-white text-slate-800 border-t-4 border-amber-500 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div class="flex flex-col flex-1">
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg') }}" 
                   alt="Kegiatan Siswa/i Darun Najah" 
                   loading="lazy" decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-emerald-950/90 text-amber-300 border-l-2 sm:border-l-3 border-amber-400 rounded text-[8px] sm:text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 sm:px-2.5 sm:py-1 shadow-md backdrop-blur-xs truncate max-w-[65%]">
                Prestasi Siswa/i
              </span>
            </div>
            <div class="p-3 sm:p-5 flex flex-col flex-1 justify-between">
              <div>
                <div class="flex items-center gap-1.5 sm:gap-2 text-[9px] sm:text-xs text-slate-500 mb-1.5 sm:mb-2.5 font-mono truncate">
                  <span class="flex items-center gap-1 shrink-0"><i class="fa-regular fa-calendar text-emerald-600"></i> 28 Okt 2026</span>
                  <span>•</span>
                  <span class="truncate max-w-[70px] sm:max-w-[100px]"><i class="fa-regular fa-user text-emerald-600"></i> Kesiswaan</span>
                </div>
                <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-[2.5rem]">
                  Siswa/i Raih Juara Seni Hadroh & Kaligrafi Tingkat Kabupaten
                </h3>
              </div>
              <p class="hidden sm:block mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Grup Hadroh Ash-Shofwah dan siswa/i kaligrafi madrasah sukses memboyong piala kejuaraan festival seni Islam se-Lampung Timur.
              </p>
            </div>
          </div>
          <div class="px-3 pb-3 sm:px-5 sm:pb-5 pt-0">
            <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between">
              <span class="text-[10px] sm:text-xs font-semibold text-slate-600 flex items-center gap-1">
                <i class="fa-solid fa-trophy text-amber-500 text-[10px] sm:text-xs"></i>
                <span>Seni Islam</span>
              </span>
              <span class="text-[9px] sm:text-[10px] font-semibold text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">
                Juara 1
              </span>
            </div>
          </div>
        </article>

        <!-- Article 3: Kepesantrenan -->
        <article class="bg-white text-slate-800 border-t-4 border-sky-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div class="flex flex-col flex-1">
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" 
                   alt="Kajian Kitab Kuning Pesantren" 
                   loading="lazy" decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-emerald-950/90 text-amber-300 border-l-2 sm:border-l-3 border-amber-400 rounded text-[8px] sm:text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 sm:px-2.5 sm:py-1 shadow-md backdrop-blur-xs truncate max-w-[65%]">
                Keagamaan
              </span>
            </div>
            <div class="p-3 sm:p-5 flex flex-col flex-1 justify-between">
              <div>
                <div class="flex items-center gap-1.5 sm:gap-2 text-[9px] sm:text-xs text-slate-500 mb-1.5 sm:mb-2.5 font-mono truncate">
                  <span class="flex items-center gap-1 shrink-0"><i class="fa-regular fa-calendar text-emerald-600"></i> 15 Okt 2026</span>
                  <span>•</span>
                  <span class="truncate max-w-[70px] sm:max-w-[100px]"><i class="fa-regular fa-user text-emerald-600"></i> Asatidz</span>
                </div>
                <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-[2.5rem]">
                  Kajian Kitab Kuning Rutin & Pembekalan Akhlakul Karimah
                </h3>
              </div>
              <p class="hidden sm:block mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Memperdalam pemahaman kitab turats para ulama salaf guna membekali siswa/i akhir dengan akidah kokoh dan akhlak mulia.
              </p>
            </div>
          </div>
          <div class="px-3 pb-3 sm:px-5 sm:pb-5 pt-0">
            <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between">
              <span class="text-[10px] sm:text-xs font-semibold text-slate-600 flex items-center gap-1">
                <i class="fa-solid fa-book-quran text-emerald-600 text-[10px] sm:text-xs"></i>
                <span>Kitab Salaf</span>
              </span>
              <span class="text-[9px] sm:text-[10px] font-semibold text-sky-700 bg-sky-50 px-1.5 py-0.5 rounded border border-sky-200">
                Rutin
              </span>
            </div>
          </div>
        </article>

        <!-- Article 4: Vokasi & Keterampilan Siswa/i -->
        <article class="bg-white text-slate-800 border-t-4 border-purple-600 rounded-xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col group justify-between">
          <div class="flex flex-col flex-1">
            <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
              <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/facility-thumb-1.jpg') : asset('assets/images/facility-thumb-1.jpg') }}" 
                   alt="Pelatihan Digital & Vokasi Siswa/i" 
                   loading="lazy" decoding="async"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-emerald-950/90 text-amber-300 border-l-2 sm:border-l-3 border-amber-400 rounded text-[8px] sm:text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 sm:px-2.5 sm:py-1 shadow-md backdrop-blur-xs truncate max-w-[65%]">
                Vokasi
              </span>
            </div>
            <div class="p-3 sm:p-5 flex flex-col flex-1 justify-between">
              <div>
                <div class="flex items-center gap-1.5 sm:gap-2 text-[9px] sm:text-xs text-slate-500 mb-1.5 sm:mb-2.5 font-mono truncate">
                  <span class="flex items-center gap-1 shrink-0"><i class="fa-regular fa-calendar text-emerald-600"></i> 10 Okt 2026</span>
                  <span>•</span>
                  <span class="truncate max-w-[70px] sm:max-w-[100px]"><i class="fa-regular fa-user text-emerald-600"></i> Pembina TIK</span>
                </div>
                <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-[2.5rem]">
                  Workshop Literasi Digital & Keterampilan Desain Grafis Siswa/i
                </h3>
              </div>
              <p class="hidden sm:block mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                Pelatihan pemanfaatan teknologi informasi, desain grafis, dan multimedia berbasis laboratorium komputer untuk kemandirian siswa/i.
              </p>
            </div>
          </div>
          <div class="px-3 pb-3 sm:px-5 sm:pb-5 pt-0">
            <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between">
              <span class="text-[10px] sm:text-xs font-semibold text-slate-600 flex items-center gap-1">
                <i class="fa-solid fa-laptop-code text-purple-600 text-[10px] sm:text-xs"></i>
                <span>TIK</span>
              </span>
              <span class="text-[9px] sm:text-[10px] font-semibold text-purple-700 bg-purple-50 px-1.5 py-0.5 rounded border border-purple-200">
                Pelatihan
              </span>
            </div>
          </div>
        </article>
      @endif

    </div>

    <!-- Tombol Lihat Berita & Pengumuman Lainnya -->
    <div class="mt-8 sm:mt-12 text-center">
      <a href="{{ route('berita') }}" 
         class="inline-flex items-center gap-2.5 sm:gap-3 px-6 sm:px-8 py-3 sm:py-3.5 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-amber-400/20 hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-amber-600">
        <span>Lihat Berita & Pengumuman Lainnya</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
      <p class="mt-2.5 sm:mt-3 text-xs text-emerald-200/80">
        Jelajahi seluruh warta kegiatan, pengumuman ujian, kalender akademik, dan prestasi siswa/i Madrasah Aliyah Darun Najah.
      </p>
    </div>

  </div>
</section>
