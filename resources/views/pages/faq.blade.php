@extends('layouts.app')

@section('title', 'Tanya Jawab & Pusat Informasi (FAQ) • Madrasah Aliyah Darun Najah')

@section('content')
<!-- FAQ Page Container -->
<div class="bg-slate-50 min-h-screen" 
     x-data="{ 
       activeFaq: {{ isset($faqs) && $faqs->isNotEmpty() ? $faqs->first()->id : 1 }},
       searchQuery: '',
       matchesSearch(text) {
         if (!this.searchQuery) return true;
         return text.toLowerCase().includes(this.searchQuery.toLowerCase());
       }
     }">

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gallery-3.jpg') : asset('assets/images/gallery-3.jpg') }}" 
           alt="Siswa/i MA Darun Najah" 
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
        <span class="text-amber-300">Tanya Jawab (FAQ)</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Pusat Bantuan & Edukasi</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Pertanyaan Umum <span class="text-amber-400">(FAQ)</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Temukan jawaban terlengkap seputar sistem pendidikan, kurikulum terpadu, rutinitas siswa/i di asrama, biaya pendidikan, dan pendaftaran siswa/i baru di MA Darun Najah Sambikarto.
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
                 placeholder="Ketik kata kunci pertanyaan (misal: beasiswa, asrama, biaya, hp)..." 
                 class="w-full pl-11 pr-4 py-3.5 bg-white text-slate-800 rounded-xl text-sm placeholder:text-slate-400 shadow-xl border-2 border-emerald-500/40 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition-all">
          <button x-show="searchQuery" 
                  @click="searchQuery = ''" 
                  type="button" 
                  class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>
      </div>

    </div>
  </section>

  <!-- 2. Main FAQ Content Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Category Filter Tabs (Soft Rounded Style with Link Navigation) -->
      <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-200">
        <div class="flex flex-wrap gap-2 sm:gap-2.5">
          <a href="{{ route('faq', ['kategori' => 'all']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? 'all') === 'all' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>Semua Pertanyaan</span>
          </a>

          <a href="{{ route('faq', ['kategori' => 'ppdb']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'ppdb' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>PPDB & Pendaftaran</span>
          </a>

          <a href="{{ route('faq', ['kategori' => 'pesantren']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'pesantren' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-hotel"></i>
            <span>Asrama & Pesantren</span>
          </a>

          <a href="{{ route('faq', ['kategori' => 'akademik']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'akademik' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-book-open"></i>
            <span>Kurikulum & Legalitas</span>
          </a>

          <a href="{{ route('faq', ['kategori' => 'biaya']) }}" 
             class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-lg border text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ ($currentCategory ?? '') === 'biaya' ? 'bg-emerald-900 text-amber-300 border-amber-400 font-bold shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200 font-medium' }}">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <span>Biaya & Beasiswa</span>
          </a>
        </div>

        @if(isset($faqs) && $faqs->count() > 0)
        <div class="text-xs text-slate-500 font-medium">
          Total: <strong class="text-emerald-900">{{ $faqs->count() }}</strong> Pertanyaan
        </div>
        @endif
      </div>

      <!-- FAQ Accordion List -->
      <div class="space-y-4">
        @forelse($faqs ?? [] as $item)
          @php
            $searchString = strtolower($item->question . ' ' . $item->keywords . ' ' . strip_tags($item->answer));
          @endphp
          <div x-show="matchesSearch('{{ addslashes($searchString) }}')"
               class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xs hover:shadow-md transition-all">
            <button @click="activeFaq = (activeFaq === {{ $item->id }} ? null : {{ $item->id }})" 
                    class="w-full flex items-center justify-between p-4 sm:p-6 text-left font-bold text-slate-900 hover:text-emerald-800 transition-colors focus:outline-none cursor-pointer">
              <span class="flex items-center gap-3 text-xs sm:text-base pr-4 leading-snug">
                <span class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-emerald-100 text-emerald-800 text-xs flex items-center justify-center shrink-0 font-bold">
                  {{ $loop->iteration }}
                </span>
                <span>{{ $item->question }}</span>
              </span>
              <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-300 shrink-0" 
                 :class="activeFaq === {{ $item->id }} ? 'rotate-180 text-emerald-700' : ''"></i>
            </button>
            <div x-show="activeFaq === {{ $item->id }}" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="px-4 sm:px-6 pb-5 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3 sm:pt-4 space-y-2">
              @foreach(explode("\n\n", str_replace("\r", "", $item->answer)) as $paragraph)
                @if(trim($paragraph))
                  <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endif
              @endforeach
            </div>
          </div>
        @empty
          <div class="py-16 text-center bg-white border border-slate-200 rounded-2xl p-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-emerald-50 text-emerald-800 rounded-2xl flex items-center justify-center text-3xl">
              <i class="fa-solid fa-circle-question"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Pertanyaan</h3>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto mt-1">
              Daftar tanya jawab untuk kategori ini belum tersedia atau sedang dalam pembaruan oleh pihak madrasah.
            </p>
            @if(($currentCategory ?? 'all') !== 'all')
            <a href="{{ route('faq', ['kategori' => 'all']) }}" 
               class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-900 text-amber-300 text-xs font-bold rounded-lg border border-amber-400 shadow-sm">
              <i class="fa-solid fa-rotate-left"></i>
              <span>Tampilkan Semua Pertanyaan</span>
            </a>
            @endif
          </div>
        @endforelse
      </div>

      <!-- 3. Contact Helpdesk Card (CTA) -->
      <div class="mt-14 bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-comments"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-headset"></i>
              <span>Layanan Informasi 24 Jam</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Belum Menemukan Jawaban yang Anda Cari?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Tim sekretariat pendaftaran dan asatidz MA Darun Najah Sambikarto siap membantu memberikan informasi lebih lanjut seputar pendaftaran siswa/i baru.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="https://wa.me/6285658973426?text=Assalamu'alaikum%20Admin%20MA%20Darun%20Najah,%20saya%20ingin%20bertanya%20seputar%20informasi%20madrasah%20dan%20PPDB." 
               target="_blank" 
               rel="noopener noreferrer" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-brands fa-whatsapp text-base"></i>
              <span>Chat WhatsApp Panitia</span>
            </a>

            <a href="{{ url('/') }}#kontak" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-solid fa-map-location-dot"></i>
              <span>Lihat Lokasi Kampus</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
