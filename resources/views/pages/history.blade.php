@extends('layouts.app')

@section('title', 'Sejarah Berdirinya & Profil Lembaga • MA Darun Najah Sambikarto')

@section('content')
<!-- History & Profile Page Container -->
<div class="bg-slate-50 min-h-screen">

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" 
           alt="Sejarah MA Darun Najah" 
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
        <span class="text-amber-300">Sejarah & Profil Lembaga</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Rekam Jejak & Nilai Perjuangan</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Sejarah Berdirinya & <span class="text-amber-400">Profil Lembaga</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Menapaki jejak khidmat dakwah, perjuangan para ulama perintis, serta komitmen luhur mencetak generasi santri yang menguasai ilmu agama salaf dan ilmu pengetahuan modern di Sambikarto, Sekampung, Lampung Timur.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Main History Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Story & Founding Narrative Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-16">
        
        <!-- Left Visual -->
        <div class="lg:col-span-5 space-y-4">
          <div class="relative group">
            <div class="absolute -inset-2 bg-gradient-to-br from-emerald-800 to-amber-500 opacity-20 -z-10 rounded-2xl"></div>
            <div class="relative bg-slate-900 border-2 border-emerald-800 rounded-xl overflow-hidden shadow-xl">
              <img src="{{ !empty($narrative?->image_url) ? $narrative->image_url : (function_exists('webp_asset') ? webp_asset('assets/images/gedung-2.jpg') : asset('assets/images/gedung-2.jpg')) }}" 
                   alt="{{ $narrative?->title ?? 'Kompleks Pesantren Darun Najah' }}" 
                   loading="lazy" decoding="async"
                   class="w-full aspect-4/3 object-cover">
              <div class="absolute inset-x-0 bottom-0 bg-emerald-950/90 border-t-2 border-amber-400 p-4 text-white">
                <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300 block">{{ $narrative?->badge ?? 'Pondok Pesantren Darun Najah' }}</span>
                <p class="text-xs sm:text-sm font-bold mt-0.5">Pusat Kaderisasi Ulama & Cendekiawan Muslim</p>
              </div>
            </div>
          </div>

          <div class="bg-white border-l-4 border-amber-500 border-y border-r border-slate-200 p-4 rounded-xl shadow-sm text-xs text-slate-600">
            <strong class="text-slate-900 block font-bold mb-1">Motto Lembaga:</strong>
            @if(!empty($narrative?->quote))
              <em>"{{ $narrative->quote }}"</em>
            @else
              <em>"Al-Muhafazhatu 'alal qadimis shalih, wal akhdzu bil jadidil ashlah"</em> — Memelihara tradisi lama yang baik dan mengadopsi tradisi baru yang lebih maslahat.
            @endif
          </div>
        </div>

        <!-- Right Narrative -->
        <div class="lg:col-span-7 space-y-5">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider rounded-md border border-emerald-200">
            <i class="fa-solid fa-landmark"></i>
            <span>{{ $narrative?->period ?? 'Latar Belakang Historis' }}</span>
          </div>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug">
            {{ $narrative?->title ?? 'Tumbuh dari Ketulusan Dakwah & Kebutuhan Umat di Bumi Sambikarto' }}
          </h2>
          <div class="text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3.5">
            @if(!empty($narrative?->description))
              @foreach(explode("\n\n", str_replace("\r", "", $narrative->description)) as $paragraph)
                @if(trim($paragraph))
                  <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endif
              @endforeach
            @else
              <p>
                Berdirinya <strong>Madrasah Aliyah (MA) Darun Najah Sambikarto</strong> berakar dari kepedulian mendalam para kiai, ulama, dan tokoh masyarakat di Kecamatan Sekampung, Kabupaten Lampung Timur, terhadap ketersediaan lembaga pendidikan formal tingkat menengah atas yang berlandaskan akidah <em>Ahlussunnah wal Jama'ah An-Nahdliyyah</em>.
              </p>
              <p>
                Sebelum madrasah formal didirikan, aktivitas pendidikan bermula dari majelis ta'lim dan pengajian kitab kuning tradisional yang diasuh oleh <strong>KH. Sahlan Abdulloh</strong> dan <strong>KH. Abdul Ghofar, S.Pd.I</strong>. Seiring berjalannya waktu, animo masyarakat untuk menyekolahkan putra-putri mereka di madrasah yang memiliki asrama pondok pesantren semakin tinggi.
              </p>
              <p>
                Atas inisiatif para sesepuh bersama Yayasan Pondok Pesantren Darun Najah di bawah kepemimpinan <strong>Suparno, S.Pd.I</strong>, didirikanlah unit formal Madrasah Aliyah di bawah naungan <strong>LP Ma'arif NU</strong> dan Kementerian Agama Republik Indonesia. Integrasi antara kurikulum nasional dan sistem pesantren salaf menjadi ciri khas utama yang terus dijaga hingga kini.
              </p>
            @endif
          </div>
        </div>

      </div>

      <!-- 3. Milestones & Timeline Sejarah -->
      <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-10 shadow-sm mb-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
            Tonggak Sejarah
          </span>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
            Fase Perkembangan MA Darun Najah
          </h3>
          <p class="mt-2 text-xs sm:text-sm text-slate-600">
            Perjalanan panjang mewujudkan madrasah yang berkualitas, berdaya saing, dan berkarakter luhur.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
          @php
            $colorPatterns = [
              ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800'],
              ['bg' => 'bg-amber-100', 'text' => 'text-amber-800'],
              ['bg' => 'bg-sky-100', 'text' => 'text-sky-800'],
              ['bg' => 'bg-purple-100', 'text' => 'text-purple-800'],
            ];
          @endphp

          @forelse($milestones ?? [] as $m)
          @php
            $color = $colorPatterns[$loop->index % count($colorPatterns)];
          @endphp
          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
              <div class="w-10 h-10 rounded-lg {{ $color['bg'] }} {{ $color['text'] }} flex items-center justify-center font-extrabold text-sm mb-3">
                {{ $m->period ?: sprintf('%02d', $loop->iteration) }}
              </div>
              @if($m->quote)
              <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">{{ $m->quote }}</span>
              @endif
              <h4 class="font-bold text-sm text-slate-900 mt-1">{{ $m->title }}</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                {{ $m->description }}
              </p>
            </div>
            @if($m->badge)
            <div class="pt-3 border-t border-slate-200 mt-4 text-[11px] text-slate-400 font-mono">
              {{ $m->badge }}
            </div>
            @endif
          </div>
          @empty
          <!-- Fallback Phase 1 -->
          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between">
            <div>
              <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-extrabold text-sm mb-3">
                01
              </div>
              <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Fase Perintisan</span>
              <h4 class="font-bold text-sm text-slate-900 mt-1">Majelis & Pengajian Salaf</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Bermula dari halaqoh pengajian kitab kuning, pembinaan amaliah ibadah masyarakat, dan santri mukim angkatan pertama.
              </p>
            </div>
            <div class="pt-3 border-t border-slate-200 mt-4 text-[11px] text-slate-400 font-mono">
              Fondasi Dakwah
            </div>
          </div>

          <!-- Fallback Phase 2 -->
          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between">
            <div>
              <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center font-extrabold text-sm mb-3">
                02
              </div>
              <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Fase Pelembagaan</span>
              <h4 class="font-bold text-sm text-slate-900 mt-1">Pendirian Madrasah Aliyah</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Resmi memperoleh izin operasional Kementerian Agama dan berafiliasi penuh dengan LP Ma'arif NU Kabupaten Lampung Timur.
              </p>
            </div>
            <div class="pt-3 border-t border-slate-200 mt-4 text-[11px] text-slate-400 font-mono">
              Legalitas Formal
            </div>
          </div>

          <!-- Fallback Phase 3 -->
          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between">
            <div>
              <div class="w-10 h-10 rounded-lg bg-sky-100 text-sky-800 flex items-center justify-center font-extrabold text-sm mb-3">
                03
              </div>
              <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Fase Pembangunan</span>
              <h4 class="font-bold text-sm text-slate-900 mt-1">Ekspansi Asrama & Sarana</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Pembangunan gedung kelas representatif, asrama putra-putri terpisah, masjid kampus megah, dan fasilitas lapangan olahraga.
              </p>
            </div>
            <div class="pt-3 border-t border-slate-200 mt-4 text-[11px] text-slate-400 font-mono">
              Fasilitas Terpadu
            </div>
          </div>

          <!-- Fallback Phase 4 -->
          <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between">
            <div>
              <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-800 flex items-center justify-center font-extrabold text-sm mb-3">
                04
              </div>
              <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Fase Modernisasi</span>
              <h4 class="font-bold text-sm text-slate-900 mt-1">Akreditasi & Kemandirian TIK</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Terakreditasi BAN-SM, pelaksanaan CBT/ANBK mandiri, program beasiswa tahfidz Qur'an, dan pembekalan vokasi santri mandiri.
              </p>
            </div>
            <div class="pt-3 border-t border-slate-200 mt-4 text-[11px] text-slate-400 font-mono">
              Era Masa Kini
            </div>
          </div>
          @endforelse

        </div>
      </div>

      <!-- 4. Pimpinan & Pengasuh Lembaga -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        @forelse($figures ?? [] as $fig)
        @php
          $isFirst = $loop->iteration % 2 === 1;
          $borderClass = $isFirst ? 'border-emerald-600' : 'border-amber-500';
          $iconBg = $isFirst ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-amber-100 text-amber-800 border-amber-200';
          $badgeText = $isFirst ? 'text-emerald-800' : 'text-amber-800';
          $defaultIcon = $isFirst ? 'fa-solid fa-hands-praying' : 'fa-solid fa-user-tie';
        @endphp
        <div class="bg-white border-t-4 {{ $borderClass }} border-x border-b border-slate-200 rounded-xl p-6 sm:p-8 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div>
            <div class="flex items-start gap-4 mb-4">
              @if(!empty($fig->image_url))
                <div class="w-14 h-14 rounded-xl overflow-hidden border border-slate-200 shrink-0 shadow-sm bg-slate-100">
                  <img src="{{ $fig->image_url }}" alt="{{ $fig->title }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                </div>
              @else
                <div class="w-14 h-14 {{ $iconBg }} rounded-xl flex items-center justify-center text-2xl font-bold border shrink-0">
                  <i class="{{ $defaultIcon }}"></i>
                </div>
              @endif
              <div>
                <span class="text-xs font-bold uppercase tracking-wider {{ $badgeText }}">{{ $fig->period ?: 'Tokoh Lembaga' }}</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1">{{ $fig->title }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">{{ $fig->badge ?: 'Pondok Pesantren Darun Najah' }}</p>
              </div>
            </div>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
              {{ $fig->description }}
            </p>
          </div>
          @if($fig->quote)
          <div class="mt-4 pt-3 border-t border-slate-100 text-xs italic text-slate-500">
            "{{ $fig->quote }}"
          </div>
          @endif
        </div>
        @empty
        <!-- Fallback Tokoh 1: Pengasuh -->
        <div class="bg-white border-t-4 border-emerald-600 border-x border-b border-slate-200 rounded-xl p-6 sm:p-8 shadow-sm">
          <div class="flex items-start gap-4 mb-4">
            <div class="w-14 h-14 bg-emerald-100 text-emerald-800 rounded-xl flex items-center justify-center text-2xl font-bold border border-emerald-200 shrink-0">
              <i class="fa-solid fa-hands-praying"></i>
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Pengasuh Pondok Pesantren</span>
              <h3 class="text-lg font-bold text-slate-900 mt-1">KH. Sahlan Abdulloh & KH. Abdul Ghofar, S.Pd.I</h3>
              <p class="text-xs text-slate-500 mt-0.5">Masyayikh & Pembimbing Ruhani Santri</p>
            </div>
          </div>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Berperan sentral dalam menjaga sanad keilmuan Islam Ahlussunnah wal Jama'ah, keteladanan akhlak para santri, serta pengawasan kegiatan ibadah yaumiyyah di lingkungan asrama mukim 24 jam.
          </p>
        </div>

        <!-- Fallback Tokoh 2: Ketua Yayasan -->
        <div class="bg-white border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-xl p-6 sm:p-8 shadow-sm">
          <div class="flex items-start gap-4 mb-4">
            <div class="w-14 h-14 bg-amber-100 text-amber-800 rounded-xl flex items-center justify-center text-2xl font-bold border border-amber-200 shrink-0">
              <i class="fa-solid fa-user-tie"></i>
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-amber-800">Ketua Yayasan</span>
              <h3 class="text-lg font-bold text-slate-900 mt-1">Suparno, S.Pd.I</h3>
              <p class="text-xs text-slate-500 mt-0.5">Yayasan Pondok Pesantren Darun Najah Sambikarto</p>
            </div>
          </div>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Memimpin arah kebijakan strategis yayasan, pengembangan infrastruktur fisik, kemitraan lembaga dengan pemerintah dan masyarakat, serta penjaminan mutu tata kelola pendidikan.
          </p>
        </div>
        @endforelse

      </div>

      <!-- 5. Identitas & Legalitas Resmi Lembaga -->
      <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm mb-12">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
          <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900">Identitas & Legalitas Resmi Lembaga</h3>
            <p class="text-xs text-slate-500">Legalitas formal di bawah Kementerian Agama RI dan Badan Akreditasi Nasional.</p>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
          <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-lg">
            <span class="text-slate-400 block font-semibold uppercase text-[10px]">Nama Lembaga</span>
            <strong class="text-slate-900 text-sm mt-0.5 block">MA Darun Najah Sambikarto</strong>
          </div>

          <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-lg">
            <span class="text-slate-400 block font-semibold uppercase text-[10px]">Status Akreditasi</span>
            <strong class="text-emerald-800 text-sm mt-0.5 block font-bold">Terakreditasi BAN-SM</strong>
          </div>

          <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-lg">
            <span class="text-slate-400 block font-semibold uppercase text-[10px]">Badan Penyelenggara</span>
            <strong class="text-slate-900 text-sm mt-0.5 block">Yayasan Pondok Pesantren Darun Najah</strong>
          </div>

          <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-lg">
            <span class="text-slate-400 block font-semibold uppercase text-[10px]">Naungan Kelembagaan</span>
            <strong class="text-slate-900 text-sm mt-0.5 block">LP Ma'arif NU & Kemenag RI</strong>
          </div>

          <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-lg">
            <span class="text-slate-400 block font-semibold uppercase text-[10px]">Jenjang Pendidikan</span>
            <strong class="text-slate-900 text-sm mt-0.5 block">Madrasah Aliyah (Setara SMA/SMK)</strong>
          </div>

          <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-lg">
            <span class="text-slate-400 block font-semibold uppercase text-[10px]">Wilayah Kerja</span>
            <strong class="text-slate-900 text-sm mt-0.5 block">Sekampung, Lampung Timur, Lampung</strong>
          </div>
        </div>
      </div>

      <!-- 6. CTA Card -->
      <div class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-landmark"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Penerimaan Santri Baru (PPDB)</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Menjadi Bagian dari Sejarah dan Perjuangan Kami
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Bergabunglah bersama keluarga besar MA Darun Najah Sambikarto. Daftarkan putra-putri Anda dalam program santri mukim maupun reguler.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ url('/') }}#ppdb" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Daftar PPDB Online</span>
            </a>

            <a href="{{ route('kurikulum') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-solid fa-book-open"></i>
              <span>Pelajari Kurikulum</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
