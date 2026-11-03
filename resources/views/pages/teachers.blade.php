@extends('layouts.app')

@section('title', 'Dewan Guru & Tenaga Kependidikan • Madrasah Aliyah Darun Najah')

@section('content')
<!-- Teachers Directory Page Container -->
<div class="bg-slate-50 min-h-screen">

  <!-- 1. Hero Header Banner (Signature Green & Islamic Pattern Blend) -->
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
        <span class="text-amber-300">Dewan Guru & Tenaga Pendidik</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Tenaga Pendidik Berdedikasi</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Direktori Dewan Guru & <span class="text-amber-400">Tenaga Pendidik</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Mengenal kepala madrasah, dewan guru mata pelajaran, pengajar keagamaan, serta tenaga kependidikan MA Darun Najah Sambikarto yang siap membina akhlak dan potensi akademik para siswa.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Main Directory Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-between gap-4 mb-10 pb-4 border-b border-slate-200">
        <div class="flex flex-wrap gap-2 sm:gap-2.5">
          
          <!-- All -->
          <a href="{{ route('guru', ['kategori' => 'all']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? 'all') === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-users"></i>
            <span>Semua Pendidik</span>
            <span class="ml-1 text-[10px] px-1.5 py-0.2 rounded-full {{ ($currentCategory ?? 'all') === 'all' ? 'bg-amber-400 text-emerald-950 font-extrabold' : 'bg-slate-100 text-slate-600' }}">
              {{ $categoriesCount['all'] ?? 0 }}
            </span>
          </a>

          <!-- Pimpinan -->
          <a href="{{ route('guru', ['kategori' => 'pimpinan']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'pimpinan' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-star-and-crescent"></i>
            <span>Pimpinan Madrasah</span>
            <span class="ml-1 text-[10px] px-1.5 py-0.2 rounded-full {{ ($currentCategory ?? '') === 'pimpinan' ? 'bg-amber-400 text-emerald-950 font-extrabold' : 'bg-slate-100 text-slate-600' }}">
              {{ $categoriesCount['pimpinan'] ?? 0 }}
            </span>
          </a>

          <!-- Asatidz Kitab -->
          <a href="{{ route('guru', ['kategori' => 'asatidz_kitab']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'asatidz_kitab' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-book-quran"></i>
            <span>Guru Keagamaan & Kitab</span>
            <span class="ml-1 text-[10px] px-1.5 py-0.2 rounded-full {{ ($currentCategory ?? '') === 'asatidz_kitab' ? 'bg-amber-400 text-emerald-950 font-extrabold' : 'bg-slate-100 text-slate-600' }}">
              {{ $categoriesCount['asatidz_kitab'] ?? 0 }}
            </span>
          </a>

          <!-- Guru Mapel -->
          <a href="{{ route('guru', ['kategori' => 'guru_mapel']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'guru_mapel' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Guru Mapel Umum</span>
            <span class="ml-1 text-[10px] px-1.5 py-0.2 rounded-full {{ ($currentCategory ?? '') === 'guru_mapel' ? 'bg-amber-400 text-emerald-950 font-extrabold' : 'bg-slate-100 text-slate-600' }}">
              {{ $categoriesCount['guru_mapel'] ?? 0 }}
            </span>
          </a>

          <!-- Staf TU -->
          <a href="{{ route('guru', ['kategori' => 'staf']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'staf' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-id-card-clip"></i>
            <span>Tenaga Kependidikan & TU</span>
            <span class="ml-1 text-[10px] px-1.5 py-0.2 rounded-full {{ ($currentCategory ?? '') === 'staf' ? 'bg-amber-400 text-emerald-950 font-extrabold' : 'bg-slate-100 text-slate-600' }}">
              {{ $categoriesCount['staf'] ?? 0 }}
            </span>
          </a>

        </div>

        <div class="text-xs text-slate-500 font-medium">
          Menampilkan <span class="font-bold text-slate-800">{{ $teachers->total() }}</span> profil
        </div>
      </div>

      <!-- Teachers Grid (3 Columns on Desktop, 2 on Tablet, 1 on Mobile) -->
      @if($teachers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          @foreach($teachers as $teacher)
          @php
            $badgeClass = match($teacher->category) {
              'pimpinan' => 'bg-amber-100 text-amber-900 border-amber-300',
              'asatidz_kitab' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
              'guru_mapel' => 'bg-blue-100 text-blue-900 border-blue-300',
              default => 'bg-slate-100 text-slate-800 border-slate-300',
            };
          @endphp
          <div class="group bg-white rounded-2xl border border-slate-200/90 hover:border-emerald-500 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
            
            <div>
              <!-- Photo Container with Aspect Ratio & Tags -->
              <div class="relative aspect-4/5 overflow-hidden bg-slate-100">
                <img src="{{ $teacher->photo_url }}" 
                     alt="{{ $teacher->name }}" 
                     loading="lazy"
                     decoding="async"
                     class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                
                <!-- Category Badge -->
                <div class="absolute top-3 left-3 z-10">
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider border shadow-xs backdrop-blur-xs {{ $badgeClass }}">
                    {{ $teacher->category_label }}
                  </span>
                </div>

                <!-- Featured Star Badge if is_featured -->
                @if($teacher->is_featured)
                <div class="absolute top-3 right-3 z-10">
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[10px] font-bold bg-amber-400 text-emerald-950 border border-amber-300 shadow-xs">
                    <i class="fa-solid fa-star text-[9px]"></i>
                    <span>Pendidik Inti</span>
                  </span>
                </div>
                @endif

                <!-- NIY/NIP Tag Overlay at Bottom -->
                @if($teacher->nip_or_niy)
                <div class="absolute bottom-3 left-3 z-10">
                  <span class="inline-block bg-slate-900/85 backdrop-blur-xs text-amber-300 text-[10px] font-mono px-2.5 py-0.5 rounded border border-slate-700/60 shadow-xs">
                    NIY/NIP: {{ $teacher->nip_or_niy }}
                  </span>
                </div>
                @endif
              </div>

              <!-- Card Content Body -->
              <div class="p-6">
                <!-- Name -->
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition-colors leading-snug">
                  {{ $teacher->name }}
                </h3>

                <!-- Role / Jabatan -->
                <p class="text-xs sm:text-sm font-semibold text-emerald-800 mt-1 flex items-center gap-2">
                  <i class="fa-solid fa-briefcase text-xs text-amber-500 shrink-0"></i>
                  <span>{{ $teacher->role }}</span>
                </p>

                <!-- Riwayat Pendidikan / Pesantren -->
                @if($teacher->education)
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-start gap-2.5 text-xs text-slate-600">
                  <i class="fa-solid fa-graduation-cap text-emerald-600 mt-0.5 shrink-0"></i>
                  <div>
                    <span class="block font-semibold text-slate-700">Riwayat Pendidikan / Almamater:</span>
                    <span class="leading-relaxed">{{ $teacher->education }}</span>
                  </div>
                </div>
                @endif

                <!-- Bio / Motto / Nasehat -->
                @if($teacher->bio)
                <div class="mt-3.5 p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600 italic leading-relaxed">
                  <span class="text-amber-500 font-serif text-sm mr-1">“</span>{{ $teacher->bio }}<span class="text-amber-500 font-serif text-sm ml-1">”</span>
                </div>
                @endif
              </div>
            </div>

            <!-- Card Bottom Bar: WhatsApp Chat if phone available -->
            <div class="px-6 pb-6 pt-0">
              @if($teacher->phone)
              @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $teacher->phone);
                if (str_starts_with($cleanPhone, '0')) {
                    $cleanPhone = '62' . substr($cleanPhone, 1);
                }
              @endphp
              <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Assalamu\'alaikum Wr. Wb. Ustadz/Ustadzah ' . $teacher->name) }}" 
                 target="_blank" 
                 rel="noopener noreferrer" 
                 class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-semibold rounded-lg border border-emerald-200 transition-colors">
                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                <span>Hubungi via WhatsApp</span>
              </a>
              @else
              <div class="w-full py-1 text-center">
                <span class="text-[11px] text-slate-400">Tersedia pada jam dinas kantor</span>
              </div>
              @endif
            </div>

          </div>
          @endforeach
        </div>

        <!-- Pagination Section -->
        <div class="mt-12 flex justify-center">
          {{ $teachers->links() }}
        </div>
      @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-xl mx-auto shadow-xs">
          <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa-solid fa-user-slash"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900">Belum Ada Data Pendidik</h3>
          <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
            Data tenaga pendidik untuk kategori ini sedang dalam tahap pemutakhiran oleh pihak tata usaha.
          </p>
          <a href="{{ route('guru', ['kategori' => 'all']) }}" 
             class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-emerald-800 text-white text-xs font-bold rounded-lg hover:bg-emerald-900 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Semua Pendidik</span>
          </a>
        </div>
      @endif

      <!-- Call to Action Banner PPDB -->
      <div class="mt-16 bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-950 rounded-2xl p-8 sm:p-10 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl border-l-4 border-amber-400">
        <div class="max-w-2xl text-center md:text-left">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-800/80 rounded-md text-amber-300 text-xs font-bold uppercase tracking-wider mb-2">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Bergabunglah Bersama Kami</span>
          </div>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Daftarkan Putra-Putri Anda di Madrasah Aliyah Darun Najah</h3>
          <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
            Dapatkan pendidikan Islam unggul yang memadukan kurikulum Kementerian Agama dan nilai-nilai keislaman di bawah bimbingan dewan guru berpengalaman.
          </p>
        </div>
        <div class="shrink-0 flex flex-wrap gap-3">
          <a href="{{ route('ppdb') }}" 
             class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs uppercase tracking-wider px-6 py-3 rounded-xl shadow-md transition-all">
            <i class="fa-solid fa-file-pen"></i>
            <span>Daftar PPDB Online</span>
          </a>
          <a href="{{ route('kontak') }}" 
             class="inline-flex items-center gap-2 bg-emerald-800/80 hover:bg-emerald-700/80 text-white font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl border border-emerald-600 transition-all">
            <i class="fa-solid fa-envelope"></i>
            <span>Kontak Kami</span>
          </a>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
