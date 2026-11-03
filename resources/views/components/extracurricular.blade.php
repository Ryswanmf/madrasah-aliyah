<!-- Ekstrakurikuler Section (Modern Soft Style) -->
<section id="ekstrakurikuler" class="py-12 sm:py-16 lg:py-24 bg-white relative scroll-mt-16 border-b border-slate-200" x-data="{ currentFilter: 'all' }">
  <span id="ekstrakulikuler" class="absolute -top-20"></span>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-8 sm:mb-10 text-center sm:text-left">
      <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 bg-emerald-950 text-amber-300 text-[10px] sm:text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-3 sm:mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Pengembangan Bakat & Minat</span>
      </div>
      <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Ekstrakurikuler Siswa/i
      </h2>
      <p class="mt-2.5 sm:mt-4 text-xs sm:text-base lg:text-lg text-slate-600 leading-relaxed">
        Wadah mengasah kepemimpinan, kreativitas seni islami, fisik tangguh, dan keterampilan hidup siswa/i.
      </p>
    </div>

    <!-- Filter Buttons (Soft Rounded) -->
    <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-6 sm:mb-10 border-b border-slate-200 pb-3 sm:pb-4">
      <button @click="currentFilter = 'all'" 
              :class="currentFilter === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border-slate-300 font-medium'"
              class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-colors cursor-pointer">
        Semua
      </button>
      <button @click="currentFilter = 'keagamaan'" 
              :class="currentFilter === 'keagamaan' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border-slate-300 font-medium'"
              class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-colors cursor-pointer">
        Keagamaan & Seni
      </button>
      <button @click="currentFilter = 'lifeskill'" 
              :class="currentFilter === 'lifeskill' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border-slate-300 font-medium'"
              class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-colors cursor-pointer">
        Keterampilan Hidup
      </button>
      <button @click="currentFilter = 'olahraga'" 
              :class="currentFilter === 'olahraga' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border-slate-300 font-medium'"
              class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-colors cursor-pointer">
        Olahraga & Bela Diri
      </button>
      <button @click="currentFilter = 'organisasi'" 
              :class="currentFilter === 'organisasi' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200 border-slate-300 font-medium'"
              class="px-2.5 py-1.5 sm:px-4 sm:py-2.5 rounded-lg border text-[10px] sm:text-xs uppercase tracking-wider transition-colors cursor-pointer">
        Kepemimpinan
      </button>
    </div>

    <!-- Ekskul Cards Grid: 2 Columns Mobile (2 2), 3 Columns Desktop -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
      @php
        $items = isset($homeExtracurriculars) && $homeExtracurriculars->isNotEmpty() 
          ? $homeExtracurriculars 
          : \App\Models\Extracurricular::active()->featured()->take(6)->get();

        if ($items->isEmpty()) {
          $items = \App\Models\Extracurricular::active()->take(6)->get();
        }
      @endphp

      @forelse($items as $item)
        @php
          $theme = $item->color_theme;
          $filterKey = match($item->category) {
            'seni', 'keagamaan' => 'keagamaan',
            'vokasi', 'lifeskill' => 'lifeskill',
            'olahraga' => 'olahraga',
            'organisasi' => 'organisasi',
            default => 'keagamaan',
          };
        @endphp
        <div x-show="currentFilter === 'all' || currentFilter === '{{ $filterKey }}'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 {{ $theme['border'] }} border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 {{ $theme['icon_bg'] }} rounded-lg flex items-center justify-center text-base sm:text-xl shadow-2xs shrink-0">
                <i class="{{ $item->display_icon }}"></i>
              </div>
              @if($item->badge)
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold uppercase tracking-wider border-l-2 rounded max-w-[65%] truncate {{ $theme['badge'] }}">
                {{ $item->badge }}
              </span>
              @endif
            </div>

            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">
              {{ $item->name }}
            </h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              {{ $item->description }}
            </p>
          </div>

          @if($item->schedule || $item->coach)
          <div class="mt-2.5 pt-2 sm:mt-4 sm:pt-3 border-t border-slate-200/60 text-[10px] sm:text-[11px] text-slate-500 space-y-0.5 sm:space-y-1">
            @if($item->schedule)
            <div class="flex items-center gap-1.5 truncate">
              <i class="fa-regular fa-clock text-emerald-700 text-[10px] sm:text-xs shrink-0"></i>
              <span class="truncate">{{ $item->schedule }}</span>
            </div>
            @endif
            @if($item->coach)
            <div class="flex items-center gap-1.5 truncate">
              <i class="fa-solid fa-user-check text-amber-600 text-[10px] sm:text-xs shrink-0"></i>
              <span class="truncate">{{ $item->coach }}</span>
            </div>
            @endif
          </div>
          @endif
        </div>
      @empty
        <!-- Fallback Item 1: Hadroh -->
        <div x-show="currentFilter === 'all' || currentFilter === 'keagamaan'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 border-emerald-600 border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:border-emerald-700 hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl shrink-0">
                <i class="fa-solid fa-drum"></i>
              </div>
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold text-emerald-800 bg-emerald-100 uppercase tracking-widest border-l-2 border-emerald-600 rounded">Seni Islami</span>
            </div>
            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">Hadroh & Sholawat Banjari</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              Olah vokal sholawat nabi, ketukan rebana klasik kontemporer, dan memeriahkan hari-hari besar Islam.
            </p>
          </div>
        </div>

        <!-- Fallback Item 2: Kaligrafi -->
        <div x-show="currentFilter === 'all' || currentFilter === 'keagamaan'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 border-emerald-600 border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:border-emerald-700 hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-base sm:text-xl shrink-0">
                <i class="fa-solid fa-pen-nib"></i>
              </div>
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold text-emerald-800 bg-emerald-100 uppercase tracking-widest border-l-2 border-emerald-600 rounded">Khat Arab</span>
            </div>
            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">Seni Kaligrafi Al-Qur'an</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              Keterampilan menulis khat Tsuluts, Naskhi, dan Diwani untuk ajang MTQ serta seni dekorasi islami.
            </p>
          </div>
        </div>

        <!-- Fallback Item 3: Komputer -->
        <div x-show="currentFilter === 'all' || currentFilter === 'lifeskill'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 border-blue-600 border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:border-blue-700 hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-blue-100 text-blue-800 border border-blue-200 rounded-lg flex items-center justify-center text-base sm:text-xl shrink-0">
                <i class="fa-solid fa-computer"></i>
              </div>
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold text-blue-800 bg-blue-100 uppercase tracking-widest border-l-2 border-blue-600 rounded">Teknologi</span>
            </div>
            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">Komputer & Desain Grafis</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              Pelatihan administrasi kantor, pengetikan bilingual arab-latin, dan kreasi konten dakwah media sosial.
            </p>
          </div>
        </div>

        <!-- Fallback Item 4: Kewirausahaan -->
        <div x-show="currentFilter === 'all' || currentFilter === 'lifeskill'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 border-amber-500 border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:border-amber-600 hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-amber-100 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-base sm:text-xl shrink-0">
                <i class="fa-solid fa-hand-holding-dollar"></i>
              </div>
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold text-amber-800 bg-amber-100 uppercase tracking-widest border-l-2 border-amber-500 rounded">Kemandirian</span>
            </div>
            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">Kewirausahaan Mandiri</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              Pelatihan tata niaga siswa/i, pengelolaan koperasi madrasah, dan kreasi produk tepat guna bernilai jual.
            </p>
          </div>
        </div>

        <!-- Fallback Item 5: Pagar Nusa -->
        <div x-show="currentFilter === 'all' || currentFilter === 'olahraga'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 border-red-600 border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:border-red-700 hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-red-100 text-red-800 border border-red-200 rounded-lg flex items-center justify-center text-base sm:text-xl shrink-0">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold text-red-800 bg-red-100 uppercase tracking-widest border-l-2 border-red-600 rounded">Bela Diri</span>
            </div>
            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">Pencak Silat Pagar Nusa</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              Seni bela diri kebanggaan Nahdlatul Ulama untuk melatih ketangkasan fisik, mental ksatria, dan membela ulama.
            </p>
          </div>
        </div>

        <!-- Fallback Item 6: Pramuka -->
        <div x-show="currentFilter === 'all' || currentFilter === 'organisasi'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-50 border-t-2 border-purple-600 border-x border-b border-slate-200 p-3.5 sm:p-6 rounded-xl hover:border-purple-700 hover:shadow-lg transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-1.5 mb-2.5 sm:mb-4">
              <div class="w-9 h-9 sm:w-12 sm:h-12 bg-purple-100 text-purple-800 border border-purple-200 rounded-lg flex items-center justify-center text-base sm:text-xl shrink-0">
                <i class="fa-solid fa-campground"></i>
              </div>
              <span class="inline-block px-1.5 py-0.5 sm:px-2.5 sm:py-0.5 text-[9px] sm:text-[10px] font-bold text-purple-800 bg-purple-100 uppercase tracking-widest border-l-2 border-purple-600 rounded">Kepanduan</span>
            </div>
            <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 sm:mb-2 leading-tight sm:leading-snug line-clamp-2 min-h-[2rem] sm:min-h-auto">Pramuka Gugus Depan</h3>
            <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
              Membentuk kedisiplinan, kecintaan alam, jiwa tolong-menolong, dan kepemimpinan berjiwa patriotik.
            </p>
          </div>
        </div>
      @endforelse

    </div>

    <!-- Tombol Lihat Seluruh Ekstrakurikuler -->
    <div class="mt-8 sm:mt-12 text-center">
      <a href="{{ route('ekstrakulikuler') }}" 
         class="inline-flex items-center gap-2.5 sm:gap-3 px-6 sm:px-8 py-3 sm:py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-xl shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-emerald-950">
        <span>Lihat Semua Ekstrakurikuler</span>
        <i class="fa-solid fa-arrow-right text-amber-400"></i>
      </a>
      <p class="mt-2.5 sm:mt-3 text-xs text-slate-500">
        Jelajahi seluruh program pengembangan bakat, seni hadroh, bela diri Pagar Nusa, pramuka, dan kepemimpinan siswa/i.
      </p>
    </div>

  </div>
</section>
