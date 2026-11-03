@props(['teachers' => null])

@php
  $list = $teachers ?? \App\Models\Teacher::active()->featured()->orderBy('order', 'asc')->take(4)->get();
  if ($list->isEmpty()) {
      $list = \App\Models\Teacher::active()->orderBy('order', 'asc')->take(4)->get();
  }
@endphp

@if($list->isNotEmpty())
<!-- Dewan Guru & Asatidz Showcase Section (Modern Geometric Soft Style) -->
<section id="guru" class="py-12 sm:py-16 lg:py-24 bg-slate-50 relative overflow-hidden border-b border-slate-200 scroll-mt-16">
  
  <!-- Subtle Background Pattern Overlay -->
  <div class="absolute inset-0 opacity-20 pointer-events-none z-0 bg-[radial-gradient(#065f46_1px,transparent_1px)] [background-size:24px_24px]"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header with CTA button -->
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 sm:gap-6 mb-8 sm:mb-12 lg:mb-16">
      <div class="max-w-2xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 bg-emerald-100/80 text-emerald-900 text-[10px] sm:text-xs font-bold uppercase tracking-widest border-l-4 border-emerald-600 rounded-md shadow-xs mb-3 sm:mb-4">
          <i class="fa-solid fa-chalkboard-user text-emerald-700"></i>
          <span>Tenaga Pendidik & Dewan Guru</span>
        </div>
        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
          Dewan Guru & <span class="text-emerald-700">Tenaga Pendidik</span>
        </h2>
        <p class="mt-2.5 sm:mt-4 text-xs sm:text-base lg:text-lg text-slate-600 leading-relaxed">
          Dibimbing langsung oleh para dewan guru profesional berkualifikasi sarjana dan magister, serta pembina keagamaan bersanad keilmuan jelas.
        </p>
      </div>

      <div class="shrink-0">
        <a href="{{ route('guru') }}" 
           class="inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider px-4 py-2.5 sm:px-5 sm:py-3 rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-emerald-950">
          <span>Lihat Semua Dewan Guru</span>
          <i class="fa-solid fa-arrow-right text-amber-400"></i>
        </a>
      </div>
    </div>

    <!-- Teacher Cards Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-7">
      @foreach($list as $teacher)
      @php
        $badgeClass = match($teacher->category) {
          'pimpinan' => 'bg-amber-100 text-amber-900 border-amber-300',
          'asatidz_kitab' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
          'guru_mapel' => 'bg-blue-100 text-blue-900 border-blue-300',
          default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
      @endphp
      <div class="group bg-white rounded-xl sm:rounded-2xl border border-slate-200/90 hover:border-emerald-500 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between">
        
        <div class="flex flex-col flex-1">
          <!-- Photo Container with Aspect Ratio & Badges -->
          <div class="relative aspect-4/5 overflow-hidden bg-slate-100">
            <img src="{{ $teacher->photo_url }}" 
                 alt="{{ $teacher->name }}" 
                 loading="lazy"
                 decoding="async"
                 class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
            
            <!-- Category Badge -->
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10">
              <span class="inline-flex items-center px-1.5 py-0.5 sm:px-2.5 sm:py-1 rounded text-[9px] sm:text-[10px] font-bold uppercase tracking-wider border shadow-xs backdrop-blur-xs {{ $badgeClass }}">
                {{ $teacher->category_label }}
              </span>
            </div>

            <!-- NIY / NIP Tag Overlay at Bottom Left -->
            @if($teacher->nip_or_niy)
            <div class="absolute bottom-2 left-2 sm:bottom-3 sm:left-3 z-10">
              <span class="inline-block bg-slate-900/80 backdrop-blur-xs text-amber-300 text-[8px] sm:text-[10px] font-mono px-1.5 py-0.5 sm:px-2 rounded border border-slate-700/60 shadow-xs truncate max-w-[120px] sm:max-w-none">
                {{ $teacher->nip_or_niy }}
              </span>
            </div>
            @endif
          </div>

          <!-- Card Content Body -->
          <div class="p-3 sm:p-5 lg:p-6 flex flex-col flex-1 justify-between">
            <div>
              <h3 class="text-xs sm:text-base lg:text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition-colors leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-[2.5rem]">
                {{ $teacher->name }}
              </h3>

              <!-- Role / Jabatan -->
              <p class="text-[11px] sm:text-xs lg:text-sm font-semibold text-emerald-800 mt-1 line-clamp-1 flex items-center gap-1 sm:gap-1.5">
                <i class="fa-solid fa-briefcase text-[10px] sm:text-xs text-amber-500 shrink-0"></i>
                <span class="truncate">{{ $teacher->role }}</span>
              </p>
            </div>

            <!-- Riwayat Pendidikan / Pesantren -->
            @if($teacher->education)
            <div class="mt-2 pt-2 sm:mt-3 sm:pt-3 border-t border-slate-100 flex items-start gap-1 sm:gap-2 text-[10px] sm:text-xs text-slate-600">
              <i class="fa-solid fa-graduation-cap text-emerald-600 mt-0.5 shrink-0 text-[10px] sm:text-xs"></i>
              <span class="line-clamp-2 leading-relaxed font-medium">{{ $teacher->education }}</span>
            </div>
            @endif

            <!-- Bio Excerpt (Shown on Tablet & Desktop) -->
            @if($teacher->bio)
            <p class="hidden sm:block mt-2.5 text-xs text-slate-500 italic line-clamp-2 leading-relaxed">
              "{{ $teacher->bio }}"
            </p>
            @endif
          </div>
        </div>

        <!-- Card Footer Action -->
        <div class="px-3 pb-3 sm:px-5 sm:pb-5 lg:px-6 lg:pb-6 pt-0">
          <a href="{{ route('guru', ['kategori' => $teacher->category]) }}" 
             class="w-full inline-flex items-center justify-center gap-1 sm:gap-1.5 py-1.5 sm:py-2 px-2 sm:px-3 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 text-[10px] sm:text-xs font-semibold rounded-lg border border-slate-200 transition-colors">
            <span class="hidden sm:inline">Lihat Kategori Ini</span>
            <span class="sm:hidden">Lihat Profil</span>
            <i class="fa-solid fa-arrow-right text-[9px] sm:text-[10px]"></i>
          </a>
        </div>

      </div>
      @endforeach
    </div>

    <!-- Bottom Banner Notice -->
    <div class="mt-8 sm:mt-12 lg:mt-16 bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-950 rounded-2xl p-5 sm:p-8 text-white flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-6 shadow-md border-l-4 border-amber-400">
      <div class="flex items-center gap-3 sm:gap-4 text-center sm:text-left">
        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-400/20 text-amber-400 flex items-center justify-center text-lg sm:text-xl shrink-0">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <h4 class="font-bold text-sm sm:text-base lg:text-lg">Ingin Mengenal Lebih Dekat Seluruh Dewan Pengajar?</h4>
          <p class="text-[11px] sm:text-xs lg:text-sm text-emerald-100/90 mt-0.5">Kunjungi direktori resmi untuk menelusuri profil para pimpinan madrasah, dewan guru mata pelajaran, dan pengajar keagamaan.</p>
        </div>
      </div>
      <a href="{{ route('guru') }}" 
         class="shrink-0 w-full sm:w-auto text-center inline-flex items-center justify-center gap-2 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-extrabold text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl shadow-xs transition-colors">
        <span>Buka Direktori Guru</span>
        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
      </a>
    </div>

  </div>

</section>
@endif
