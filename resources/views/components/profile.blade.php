@props(['homeSetting' => null])

@php
  $setting = $homeSetting ?? $siteSetting ?? \App\Models\HomeSetting::first();
  $missions = !empty($setting?->mission) 
    ? array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $setting->mission))))
    : [
        'Menyelenggarakan kurikulum Kemenag dan pesantren secara integral.',
        'Membudayakan akhlakul karimah dan ibadah yaumiyyah santri.',
        'Membekali santri keterampilan vokasi dan kemandirian praktis.'
      ];
@endphp

<!-- Profil & Sejarah Section (Modern Soft Geometric Style) -->
<section id="sejarah" class="py-16 lg:py-24 bg-white relative scroll-mt-16 border-b border-slate-200">
  <span id="profil" class="absolute -top-20"></span>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-14 text-center sm:text-left">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-950 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Tentang Lembaga</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        {{ $setting->profile_title ?? 'Mengenal Lebih Dekat MA Darun Najah Sambikarto' }}
      </h2>
      <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
        Berkhidmat dalam dunia pendidikan Islam, dakwah, dan pembinaan akhlak mulia sejak dirintis di bawah naungan Yayasan Pondok Pesantren Darun Najah.
      </p>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
      
      <!-- Visual Left -->
      <div class="lg:col-span-5 space-y-6">
        
        <!-- Image with Soft Frame -->
        <div class="relative group">
          <!-- Offset Soft Backdrop -->
          <div class="absolute -inset-2 bg-gradient-to-br from-emerald-800 to-amber-500 opacity-20 -z-10 rounded-2xl group-hover:opacity-30 transition-opacity"></div>
          
          <div class="relative bg-slate-900 border-2 border-emerald-900 rounded-xl overflow-hidden shadow-xl">
            <img src="{{ !empty($setting?->profile_image) ? $setting->profile_image_url : (function_exists('webp_asset') ? webp_asset('assets/images/gedung-2.jpg') : asset('assets/images/gedung-2.jpg')) }}" 
                 alt="{{ $setting->profile_title ?? 'Aktivitas MA Darun Najah' }}" 
                 loading="lazy"
                 decoding="async"
                 class="w-full aspect-4/3 object-cover group-hover:scale-105 transition-transform duration-500">
            
            <!-- Bottom Soft Overlay Bar -->
            <div class="absolute inset-x-0 bottom-0 bg-emerald-950/90 border-t-2 border-amber-400 p-4 text-white">
              <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300 block">
                Yayasan Pondok Pesantren Darun Najah
              </span>
              <p class="text-sm font-bold mt-0.5">Pendidikan Holistik Berbasis Nilai Pesantren</p>
            </div>
          </div>
        </div>

        <!-- Tokoh Pendiri / Pengasuh -->
        <div class="bg-slate-50 border-l-4 border-emerald-700 border-y border-r border-slate-200 p-5 rounded-xl shadow-sm">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-emerald-900 text-amber-400 border border-amber-400/50 rounded-lg flex items-center justify-center font-bold text-xl shrink-0 shadow-sm">
              <i class="fa-solid fa-mosque"></i>
            </div>
            <div>
              <span class="text-[10px] font-bold tracking-widest text-emerald-800 uppercase block">
                Pengasuh Pondok Pesantren
              </span>
              <h3 class="text-sm sm:text-base font-bold text-slate-900 mt-0.5">
                {{ $setting->leader_name ?? 'KH. Sahlan Abdulloh & KH. Abdul Ghofar, S.Pd.I' }}
              </h3>
              <p class="text-xs text-slate-600 mt-1 flex items-center gap-1.5 font-medium">
                <i class="fa-solid fa-user-tie text-amber-600"></i>
                Ketua Yayasan: {{ $setting->foundation_head ?? 'Suparno, S.Pd.I' }}
              </p>
            </div>
          </div>
        </div>

        <!-- Akreditasi & Legalitas Badge -->
        <div class="grid grid-cols-2 gap-3">
          <div class="bg-emerald-950 text-white p-3.5 border-l-2 border-amber-400 rounded-lg shadow-sm">
            <span class="text-[10px] uppercase tracking-wider text-amber-300 block font-semibold">Status Akreditasi</span>
            <strong class="text-sm font-bold">{{ $setting->accreditation_status ?? 'Terakreditasi BAN-SM' }}</strong>
          </div>
          <div class="bg-emerald-950 text-white p-3.5 border-l-2 border-emerald-400 rounded-lg shadow-sm">
            <span class="text-[10px] uppercase tracking-wider text-emerald-300 block font-semibold">Naungan Resmi</span>
            <strong class="text-sm font-bold">LP Ma'arif NU</strong>
          </div>
        </div>

      </div>

      <!-- Text Right & Visi Misi -->
      <div class="lg:col-span-7 space-y-6">
        
        <!-- Highlighted Intro Paragraph -->
        @if(!empty($setting?->profile_highlight))
        <div class="border-l-4 border-amber-500 pl-4 py-1 text-slate-700">
          <p class="text-base sm:text-lg font-medium leading-relaxed">
            {!! nl2br(e($setting->profile_highlight)) !!}
          </p>
        </div>
        @endif

        @if(!empty($setting?->profile_description))
        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
          {!! nl2br(e($setting->profile_description)) !!}
        </p>
        @endif

        <!-- Visi & Misi Soft Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
          
          <!-- Visi -->
          <div class="bg-white border-t-4 border-amber-500 border-x border-b border-slate-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 pb-3 mb-3 border-b border-slate-100">
              <div class="w-8 h-8 bg-amber-100 text-amber-800 border border-amber-300 rounded-lg flex items-center justify-center text-sm font-bold">
                <i class="fa-solid fa-bullseye"></i>
              </div>
              <h3 class="font-extrabold text-slate-900 text-base uppercase tracking-wide">Visi Madrasah</h3>
            </div>
            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-normal">
              {{ $setting->vision ?? 'Terwujudnya generasi muda Islam yang berakhlak mulia, berprestasi dalam ilmu pengetahuan, berpegang teguh pada ajaran Ahlussunnah wal Jama\'ah, dan mandiri dalam kehidupan bermasyarakat.' }}
            </p>
          </div>

          <!-- Misi -->
          <div class="bg-white border-t-4 border-emerald-700 border-x border-b border-slate-200 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 pb-3 mb-3 border-b border-slate-100">
              <div class="w-8 h-8 bg-emerald-100 text-emerald-800 border border-emerald-300 rounded-lg flex items-center justify-center text-sm font-bold">
                <i class="fa-solid fa-list-check"></i>
              </div>
              <h3 class="font-extrabold text-slate-900 text-base uppercase tracking-wide">Misi Utama</h3>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2">
              @foreach($missions as $misi)
              <li class="flex items-start gap-2">
                <i class="fa-solid fa-caret-right text-emerald-700 mt-1 shrink-0 text-xs"></i>
                <span>{{ $misi }}</span>
              </li>
              @endforeach
            </ul>
          </div>

        </div>

        <!-- 4 Pilar Nilai Keunggulan -->
        <div class="pt-4">
          <span class="text-xs font-bold uppercase tracking-widest text-slate-400 block mb-3">
            Pilar Nilai Pendidikan
          </span>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
            <div class="p-3 bg-slate-50 border border-slate-200 rounded-lg hover:border-emerald-600 transition-colors">
              <i class="{{ $setting->pillar_1_icon ?: 'fa-solid fa-star-and-crescent' }} text-emerald-700 text-lg mb-1 block"></i>
              <strong class="text-xs font-bold text-slate-900 block">{{ $setting->pillar_1_title ?: 'Aswaja NU' }}</strong>
              <span class="text-[10px] text-slate-500">{{ $setting->pillar_1_desc ?: 'Akidah & Amaliah' }}</span>
            </div>
            <div class="p-3 bg-slate-50 border border-slate-200 rounded-lg hover:border-emerald-600 transition-colors">
              <i class="{{ $setting->pillar_2_icon ?: 'fa-solid fa-book-quran' }} text-emerald-700 text-lg mb-1 block"></i>
              <strong class="text-xs font-bold text-slate-900 block">{{ $setting->pillar_2_title ?: 'Tafaqquh Fiddin' }}</strong>
              <span class="text-[10px] text-slate-500">{{ $setting->pillar_2_desc ?: 'Kitab Turats Salaf' }}</span>
            </div>
            <div class="p-3 bg-slate-50 border border-slate-200 rounded-lg hover:border-emerald-600 transition-colors">
              <i class="{{ $setting->pillar_3_icon ?: 'fa-solid fa-microscope' }} text-emerald-700 text-lg mb-1 block"></i>
              <strong class="text-xs font-bold text-slate-900 block">{{ $setting->pillar_3_title ?: 'Sains Modern' }}</strong>
              <span class="text-[10px] text-slate-500">{{ $setting->pillar_3_desc ?: 'Wawasan Akademis' }}</span>
            </div>
            <div class="p-3 bg-slate-50 border border-slate-200 rounded-lg hover:border-emerald-600 transition-colors">
              <i class="{{ $setting->pillar_4_icon ?: 'fa-solid fa-hand-holding-hand' }} text-emerald-700 text-lg mb-1 block"></i>
              <strong class="text-xs font-bold text-slate-900 block">{{ $setting->pillar_4_title ?: 'Kemandirian' }}</strong>
              <span class="text-[10px] text-slate-500">{{ $setting->pillar_4_desc ?: 'Life Skills Santri' }}</span>
            </div>
          </div>

          <!-- Tombol Baca Selengkapnya Sejarah -->
          <div class="mt-6">
            <a href="{{ route('sejarah') }}" 
               class="inline-flex items-center gap-2.5 px-6 py-3 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 border-b-2 border-emerald-950">
              <span>Baca Selengkapnya Sejarah & Profil</span>
              <i class="fa-solid fa-arrow-right text-amber-400"></i>
            </a>
          </div>
        </div>

      </div>

    </div>

    <!-- 5. Counter Statistik Angka Madrasah (Dinamis) -->
    @if($setting?->is_stats_active ?? true)
    <div class="mt-16 pt-12 border-t border-slate-200">
      <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-10 shadow-xl border-t-4 border-amber-400">
        <div class="text-center max-w-2xl mx-auto mb-8">
          <span class="text-amber-400 text-xs font-bold uppercase tracking-widest block">Data & Angka Madrasah</span>
          <h3 class="text-xl sm:text-2xl font-extrabold text-white mt-1">Kiprah Nyata Pendidikan & Pembinaan Santri</h3>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          <!-- Stat 1 -->
          <div class="p-4 bg-emerald-900/60 rounded-xl border border-emerald-700/60 shadow-sm">
            <div class="text-3xl sm:text-4xl font-extrabold text-amber-400 font-mono">
              {{ $setting->stat_students_count ?: '350+' }}
            </div>
            <div class="text-xs sm:text-sm font-semibold text-white mt-1">
              {{ $setting->stat_students_label ?: 'Santri Mukim & Reguler' }}
            </div>
          </div>

          <!-- Stat 2 -->
          <div class="p-4 bg-emerald-900/60 rounded-xl border border-emerald-700/60 shadow-sm">
            <div class="text-3xl sm:text-4xl font-extrabold text-amber-400 font-mono">
              {{ $setting->stat_teachers_count ?: '28' }}
            </div>
            <div class="text-xs sm:text-sm font-semibold text-white mt-1">
              {{ $setting->stat_teachers_label ?: 'Dewan Asatidz & Guru' }}
            </div>
          </div>

          <!-- Stat 3 -->
          <div class="p-4 bg-emerald-900/60 rounded-xl border border-emerald-700/60 shadow-sm">
            <div class="text-3xl sm:text-4xl font-extrabold text-amber-400 font-mono">
              {{ $setting->stat_classes_count ?: '12' }}
            </div>
            <div class="text-xs sm:text-sm font-semibold text-white mt-1">
              {{ $setting->stat_classes_label ?: 'Ruang Kelas & Lab' }}
            </div>
          </div>

          <!-- Stat 4 -->
          <div class="p-4 bg-emerald-900/60 rounded-xl border border-emerald-700/60 shadow-sm">
            <div class="text-3xl sm:text-4xl font-extrabold text-amber-400 font-mono">
              {{ $setting->stat_alumni_count ?: '1.200+' }}
            </div>
            <div class="text-xs sm:text-sm font-semibold text-white mt-1">
              {{ $setting->stat_alumni_label ?: 'Alumni Tersebar' }}
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

  </div>
</section>
