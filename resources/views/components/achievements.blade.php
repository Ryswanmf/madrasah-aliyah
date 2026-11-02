@props(['achievements' => null])

@php
  $list = $achievements ?? \App\Models\Achievement::active()->featured()->orderBy('order', 'asc')->take(4)->get();
@endphp

@if($list->isNotEmpty())
<!-- Prestasi & Kejuaraan Santri Section (Modern Soft Institutional Style) -->
<section id="prestasi" 
         class="py-16 lg:py-24 bg-slate-50 relative border-b border-slate-200 scroll-mt-16"
         x-data="{ 
           modalOpen: false, 
           activeImg: '', 
           activeTitle: '', 
           activeStudent: '', 
           activeDesc: '',
           openDetail(img, title, student, desc) {
             this.activeImg = img;
             this.activeTitle = title;
             this.activeStudent = student;
             this.activeDesc = desc;
             this.modalOpen = true;
           }
         }">
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 text-center md:text-left">
      <div class="max-w-2xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-950 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <i class="fa-solid fa-trophy text-amber-400"></i>
          <span>Prestasi Santri</span>
        </div>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
          Deretan Prestasi & <span class="text-emerald-800">Kejuaraan</span>
        </h2>
        <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
          Bukti nyata dedikasi santri dan asatidz MA Darun Najah Sambikarto dalam mengukir karya dan mengharumkan nama almamater di berbagai ajang kompetisi.
        </p>
      </div>

      <div class="shrink-0 flex justify-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-900 rounded-lg text-xs font-bold border border-amber-300 shadow-xs">
          <i class="fa-solid fa-medal text-amber-600"></i>
          <span>Prestasi Terverifikasi</span>
        </div>
      </div>
    </div>

    <!-- Achievement Grid (4 Kolom / 2 Kolom Mobile) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($list as $ach)
      @php
        $badgeColor = match($ach->level) {
          'nasional', 'internasional' => 'bg-emerald-900 text-amber-300 border-amber-400',
          'provinsi' => 'bg-amber-500 text-emerald-950 border-amber-600 font-bold',
          'kabupaten' => 'bg-sky-900 text-white border-sky-600',
          default => 'bg-slate-800 text-slate-200 border-slate-600',
        };
        $catLabel = match($ach->category) {
          'seni' => 'Seni Islami',
          'keagamaan' => 'Kajian Kitab (MQK)',
          'tahfidz' => 'Tahfidzul Qur\'an',
          'akademik' => 'Sains & Akademik',
          'olahraga' => 'Olahraga & Beladiri',
          default => ucfirst($ach->category),
        };
      @endphp
      <div @click="openDetail('{{ $ach->image_url }}', '{{ addslashes($ach->title) }}', '{{ addslashes($ach->student_name ?? '') }}', '{{ addslashes($ach->description ?? '') }}')"
           class="group bg-white rounded-xl border-t-4 border-emerald-700 border-x border-b border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer flex flex-col justify-between">
        
        <div>
          <!-- Visual Thumbnail -->
          <div class="aspect-4/3 overflow-hidden bg-slate-100 relative">
            <img src="{{ $ach->image_url }}" alt="{{ $ach->title }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            
            <!-- Category Badge -->
            <div class="absolute top-3 left-3 bg-emerald-950/85 text-amber-300 text-[10px] font-bold px-2.5 py-1 rounded-md border border-emerald-700/60 shadow-xs backdrop-blur-xs flex items-center gap-1.5">
              <i class="fa-solid fa-award text-amber-400"></i>
              <span>{{ $catLabel }}</span>
            </div>

            <!-- Level Badge -->
            <div class="absolute bottom-3 right-3 text-[10px] font-semibold px-2.5 py-1 rounded-md border shadow-xs backdrop-blur-xs {{ $badgeColor }}">
              {{ $ach->level_label }}
            </div>
          </div>

          <!-- Content Info -->
          <div class="p-5">
            <span class="text-[11px] font-mono text-slate-400 block mb-1">
              <i class="fa-regular fa-calendar text-xs mr-1"></i> Tahun {{ $ach->year }}
            </span>
            <h3 class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 transition-colors line-clamp-2 leading-snug">
              {{ $ach->title }}
            </h3>
            
            @if(!empty($ach->student_name))
            <p class="text-xs font-semibold text-emerald-800 mt-2 flex items-center gap-1.5">
              <i class="fa-solid fa-user-graduate text-amber-600"></i>
              <span>{{ $ach->student_name }}</span>
            </p>
            @endif

            @if(!empty($ach->description))
            <p class="text-xs text-slate-600 mt-2 line-clamp-2 leading-relaxed">
              {{ $ach->description }}
            </p>
            @endif
          </div>
        </div>

        <div class="px-5 pb-5 pt-0">
          <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-emerald-700 font-semibold group-hover:text-emerald-800">
            <span>Lihat Bukti Prestasi</span>
            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
          </div>
        </div>

      </div>
      @endforeach
    </div>

  </div>

  <!-- Detail Modal Lightbox -->
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
    <div @click.away="modalOpen = false" class="relative max-w-2xl w-full bg-white rounded-2xl overflow-hidden shadow-2xl border-t-4 border-amber-400">
      
      <!-- Close Button -->
      <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 w-9 h-9 bg-slate-900/80 text-white hover:bg-amber-500 hover:text-slate-950 rounded-lg flex items-center justify-center transition-all border border-slate-700 shadow-md">
        <i class="fa-solid fa-xmark text-base"></i>
      </button>

      <!-- Modal Image -->
      <div class="max-h-[60vh] flex items-center justify-center bg-slate-950 p-2">
        <img :src="activeImg" :alt="activeTitle" class="max-h-[56vh] w-auto max-w-full object-contain rounded-lg">
      </div>

      <!-- Modal Content -->
      <div class="p-6 bg-white space-y-2">
        <h3 x-text="activeTitle" class="font-extrabold text-base sm:text-lg text-slate-900"></h3>
        <p x-show="activeStudent" class="text-xs sm:text-sm font-semibold text-emerald-800 flex items-center gap-1.5">
          <i class="fa-solid fa-user-graduate text-amber-600"></i>
          <span x-text="activeStudent"></span>
        </p>
        <p x-show="activeDesc" x-text="activeDesc" class="text-xs sm:text-sm text-slate-600 leading-relaxed pt-1"></p>
      </div>

    </div>
  </div>

</section>
@endif
