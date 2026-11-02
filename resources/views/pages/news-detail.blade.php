@extends('layouts.app')

{{-- SEO Title & Meta Tags --}}
@section('title', $article->seo_title)
@section('meta_description', $article->seo_description)
@section('meta_keywords', $article->meta_keywords ?: 'berita ma darun najah, ' . strtolower($article->category) . ', warta madrasah lampung timur, pesantren darun najah sambikarto')
@section('canonical_url', route('berita.detail', $article->slug))
@section('meta_author', $article->author)

{{-- Open Graph / Social Media Sharing --}}
@section('og_type', 'article')
@section('og_url', route('berita.detail', $article->slug))
@section('og_title', $article->title)
@section('og_description', $article->seo_description)
@section('og_image', $article->image_url)

@section('og_article_meta')
  <meta property="article:published_time" content="{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}">
  <meta property="article:modified_time" content="{{ $article->updated_at->toIso8601String() }}">
  <meta property="article:author" content="{{ $article->author }}">
  <meta property="article:section" content="{{ $article->category }}">
  <meta property="article:tag" content="{{ $article->category }}">
@endsection

{{-- Schema.org JSON-LD Structured Data for Google News & Search --}}
@section('schema')
<script type="application/ld+json">
{!! json_encode([
  chr(64) . 'context' => 'https://schema.org',
  chr(64) . 'type' => 'NewsArticle',
  'mainEntityOfPage' => [
    chr(64) . 'type' => 'WebPage',
    chr(64) . 'id' => route('berita.detail', $article->slug),
  ],
  'headline' => $article->title,
  'image' => [
    $article->image_url
  ],
  'datePublished' => $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String(),
  'dateModified' => $article->updated_at->toIso8601String(),
  'author' => [
    chr(64) . 'type' => 'Person',
    'name' => $article->author,
  ],
  'publisher' => [
    chr(64) . 'type' => 'Organization',
    'name' => 'MA Darun Najah Sambikarto',
    'logo' => [
      chr(64) . 'type' => 'ImageObject',
      'url' => function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png'),
    ],
  ],
  'description' => $article->seo_description,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
  chr(64) . 'context' => 'https://schema.org',
  chr(64) . 'type' => 'BreadcrumbList',
  'itemListElement' => [
    [
      chr(64) . 'type' => 'ListItem',
      'position' => 1,
      'name' => 'Beranda',
      'item' => url('/'),
    ],
    [
      chr(64) . 'type' => 'ListItem',
      'position' => 2,
      'name' => 'Warta & Berita',
      'item' => route('berita'),
    ],
    [
      chr(64) . 'type' => 'ListItem',
      'position' => 3,
      'name' => $article->title,
      'item' => route('berita.detail', $article->slug),
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen py-10 lg:py-14" 
     x-data="{ 
       copied: false,
       copyUrl() {
         navigator.clipboard.writeText(window.location.href);
         this.copied = true;
         setTimeout(() => this.copied = false, 2500);
       }
     }">
  
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- 1. Breadcrumbs Navigation -->
    <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-8 overflow-x-auto pb-1" aria-label="Breadcrumb">
      <a href="{{ url('/') }}" class="hover:text-emerald-700 transition-colors flex items-center gap-1.5 shrink-0">
        <i class="fa-solid fa-house text-[11px]"></i>
        <span>Beranda</span>
      </a>
      <span class="text-slate-300">/</span>
      <a href="{{ route('berita') }}" class="hover:text-emerald-700 transition-colors shrink-0">
        <span>Warta & Berita</span>
      </a>
      <span class="text-slate-300">/</span>
      <span class="text-emerald-800 font-bold truncate max-w-[200px] sm:max-w-[350px]">
        {{ $article->category }}
      </span>
    </nav>

    <!-- 2. Main Article Card -->
    <article class="bg-white border border-slate-200/90 rounded-2xl shadow-sm overflow-hidden mb-12">
      
      <!-- Article Header -->
      <header class="p-6 sm:p-8 lg:p-10 border-b border-slate-100">
        
        <!-- Category & Date Badge -->
        <div class="flex flex-wrap items-center gap-2.5 mb-4">
          @php $colorTheme = $article->category_color; @endphp
          <span class="px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ $colorTheme['bg'] }} {{ $colorTheme['text'] }} border {{ $colorTheme['border'] }}">
            {{ $article->category }}
          </span>

          <span class="text-xs text-slate-400">•</span>

          <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500">
            <i class="fa-regular fa-clock text-slate-400"></i>
            <span>{{ $article->reading_time }}</span>
          </span>

          @if($article->views_count > 0)
            <span class="text-xs text-slate-400">•</span>
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500">
              <i class="fa-regular fa-eye text-slate-400"></i>
              <span>{{ number_format($article->views_count) }} kali dibaca</span>
            </span>
          @endif
        </div>

        <!-- Article Headline -->
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight mb-5">
          {{ $article->title }}
        </h1>

        <!-- Author & Published Time Bar -->
        <div class="flex items-center justify-between flex-wrap gap-4 pt-4 border-t border-slate-100 text-xs sm:text-sm text-slate-600">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-950 text-amber-400 flex items-center justify-center font-bold text-sm shadow-sm">
              <i class="fa-solid fa-feather-pointed"></i>
            </div>
            <div>
              <div class="font-bold text-slate-900">{{ $article->author }}</div>
              <div class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                <i class="fa-regular fa-calendar-check text-emerald-700"></i>
                <time datetime="{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}">
                  {{ $article->formatted_date }}
                </time>
              </div>
            </div>
          </div>

          <!-- Share Actions Quick Links -->
          <div class="flex items-center gap-1.5">
            <span class="text-xs font-semibold text-slate-500 mr-1 hidden sm:inline">Bagikan:</span>
            
            <!-- WhatsApp -->
            <a href="https://api.whatsapp.com/send?text={{ rawurlencode($article->title . "\n\nBaca selengkapnya di: " . url()->current()) }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               title="Bagikan ke WhatsApp"
               class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors">
              <i class="fa-brands fa-whatsapp text-sm"></i>
            </a>

            <!-- Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               title="Bagikan ke Facebook"
               class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors">
              <i class="fa-brands fa-facebook-f text-xs"></i>
            </a>

            <!-- X / Twitter -->
            <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($article->title) }}&url={{ urlencode(url()->current()) }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               title="Bagikan ke X"
               class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 hover:bg-black hover:text-white flex items-center justify-center transition-colors">
              <i class="fa-brands fa-x-twitter text-xs"></i>
            </a>

            <!-- Copy Link Button -->
            <button @click="copyUrl()" 
                    type="button" 
                    title="Salin Tautan"
                    class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-amber-400 hover:text-emerald-950 flex items-center justify-center transition-colors cursor-pointer relative">
              <i class="fa-solid fa-link text-xs"></i>
              <span x-show="copied" 
                    x-cloak
                    class="absolute -top-8 right-0 bg-emerald-900 text-white text-[10px] font-semibold py-1 px-2 rounded shadow whitespace-nowrap">
                Tersalin!
              </span>
            </button>
          </div>

        </div>

      </header>

      <!-- Featured Image -->
      <div class="relative bg-slate-100 border-b border-slate-100 overflow-hidden">
        <img src="{{ $article->image_url }}" 
             alt="{{ $article->title }}" 
             class="w-full max-h-[480px] object-cover object-center"
             loading="eager">
        <div class="px-6 py-2.5 bg-slate-50/90 text-slate-500 text-[11px] italic flex items-center justify-between border-t border-slate-100">
          <span><i class="fa-solid fa-camera mr-1 text-slate-400"></i> Dokumentasi Humas MA Darun Najah Sambikarto</span>
          <span class="text-[10px] uppercase font-bold text-emerald-800">Dokumentasi Resmi</span>
        </div>
      </div>

      <!-- Article Content Body -->
      <div class="p-6 sm:p-8 lg:p-10">
        
        <!-- Lead Paragraph (Excerpt) -->
        @if(!empty($article->excerpt))
          <div class="p-4 sm:p-5 rounded-xl bg-emerald-50/70 border-l-4 border-emerald-600 text-slate-700 font-medium text-sm sm:text-base leading-relaxed mb-8">
            {{ $article->excerpt }}
          </div>
        @endif

        <!-- Full Content (Formatted with double newline separation or rich text) -->
        <div class="article-content text-slate-800 text-base sm:text-[17px] leading-relaxed space-y-5">
          @foreach(preg_split('/\r\n\r\n|\n\n/', $article->content) as $paragraph)
            @if(trim($paragraph))
              <p class="text-justify leading-relaxed">
                {!! nl2br(e(trim($paragraph))) !!}
              </p>
            @endif
          @endforeach
        </div>

        <!-- Social Share Bar (Bottom Box) -->
        <div class="mt-10 pt-6 border-t border-slate-200">
          <div class="bg-slate-50 rounded-xl p-5 border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-center sm:text-left">
              <h4 class="font-bold text-slate-900 text-sm">Bagikan Kabar Baik Ini:</h4>
              <p class="text-xs text-slate-500 mt-0.5">Sebarkan warta dan prestasi santri kepada keluarga serta masyarakat luas.</p>
            </div>

            <div class="flex items-center gap-2">
              <a href="https://api.whatsapp.com/send?text={{ rawurlencode($article->title . "\n\nBaca selengkapnya di: " . url()->current()) }}" 
                 target="_blank" 
                 rel="noopener noreferrer" 
                 class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>WhatsApp</span>
              </a>

              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                 target="_blank" 
                 rel="noopener noreferrer" 
                 class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-colors">
                <i class="fa-brands fa-facebook-f text-xs"></i>
                <span>Facebook</span>
              </a>

              <button @click="copyUrl()" 
                      type="button" 
                      class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold transition-colors cursor-pointer relative">
                <i class="fa-solid fa-link text-xs"></i>
                <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Redaksi / Penulis Box -->
        <div class="mt-8 p-5 rounded-xl border border-slate-200 bg-white flex items-start gap-4">
          <div class="w-12 h-12 rounded-full bg-emerald-950 text-amber-400 flex items-center justify-center font-bold text-lg shrink-0 shadow">
            <i class="fa-solid fa-school"></i>
          </div>
          <div>
            <div class="flex items-center gap-2">
              <h4 class="font-bold text-slate-900 text-sm">{{ $article->author }}</h4>
              <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded uppercase tracking-wider">Redaksi Resmi</span>
            </div>
            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
              Diterbitkan oleh Divisi Hubungan Masyarakat & Publikasi Digital Madrasah Aliyah Darun Najah Sambikarto, Sekampung, Lampung Timur. Seluruh materi berita ini diverifikasi kebenarannya oleh pihak madrasah.
            </p>
          </div>
        </div>

      </div>

      <!-- Article Footer Back Button -->
      <footer class="p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
        <a href="{{ route('berita') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-emerald-800 hover:text-emerald-950 transition-colors">
          <i class="fa-solid fa-arrow-left"></i>
          <span>Kembali ke Semua Warta & Berita</span>
        </a>

        <a href="{{ url('/') }}" 
           class="text-xs text-slate-500 hover:text-slate-800 transition-colors">
          <span>Menuju Beranda</span>
        </a>
      </footer>

    </article>

    <!-- 3. Related Articles Section -->
    @if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
      <section class="mb-14">
        <div class="flex items-center justify-between mb-6">
          <div>
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
              Rekomendasi Bacaan
            </span>
            <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-2">
              Warta & Pengumuman Lainnya
            </h3>
          </div>
          <a href="{{ route('berita') }}" class="text-xs sm:text-sm font-bold text-emerald-800 hover:text-amber-600 transition-colors hidden sm:flex items-center gap-1.5">
            <span>Lihat Semua</span>
            <i class="fa-solid fa-arrow-right text-xs"></i>
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @foreach($relatedArticles as $rel)
            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col">
              <a href="{{ route('berita.detail', $rel->slug) }}" class="block relative aspect-video bg-slate-100 overflow-hidden group">
                <img src="{{ $rel->image_url }}" 
                     alt="{{ $rel->title }}" 
                     loading="lazy"
                     decoding="async"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-950/90 text-amber-400 backdrop-blur-sm">
                  {{ $rel->category }}
                </span>
              </a>
              <div class="p-4 flex-1 flex flex-col justify-between">
                <div>
                  <div class="text-[11px] text-slate-400 flex items-center gap-1.5 mb-2">
                    <i class="fa-regular fa-calendar text-slate-400"></i>
                    <span>{{ $rel->formatted_date }}</span>
                  </div>
                  <h4 class="font-bold text-sm text-slate-900 line-clamp-2 hover:text-emerald-800 transition-colors">
                    <a href="{{ route('berita.detail', $rel->slug) }}">
                      {{ $rel->title }}
                    </a>
                  </h4>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-800">
                  <a href="{{ route('berita.detail', $rel->slug) }}" class="inline-flex items-center gap-1 hover:text-amber-600 transition-colors">
                    <span>Baca Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                  </a>
                  <span class="text-[11px] text-slate-400 font-normal">{{ $rel->reading_time }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    @endif

    <!-- 4. PPDB Call to Action Box -->
    <div class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 shadow-xl border border-emerald-800 relative overflow-hidden">
      <div class="absolute -right-8 -bottom-8 opacity-10 text-white text-9xl pointer-events-none">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
      <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="max-w-xl">
          <span class="inline-block px-3 py-1 bg-amber-400/20 text-amber-300 text-[10px] font-bold uppercase tracking-wider rounded border border-amber-400/30 mb-2">
            Pendaftaran Santri Baru 2026/2027
          </span>
          <h3 class="text-xl sm:text-2xl font-extrabold text-white">
            Tertarik Menjadi Bagian dari MA Darun Najah?
          </h3>
          <p class="text-xs sm:text-sm text-emerald-100/90 mt-1.5 leading-relaxed">
            Daftarkan diri Anda secara online untuk jalur reguler atau beasiswa tahfidz Al-Qur'an dan prestasi.
          </p>
        </div>
        <div class="shrink-0 flex flex-col sm:flex-row gap-3">
          <a href="{{ url('/') }}#ppdb" 
             class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg transition-all">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Daftar Online</span>
          </a>
          <a href="{{ route('kontak') }}" 
             class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all">
            <i class="fa-solid fa-phone"></i>
            <span>Kontak Kami</span>
          </a>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
