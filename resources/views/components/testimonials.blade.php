@props(['testimonials' => null])

@php
  $list = $testimonials ?? \App\Models\Testimonial::active()->featured()->orderBy('order', 'asc')->take(4)->get();
@endphp

@if($list->isNotEmpty())
<!-- Testimoni & Suara Alumni Section (Modern Soft Institutional Style) -->
<section id="testimoni" class="py-12 sm:py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900 scroll-mt-16">
  
  <!-- Subtle Background Pattern Overlay -->
  <div class="absolute inset-0 opacity-15 pointer-events-none z-0 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-8 sm:mb-14 text-center sm:text-left">
      <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 bg-emerald-900/90 text-amber-300 text-[10px] sm:text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-3 sm:mb-4">
        <i class="fa-solid fa-comment-dots text-amber-400"></i>
        <span>Suara Alumni & Wali Murid</span>
      </div>
      <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
        Kisah Nyata, Kesan & <span class="text-amber-400">Testimoni</span>
      </h2>
      <p class="mt-2.5 sm:mt-4 text-xs sm:text-base lg:text-lg text-emerald-100/90 leading-relaxed">
        Dengarkan pengalaman langsung dari alumni yang telah berkhidmat di masyarakat serta para orang tua / wali murid yang mempercayakan amanah pendidikan putera-puterinya di Madrasah Aliyah Darun Najah.
      </p>
    </div>

    <!-- Testimonials Grid: 2 Columns Mobile (2 2), 4 Columns Desktop -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
      @foreach($list as $item)
      @php
        $badgeClass = match($item->category) {
          'alumni' => 'bg-emerald-900/80 text-amber-300 border-amber-400',
          'wali_santri', 'wali_murid' => 'bg-amber-500/20 text-amber-300 border-amber-400',
          'santri', 'siswa' => 'bg-sky-500/20 text-sky-300 border-sky-400',
          default => 'bg-slate-800 text-slate-200 border-slate-600',
        };
      @endphp
      <div class="group relative bg-emerald-900/60 hover:bg-emerald-900/90 border-t-4 border-amber-400 border-x border-b border-emerald-800/80 rounded-xl sm:rounded-2xl p-3.5 sm:p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 sm:hover:-translate-y-1.5 shadow-lg flex flex-col justify-between">
        
        <div>
          <!-- Top Row: Rating Stars & Quotation Icon -->
          <div class="flex items-center justify-between pb-2.5 sm:pb-4 border-b border-emerald-800/80 mb-2.5 sm:mb-4">
            <!-- Stars -->
            <div class="flex items-center gap-0.5 sm:gap-1 text-amber-400 text-[10px] sm:text-xs">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $item->rating)
                  <i class="fa-solid fa-star"></i>
                @else
                  <i class="fa-regular fa-star text-emerald-700"></i>
                @endif
              @endfor
            </div>

            <!-- Quote Icon -->
            <span class="text-amber-400/40 text-lg sm:text-2xl font-serif leading-none">“</span>
          </div>

          <!-- Testimonial Quote -->
          <p class="text-[10px] sm:text-xs lg:text-sm text-emerald-100/90 leading-relaxed italic mb-3 sm:mb-6 line-clamp-4 sm:line-clamp-none min-h-[3rem] sm:min-h-auto">
            "{!! nl2br(e($item->content)) !!}"
          </p>
        </div>

        <!-- Author Profile -->
        <div class="pt-2.5 sm:pt-4 border-t border-emerald-800/80 flex items-center gap-2 sm:gap-3.5">
          <img src="{{ $item->avatar_url }}" alt="{{ $item->name }}" 
               loading="lazy" decoding="async"
               class="w-8 h-8 sm:w-11 sm:h-11 rounded-full object-cover border-2 border-amber-400 shrink-0 shadow-sm">
          <div class="min-w-0 flex-1">
            <h4 class="font-extrabold text-white text-[11px] sm:text-xs lg:text-sm truncate">
              {{ $item->name }}
            </h4>
            <p class="text-[9px] sm:text-[11px] text-emerald-300 truncate mt-0.5">
              {{ $item->role }}
            </p>
            <span class="inline-block mt-0.5 sm:mt-1 text-[8px] sm:text-[9px] uppercase font-bold tracking-wider px-1.5 py-0.5 sm:px-2 sm:py-0.5 rounded border {{ $badgeClass }} truncate max-w-full">
              {{ $item->category_label }}
            </span>
          </div>
        </div>

      </div>
      @endforeach
    </div>

  </div>

</section>
@endif
