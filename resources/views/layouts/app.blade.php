<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  @php
    $defaultTitle = $siteSetting->seo_meta_title ?? 'Madrasah Aliyah Darun Najah Sambikarto • Pendidikan Islam Berkarakter, Berakhlak Mulia & Mandiri';
    $defaultDesc = $siteSetting->seo_meta_description ?? 'Website Resmi Madrasah Aliyah Darun Najah Sambikarto, Sekampung, Lampung Timur. Lembaga pendidikan terakreditasi di bawah naungan LP Ma\'arif NU dengan perpaduan kurikulum nasional dan pesantren salafiyah.';
    $defaultKeywords = $siteSetting->seo_meta_keywords ?? 'MA Darun Najah, MA Darun Najah Sambikarto, Madrasah Aliyah Sekampung, Pesantren Darun Najah Sambikarto, PPDB MA Darun Najah 2026, Madrasah Lampung Timur';
    $defaultOgImage = !empty($siteSetting?->seo_og_image) ? $siteSetting->seo_og_image_url : (function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg'));
    $siteFavicon = !empty($siteSetting?->site_favicon) ? $siteSetting->site_favicon_url : (function_exists('webp_asset') ? webp_asset('assets/images/favicon.png') : asset('assets/images/favicon.png'));
    $siteLogo = !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png'));
    $siteBrandName = $siteSetting->site_name ?? 'MA Darun Najah Sambikarto';
  @endphp

  <title>@yield('title', $defaultTitle)</title>
  <meta name="description" content="@yield('meta_description', $defaultDesc)">
  <meta name="keywords" content="@yield('meta_keywords', $defaultKeywords)">
  <link rel="canonical" href="@yield('canonical_url', url()->current())">
  <meta name="author" content="@yield('meta_author', $siteBrandName)">
  <meta name="robots" content="@yield('meta_robots', 'index, follow')">

  <!-- Open Graph / Facebook / WhatsApp -->
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:url" content="@yield('og_url', url()->current())">
  <meta property="og:title" content="@yield('og_title', View::yieldContent('title', $defaultTitle))">
  <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', $defaultDesc))">
  <meta property="og:image" content="@yield('og_image', $defaultOgImage)">
  <meta property="og:site_name" content="{{ $siteBrandName }}">
  <meta property="og:locale" content="id_ID">
  @yield('og_article_meta')

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="@yield('og_url', url()->current())">
  <meta name="twitter:title" content="@yield('og_title', View::yieldContent('title', $defaultTitle))">
  <meta name="twitter:description" content="@yield('og_description', View::yieldContent('meta_description', $defaultDesc))">
  <meta name="twitter:image" content="@yield('og_image', $defaultOgImage)">

  <!-- Schema.org JSON-LD Structured Data -->
  @yield('schema')
  
  <!-- PWA & Mobile Web App Meta -->
  <meta name="theme-color" content="#064e3b">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="MA Darun Najah">
  <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ $siteFavicon }}">
  <link rel="apple-touch-icon" href="{{ $siteLogo }}">

  <!-- Resource Hints & CDNs Preconnect -->
  <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
  <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Vite Scripts and Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased selection:bg-emerald-600 selection:text-white overflow-x-hidden">

  <!-- Navbar Component -->
  <x-navbar />

  <!-- Main Content -->
  <main id="main-content">
    @yield('content')
  </main>

  <!-- Footer Component -->
  <x-footer />

  <!-- Floating Widgets (WhatsApp & Back to Top) -->
  <x-floating-wa />

  <!-- PWA Service Worker Registration -->
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
      });
    }
  </script>
</body>
</html>
