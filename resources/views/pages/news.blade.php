@extends('layouts.app')

@section('title', 'Warta, Kabar & Pengumuman Resmi • Madrasah Aliyah Darun Najah')

@section('content')
<!-- News Page Container -->
<div class="bg-slate-50 min-h-screen" 
     x-data="{ 
       activeCategory: 'all',
       searchQuery: '',
       modalOpen: false, 
       activeArticle: null,
       @if(isset($dynamicArticles) && count($dynamicArticles) > 0)
       articles: @js($dynamicArticles),
       @else
       articles: [
         {
           id: 1,
           category: 'ppdb',
           categoryLabel: 'PPDB 2026/2027',
           date: '2 November 2026',
           author: 'Humas MA',
           title: 'Pembukaan PPDB MA Darun Najah Sambikarto Tahun Ajaran 2026/2027',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}',
           excerpt: 'Pendaftaran peserta didik baru kini telah dibuka secara online melalui website resmi dengan jalur reguler dan beasiswa tahfidz Al-Qur\'an.',
           content: 'Penerimaan Peserta Didik Baru (PPDB) MA Darun Najah Sambikarto untuk Tahun Ajaran 2026/2027 resmi dibuka mulai 2 November 2026. Calon siswa dari berbagai daerah dapat memilih opsi fasilitas asrama madrasah maupun kelas reguler. Tersedia beasiswa penuh bebas SPP untuk calon peserta didik penghafal Al-Qur\'an minimal 3 juz dan siswa berprestasi tingkat kabupaten/provinsi. Pendaftaran dapat dilakukan langsung secara online melalui portal website resmi ini 24 jam nonstop.'
         },
         {
           id: 2,
           category: 'prestasi',
           categoryLabel: 'Prestasi Siswa/i',
           date: '28 Oktober 2026',
           author: 'Kesiswaan',
           title: 'Siswa/i MA Darun Najah Raih Juara Seni Hadroh & Kaligrafi Tingkat Kabupaten',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg') }}',
           excerpt: 'Grup Hadroh Ash-Shofwah dan siswa/i kaligrafi madrasah sukses memboyong piala kejuaraan festival seni Islam se-Lampung Timur.',
           content: 'Prestasi membanggakan kembali ditorehkan siswa/i MA Darun Najah Sambikarto dalam Festival Seni Islam tingkat Kabupaten Lampung Timur yang digelar pekan ini. Grup Hadroh Shalawat Ash-Shofwah berhasil meraih Juara 1 kategori Hadroh Klasik, sementara perwakilan cabang kaligrafi kontemporer berhasil menyabet Juara 2. Kepala Madrasah menyampaikan apresiasi setinggi-tingginya kepada para siswa/i dan pembina ekstrakurikuler atas dedikasi dan kerja keras yang membuahkan hasil gemilang.'
         },
         {
           id: 3,
           category: 'pesantren',
           categoryLabel: 'Kepesantrenan',
           date: '15 Oktober 2026',
           author: 'Dewan Asatidz',
           title: 'Kajian Kitab Kuning Rutin & Pembekalan Akhlakul Karimah Siswa/i Akhir',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}',
           excerpt: 'Memperdalam pemahaman kitab turats para ulama salaf guna membekali siswa/i akhir dengan akidah kokoh dan budi pekerti luhur.',
           content: 'Sebagai ikhtiar memperkuat pondasi keagamaan siswa kelas akhir, Madrasah Aliyah Darun Najah menyelenggarakan pengajian kitab kuning kilat (dauroh ilmiah turats) mengkaji kitab Fathul Qorib dan Ta\'limul Muta\'allim. Pembekalan ini dipimpin langsung oleh pembina keagamaan KH. Sahlan Abdulloh dan KH. Abdul Ghofar, S.Pd.I, yang menekankan pentingnya adab penuntut ilmu, sanad keilmuan yang bersambung, dan kesiapan mengabdi di tengah-tengah masyarakat luas.'
         },
         {
           id: 4,
           category: 'akademik',
           categoryLabel: 'Vokasi & TIK',
           date: '10 Oktober 2026',
           author: 'Pembina TIK',
           title: 'Workshop Literasi Digital & Keterampilan Desain Grafis Siswa/i Mandiri',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/facility-thumb-1.jpg') : asset('assets/images/facility-thumb-1.jpg') }}',
           excerpt: 'Pelatihan pemanfaatan teknologi informasi, desain grafis, dan multimedia berbasis laboratorium komputer untuk kemandirian siswa/i.',
           content: 'Menghadapi era transformasi digital, MA Darun Najah Sambikarto mengadakan pelatihan intensif desain grafis dan konten edukasi islami di Laboratorium Komputer Madrasah. Kegiatan ini diikuti oleh 40 perwakilan siswa dan siswi. Materi yang diajarkan meliputi dasar-dasar desain publikasi, editing video dakwah, dan pengelolaan web madrasah guna membekali siswa/i dengan life-skill yang aplikatif di era modern.'
         },
         {
           id: 5,
           category: 'akademik',
           categoryLabel: 'Bimbingan Karir',
           date: '1 Oktober 2026',
           author: 'Guru BK',
           title: 'Sosialisasi Seleksi Masuk Perguruan Tinggi Negeri (SNBP & SPAN-PTKIN)',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-1.jpg') : asset('assets/images/gallery-1.jpg') }}',
           excerpt: 'Bimbingan intensif persiapan studi lanjut ke Perguruan Tinggi Negeri dan PTKIN (UIN/IAIN) bagi siswa/i kelas XII.',
           content: 'Tim Bimbingan Konseling (BK) MA Darun Najah menggelar sosialisasi seleksi masuk perguruan tinggi bagi seluruh siswa kelas XII. Sosialisasi mencakup jalur prestasi raport (SNBP & SPAN-PTKIN), jalur tes berbasis komputer (SNBT & UM-PTKIN), serta peluang beasiswa KIP-Kuliah dan beasiswa siswa/i berprestasi Kemenag RI.'
         },
         {
           id: 6,
           category: 'kegiatan',
           categoryLabel: 'Hari Besar',
           date: '22 Oktober 2026',
           author: 'OSIM MA',
           title: 'Peringatan Hari Santri Nasional & Apel Akbar Siswa/i Sambikarto',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-3.jpg') : asset('assets/images/gedung-3.jpg') }}',
           excerpt: 'Ratusan siswa/i dan guru MA Darun Najah menggelar apel akbar memperingati Hari Santri Nasional 22 Oktober.',
           content: 'Dengan mengenakan pakaian rapi bernuansa islami, ratusan siswa/i MA Darun Najah Sambikarto memadati lapangan upacara utama dalam peringatan Hari Santri Nasional 2026. Acara dilanjutkan dengan pawai ta\'aruf, pembacaan ikrar pelajar, dan pentas seni kreasi siswa/i bernuansa islami.'
         },
         {
           id: 7,
           category: 'akademik',
           categoryLabel: 'Ujian Nasional',
           date: '18 September 2026',
           author: 'Proktor ANBK',
           title: 'Simulasi Asesmen Nasional Berbasis Komputer (ANBK) Berjalan Tertib',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/facility-thumb-3.jpg') : asset('assets/images/facility-thumb-3.jpg') }}',
           excerpt: 'Kesiapan sarana laboratorium komputer dan jaringan internet terbukti handal dalam pelaksanaan gladi bersih asesmen nasional.',
           content: 'Pelaksanaan gladi bersih Asesmen Nasional Berbasis Komputer (ANBK) di MA Darun Najah berlangsung lancar tanpa kendala teknis. Didukung fasilitas 30 unit komputer dan koneksi serat optik yang stabil, para siswa/i dapat menyelesaikan asesmen literasi dan numerasi dengan fokus dan percaya diri.'
         },
         {
           id: 8,
           category: 'pesantren',
           categoryLabel: 'Wisuda Siswa/i',
           date: '5 September 2026',
           author: 'Panitia Wisuda',
           title: 'Wisuda Purnawiyata & Khotmil Qur\'an Siswa Madrasah Aliyah',
           img: '{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-4.jpg') : asset('assets/images/gedung-4.jpg') }}',
           excerpt: 'Prosesi wisuda penuh haru atas kelulusan siswa angkatan ke-X dan wisuda hafalan Al-Qur\'an 30 Juz bagi siswa berprestasi.',
           content: 'Suasana haru dan syukur mewarnai prosesi wisuda purnawiyata siswa MA Darun Najah Sambikarto di Aula Kampus. Selain melepas kelulusan formal, acara dirangkai dengan wisuda Khotmil Qur\'an disaksikan oleh dewan guru dan orang tua/wali murid.'
         }
       ],
       @endif
       openDetail(article) {
         this.activeArticle = article;
         this.modalOpen = true;
       },
       matchesFilter(article) {
         const matchCat = (this.activeCategory === 'all' || 
           (this.activeCategory === 'featured' && article.is_featured) || 
           article.category === this.activeCategory);
         const matchSearch = (!this.searchQuery || 
           article.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
           article.excerpt.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
           article.categoryLabel.toLowerCase().includes(this.searchQuery.toLowerCase()));
         return matchCat && matchSearch;
       }
     }">

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-1.jpg') : asset('assets/images/gallery-1.jpg') }}" 
           alt="Warta MA Darun Najah" 
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
        <span class="text-amber-300">Warta & Pengumuman</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Pusat Berita & Informasi Resmi</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Warta, Kabar & <span class="text-amber-400">Pengumuman</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Kilas kegiatan pembelajaran madrasah, prestasi gemilang para siswa, pengumuman resmi akademik, serta dinamika kegiatan keagamaan Madrasah Aliyah Darun Najah Sambikarto.
        </p>
      </div>

      <!-- Quick Search Bar inside Hero -->
      <div class="mt-8 max-w-xl">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-700">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <input type="text" 
                 x-model="searchQuery" 
                 placeholder="Cari berita atau pengumuman (misal: PPDB, hadroh, beasiswa, ANBK)..." 
                 class="w-full pl-11 pr-4 py-3.5 bg-white text-slate-800 rounded-xl text-sm placeholder:text-slate-400 shadow-xl border-2 border-emerald-500/40 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition-all">
          <button x-show="searchQuery" 
                  @click="searchQuery = ''" 
                  type="button" 
                  class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>
      </div>

    </div>
  </section>

  <!-- 2. Main News Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Category Filter Tabs (Soft Rounded Style) -->
      <div class="flex flex-wrap gap-1.5 sm:gap-2.5 mb-6 sm:mb-10 pb-3 sm:pb-4 border-b border-slate-200">
        <button @click="activeCategory = 'all'" 
                :class="activeCategory === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-newspaper text-xs"></i>
          <span>Semua Berita</span>
        </button>

        <button @click="activeCategory = 'featured'" 
                :class="activeCategory === 'featured' ? 'bg-amber-400 text-emerald-950 border-amber-500 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-star text-xs" :class="activeCategory === 'featured' ? 'text-emerald-950' : 'text-amber-500'"></i>
          <span>Berita Unggulan</span>
        </button>

        <button @click="activeCategory = 'ppdb'" 
                :class="activeCategory === 'ppdb' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-graduation-cap text-xs"></i>
          <span>PPDB</span>
        </button>

        <button @click="activeCategory = 'prestasi'" 
                :class="activeCategory === 'prestasi' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-trophy text-xs"></i>
          <span>Prestasi Siswa/i</span>
        </button>

        <button @click="activeCategory = 'pesantren'" 
                :class="activeCategory === 'pesantren' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-book-quran text-xs"></i>
          <span>Kepesantrenan</span>
        </button>

        <button @click="activeCategory = 'akademik'" 
                :class="activeCategory === 'akademik' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-laptop-code text-xs"></i>
          <span>Akademik & TIK</span>
        </button>

        <button @click="activeCategory = 'kegiatan'" 
                :class="activeCategory === 'kegiatan' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium'"
                class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center gap-1.5 sm:gap-2">
          <i class="fa-solid fa-calendar-check text-xs"></i>
          <span>Kegiatan</span>
        </button>
      </div>

      <!-- Articles Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
        
        <template x-for="item in articles" :key="item.id">
          <article x-show="matchesFilter(item)"
                   class="bg-white text-slate-800 border-t-4 border-emerald-600 border-x border-b border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
            <a :href="item.slug ? ('/berita/' + item.slug) : '#'" 
               @click="if(!item.slug) { $event.preventDefault(); openDetail(item); }"
               class="block cursor-pointer flex flex-col flex-1">
              <div class="relative overflow-hidden aspect-16/10 bg-slate-100">
                <img :src="item.img" :alt="item.title" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-emerald-950/90 text-amber-300 border-l-2 sm:border-l-3 border-amber-400 rounded text-[8px] sm:text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 sm:px-2.5 sm:py-1 shadow-md backdrop-blur-xs truncate max-w-[65%]" x-text="item.categoryLabel"></span>
                <span x-show="item.is_featured" 
                      class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-amber-400 text-emerald-950 font-black text-[8px] sm:text-[10px] uppercase tracking-wider px-1.5 py-0.5 rounded shadow flex items-center gap-1 z-10">
                  <i class="fa-solid fa-star text-[8px]"></i>
                  <span class="hidden sm:inline">Unggulan</span>
                </span>
              </div>
              <div class="p-3 sm:p-5 flex flex-col flex-1 justify-between">
                <div>
                  <div class="flex items-center gap-1.5 sm:gap-2 text-[9px] sm:text-xs text-slate-400 mb-1.5 sm:mb-2.5 font-mono truncate">
                    <span class="flex items-center gap-1 shrink-0"><i class="fa-regular fa-calendar text-emerald-600"></i> <span x-text="item.date"></span></span>
                    <span>•</span>
                    <span class="truncate max-w-[70px] sm:max-w-[100px]" x-text="item.author"></span>
                  </div>
                  <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight sm:leading-snug min-h-[2rem] sm:min-h-[2.5rem]" x-text="item.title"></h3>
                </div>
                <p class="hidden sm:block mt-2 text-xs text-slate-600 line-clamp-3 leading-relaxed" x-text="item.excerpt"></p>
              </div>
            </a>
            <div class="px-3 pb-3 sm:px-5 sm:pb-5 pt-0">
              <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between text-[10px] sm:text-xs font-semibold text-emerald-700">
                <a :href="item.slug ? ('/berita/' + item.slug) : '#'"
                   @click="if(!item.slug) { $event.preventDefault(); openDetail(item); }"
                   class="inline-flex items-center gap-1 font-bold hover:text-amber-600 transition-colors">
                  <span class="hidden sm:inline">Baca Selengkapnya</span>
                  <span class="sm:hidden">Baca</span>
                  <i class="fa-solid fa-arrow-right text-[8px] sm:text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
                <span class="text-[9px] sm:text-[11px] text-slate-400 font-normal truncate max-w-[70px] sm:max-w-none" x-text="item.reading_time || '2 menit baca'"></span>
              </div>
            </div>
          </article>
        </template>

      </div>

      <!-- 3. Important Notices / Pengumuman Banner -->
      <div class="mt-16 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
          <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-bullhorn"></i>
          </div>
          <div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900">Papan Pengumuman & Dokumen Unduhan</h3>
            <p class="text-xs text-slate-500">Informasi penting dan jadwal agenda akademik madrasah.</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5">
            <i class="fa-solid fa-file-pdf text-red-500 text-2xl mt-0.5"></i>
            <div>
              <h4 class="font-bold text-sm text-slate-900">Brosur PPDB 2026/2027</h4>
              <p class="text-xs text-slate-500 mt-1">Rincian alur pendaftaran, syarat, dan jalur beasiswa.</p>
              <a href="{{ url('/') }}#ppdb" class="inline-block mt-2 text-xs font-bold text-emerald-700 hover:text-emerald-900">Lihat Formulir &rarr;</a>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5">
            <i class="fa-solid fa-calendar-days text-emerald-600 text-2xl mt-0.5"></i>
            <div>
              <h4 class="font-bold text-sm text-slate-900">Kalender Akademik Siswa/i</h4>
              <p class="text-xs text-slate-500 mt-1">Jadwal kegiatan madrasah, ujian semester, dan kalender pendidikan.</p>
              <a href="{{ route('faq') }}" class="inline-block mt-2 text-xs font-bold text-emerald-700 hover:text-emerald-900">Tanya Jadwal &rarr;</a>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3.5">
            <i class="fa-solid fa-award text-amber-500 text-2xl mt-0.5"></i>
            <div>
              <h4 class="font-bold text-sm text-slate-900">Syarat Beasiswa Tahfidz</h4>
              <p class="text-xs text-slate-500 mt-1">Pedoman seleksi calon siswa/i penghafal Al-Qur'an 3 Juz mutqin.</p>
              <a href="https://wa.me/6285658973426?text=Halo%20Admin,%20saya%20ingin%20tanya%20syarat%20beasiswa%20tahfidz%20MA%20Darun%20Najah" target="_blank" rel="noopener noreferrer" class="inline-block mt-2 text-xs font-bold text-emerald-700 hover:text-emerald-900">Konsultasi WA &rarr;</a>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. CTA Card -->
      <div class="mt-10 bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-newspaper"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>PPDB Online Aktif</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Siap Mengukir Prestasi Bersama Madrasah Aliyah Darun Najah?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Daftarkan diri Anda sekarang juga secara online atau kunjungi sekretariat kami di Sambikarto, Sekampung, Lampung Timur.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ url('/') }}#ppdb" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Daftar PPDB Online</span>
            </a>

            <a href="https://wa.me/6285658973426" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-brands fa-whatsapp text-sm"></i>
              <span>Hubungi Panitia</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Article Detail Modal Dialog -->
  <div x-show="modalOpen" 
       x-transition:enter="transition-opacity ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @keydown.escape.window="modalOpen = false"
       @click="modalOpen = false"
       x-cloak
       class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4">
    
    <div @click.stop class="relative max-w-2xl w-full bg-white rounded-2xl overflow-hidden shadow-2xl border-2 border-emerald-800 max-h-[90vh] flex flex-col" x-show="activeArticle">
      
      <!-- Close Button -->
      <button @click="modalOpen = false" 
              class="absolute top-4 right-4 z-10 w-9 h-9 bg-slate-900/80 text-white hover:bg-amber-500 hover:text-slate-950 rounded-lg flex items-center justify-center transition-all border border-slate-700 shadow-md">
        <i class="fa-solid fa-xmark text-base"></i>
      </button>

      <!-- Modal Image Header -->
      <div class="relative aspect-16/9 bg-slate-900 shrink-0 overflow-hidden">
        <img :src="activeArticle?.img" :alt="activeArticle?.title" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
        <span class="absolute bottom-4 left-4 bg-emerald-900 text-amber-300 border-l-2 border-amber-400 rounded text-xs font-bold uppercase tracking-wider px-2.5 py-1" x-text="activeArticle?.categoryLabel"></span>
      </div>

      <!-- Modal Body Content (Scrollable) -->
      <div class="p-6 sm:p-8 overflow-y-auto space-y-4">
        <div class="flex items-center gap-3 text-xs text-slate-500 font-mono">
          <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-emerald-600"></i> <span x-text="activeArticle?.date"></span></span>
          <span>•</span>
          <span class="flex items-center gap-1.5"><i class="fa-regular fa-user text-emerald-600"></i> <span x-text="activeArticle?.author"></span></span>
        </div>

        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug" x-text="activeArticle?.title"></h2>
        
        <div class="text-sm sm:text-base text-slate-700 leading-relaxed space-y-3 border-t border-slate-100 pt-4">
          <p x-text="activeArticle?.content"></p>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
          <span class="text-xs text-slate-400 font-mono">Madrasah Aliyah Darun Najah</span>
          <button @click="modalOpen = false" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-lg transition-colors">
            Tutup
          </button>
        </div>
      </div>

    </div>
  </div>

</div>
@endsection
