@props(['testimonials' => null])

@php
  $list = $testimonials ?? \App\Models\Testimonial::active()->featured()->orderBy('order', 'asc')->take(4)->get();
@endphp

@if($list->isNotEmpty())
<!-- Testimoni & Suara Alumni Section (Modern Soft Institutional Style) -->
<section id="testimoni" class="py-16 lg:py-24 bg-emerald-950 text-white relative overflow-hidden border-b border-emerald-900 scroll-mt-16">
  
  <!-- Subtle Background Pattern Overlay -->
  <div class="absolute inset-0 opacity-15 pointer-events-none z-0 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:24px_24px]"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-14 text-center sm:text-left">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <i class="fa-solid fa-comment-dots text-amber-400"></i>
        <span>Suara Alumni & Wali Santri</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
        Kisah Nyata, Kesan & <span class="text-amber-400">Testimoni</span>
      </h2>
      <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
        Dengarkan pengalaman langsung dari alumni yang telah berkhidmat di masyarakat serta para wali santri yang mempercayakan amanah pendidikan putera-puterinya di MA Darun Najah Sambikarto.
      </p>
    </div>

    <!-- Testimonials Grid (2 Kolom Tablet / 4 Kolom Desktop) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($list as $item)
      @php
        $badgeClass = match($item->category) {
          'alumni' => 'bg-emerald-900/80 text-amber-300 border-amber-400',
          'wali_santri' => 'bg-amber-500/20 text-amber-300 border-amber-400',
          'santri' => 'bg-sky-500/20 text-sky-300 border-sky-400',
          default => 'bg-slate-800 text-slate-200 border-slate-600',
        };
      @endphp
      <div class="group relative bg-emerald-900/60 hover:bg-emerald-900/90 border-t-4 border-amber-400 border-x border-b border-emerald-800/80 rounded-2xl p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1.5 shadow-lg flex flex-col justify-between">
        
        <div>
          <!-- Top Row: Rating Stars & Quotation Icon -->
          <div class="flex items-center justify-between pb-4 border-b border-emerald-800/80 mb-4">
            <!-- Stars -->
            <div class="flex items-center gap-1 text-amber-400 text-xs">
              @for($i = 1; $i <= 5; $i++)
                @if($i <= $item->rating)
                  <i class="fa-solid fa-star"></i>
                @else
                  <i class="fa-regular fa-star text-emerald-700"></i>
                @endif
              @endfor
            </div>

            <!-- Quote Icon -->
            <span class="text-amber-400/40 text-2xl font-serif">“</span>
          </div>

          <!-- Testimonial Quote -->
          <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed italic mb-6">
            "{!! nl2br(e($item->content)) !!}"
          </p>
        </div>

        <!-- Author Profile -->
        <div class="pt-4 border-t border-emerald-800/80 flex items-center gap-3.5">
          <img src="{{ $item->avatar_url }}" alt="{{ $item->name }}" 
               loading="lazy" decoding="async"
               class="w-11 h-11 rounded-full object-cover border-2 border-amber-400 shrink-0 shadow-sm">
          <div class="min-w-0 flex-1">
            <h4 class="font-extrabold text-white text-xs sm:text-sm truncate">
              {{ $item->name }}
            </h4>
            <p class="text-[11px] text-emerald-300 truncate mt-0.5">
              {{ $item->role }}
            </p>
            <span class="inline-block mt-1 text-[9px] uppercase font-bold tracking-wider px-2 py-0.5 rounded border {{ $badgeClass }}">
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
