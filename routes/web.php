<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PpdbRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $heroSlides = \App\Models\HeroSlide::active()
        ->orderBy('order', 'asc')
        ->get();

    $homeSetting = \App\Models\HomeSetting::first();

    $homeFacilities = \App\Models\Facility::active()
        ->orderBy('order', 'asc')
        ->take(4)
        ->get();

    $homeGalleries = \App\Models\Gallery::where('is_published', true)
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

    $homeCurricula = \App\Models\Curriculum::active()
        ->orderBy('order', 'asc')
        ->get();

    $featuredAchievements = \App\Models\Achievement::active()
        ->featured()
        ->orderBy('order', 'asc')
        ->take(4)
        ->get();

    $featuredTestimonials = \App\Models\Testimonial::active()
        ->featured()
        ->orderBy('order', 'asc')
        ->take(4)
        ->get();

    $featuredTeachers = \App\Models\Teacher::active()
        ->featured()
        ->orderBy('order', 'asc')
        ->take(4)
        ->get();

    if ($featuredTeachers->isEmpty()) {
        $featuredTeachers = \App\Models\Teacher::active()
            ->orderBy('order', 'asc')
            ->take(4)
            ->get();
    }

    $featuredNews = \App\Models\News::published()
        ->featured()
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();

    if ($featuredNews->isEmpty()) {
        $featuredNews = \App\Models\News::published()
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();
    }

    $homeExtracurriculars = \App\Models\Extracurricular::active()
        ->featured()
        ->orderBy('order', 'asc')
        ->take(6)
        ->get();

    if ($homeExtracurriculars->isEmpty()) {
        $homeExtracurriculars = \App\Models\Extracurricular::active()
            ->orderBy('order', 'asc')
            ->take(6)
            ->get();
    }

    return view('welcome', compact('heroSlides', 'homeSetting', 'homeFacilities', 'homeGalleries', 'homeCurricula', 'featuredNews', 'homeExtracurriculars', 'featuredAchievements', 'featuredTestimonials', 'featuredTeachers'));
})->name('home');

Route::get('/tanya-jawab', function (\Illuminate\Http\Request $request) {
    $currentCategory = $request->query('kategori', 'all');

    $query = \App\Models\Faq::active()
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc');

    if ($currentCategory && $currentCategory !== 'all') {
        $query->where('category', $currentCategory);
    }

    $faqs = $query->get();

    return view('pages.faq', compact('faqs', 'currentCategory'));
})->name('faq');

Route::get('/fasilitas', function (\Illuminate\Http\Request $request) {
    $currentCategory = $request->query('kategori', 'all');

    $query = \App\Models\Facility::active()
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc');

    if ($currentCategory && $currentCategory !== 'all') {
        $query->where('category', $currentCategory);
    }

    $facilities = $query->paginate(9)->withQueryString();

    return view('pages.facilities', compact('facilities', 'currentCategory'));
})->name('fasilitas');

Route::get('/galeri', function (\Illuminate\Http\Request $request) {
    $currentCategory = $request->query('kategori', 'all');

    $query = \App\Models\Gallery::where('is_published', true)
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc');

    if ($currentCategory && $currentCategory !== 'all') {
        $query->where('category', $currentCategory);
    }

    $galleries = $query->paginate(12)->withQueryString();

    return view('pages.gallery', compact('galleries', 'currentCategory'));
})->name('galeri');

Route::get('/berita', function () {
    $dbNews = \App\Models\News::where('is_published', true)->orderBy('published_at', 'desc')->get();
    $articles = $dbNews->map(function ($item) {
        $categoryKey = match(true) {
            str_contains(strtolower($item->category), 'ppdb') => 'ppdb',
            str_contains(strtolower($item->category), 'prestasi') => 'prestasi',
            str_contains(strtolower($item->category), 'pesantren') || str_contains(strtolower($item->category), 'kepesantrenan') => 'pesantren',
            default => 'akademik',
        };
        return [
            'id' => $item->id,
            'slug' => $item->slug,
            'url' => route('berita.detail', $item->slug),
            'category' => $categoryKey,
            'categoryLabel' => $item->category,
            'is_featured' => (bool) $item->is_featured,
            'date' => $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y'),
            'author' => $item->author,
            'title' => $item->title,
            'img' => $item->image_url,
            'excerpt' => $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->content), 120),
            'content' => $item->content,
            'reading_time' => $item->reading_time,
        ];
    });

    return view('pages.news', ['dynamicArticles' => $articles]);
})->name('berita');

Route::get('/berita/{slug}', function (string $slug) {
    $article = \App\Models\News::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    // Increment views safely without altering updated_at
    $article->timestamps = false;
    $article->increment('views_count');
    $article->timestamps = true;

    // Related articles (same category first or latest, excluding current article)
    $relatedArticles = \App\Models\News::where('is_published', true)
        ->where('id', '!=', $article->id)
        ->orderByRaw("CASE WHEN category = ? THEN 0 ELSE 1 END", [$article->category])
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    return view('pages.news-detail', compact('article', 'relatedArticles'));
})->name('berita.detail');

Route::get('/kontak', function () {
    return view('pages.contact');
})->name('kontak');

Route::post('/kontak/kirim', [ContactMessageController::class, 'store'])->name('kontak.kirim');

Route::get('/kurikulum', function () {
    $pillars = \App\Models\Curriculum::active()
        ->where('type', 'pilar')
        ->orderBy('order', 'asc')
        ->get();

    $grade10 = \App\Models\Curriculum::active()
        ->where('type', 'kitab')
        ->where('grade', '10')
        ->orderBy('order', 'asc')
        ->get();

    $grade11 = \App\Models\Curriculum::active()
        ->where('type', 'kitab')
        ->where('grade', '11')
        ->orderBy('order', 'asc')
        ->get();

    $grade12 = \App\Models\Curriculum::active()
        ->where('type', 'kitab')
        ->where('grade', '12')
        ->orderBy('order', 'asc')
        ->get();

    $vokasi = \App\Models\Curriculum::active()
        ->where('type', 'vokasi')
        ->orderBy('order', 'asc')
        ->get();

    return view('pages.curriculum', compact('pillars', 'grade10', 'grade11', 'grade12', 'vokasi'));
})->name('kurikulum');

Route::get('/sejarah', function () {
    $milestones = \App\Models\History::active()
        ->milestones()
        ->orderBy('order', 'asc')
        ->get();

    $figures = \App\Models\History::active()
        ->figures()
        ->orderBy('order', 'asc')
        ->get();

    $narrative = \App\Models\History::active()
        ->narratives()
        ->orderBy('order', 'asc')
        ->first();

    return view('pages.history', compact('milestones', 'figures', 'narrative'));
})->name('sejarah');

Route::get('/ekstrakulikuler', function (\Illuminate\Http\Request $request) {
    $currentCategory = $request->query('kategori', 'all');

    $query = \App\Models\Extracurricular::active()
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc');

    if ($currentCategory && $currentCategory !== 'all') {
        $query->where('category', $currentCategory);
    }

    $extracurriculars = $query->paginate(9)->withQueryString();

    return view('pages.extracurricular', compact('extracurriculars', 'currentCategory'));
})->name('ekstrakulikuler');

Route::get('/ekstrakurikuler', function () {
    return redirect()->route('ekstrakulikuler');
});

Route::get('/guru', function (\Illuminate\Http\Request $request) {
    $currentCategory = $request->query('kategori', 'all');

    $query = \App\Models\Teacher::active()
        ->orderBy('order', 'asc')
        ->orderBy('name', 'asc');

    if ($currentCategory && $currentCategory !== 'all') {
        $query->where('category', $currentCategory);
    }

    $teachers = $query->paginate(12)->withQueryString();

    $categoriesCount = [
        'all' => \App\Models\Teacher::active()->count(),
        'pimpinan' => \App\Models\Teacher::active()->where('category', 'pimpinan')->count(),
        'asatidz_kitab' => \App\Models\Teacher::active()->where('category', 'asatidz_kitab')->count(),
        'guru_mapel' => \App\Models\Teacher::active()->where('category', 'guru_mapel')->count(),
        'staf' => \App\Models\Teacher::active()->where('category', 'staf')->count(),
    ];

    return view('pages.teachers', compact('teachers', 'currentCategory', 'categoriesCount'));
})->name('guru');

Route::get('/ppdb', function () {
    return view('pages.ppdb');
})->name('ppdb');

Route::post('/ppdb/daftar', [PpdbRegistrationController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/cek-status', [PpdbRegistrationController::class, 'checkStatus'])->name('ppdb.status');
Route::get('/ppdb/cetak/{registration_number}', [PpdbRegistrationController::class, 'printCard'])->name('ppdb.print');
Route::get('/admin/ppdb/export-csv', [PpdbRegistrationController::class, 'exportCsv'])->name('admin.ppdb.export');

// Dynamic Sitemap for Production SEO
Route::get('/sitemap.xml', function () {
    $staticPages = [
        ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
        ['url' => route('ppdb'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['url' => route('berita'), 'priority' => '0.8', 'changefreq' => 'daily'],
        ['url' => route('kurikulum'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['url' => route('sejarah'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => route('guru'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => route('fasilitas'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => route('ekstrakulikuler'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => route('galeri'), 'priority' => '0.7', 'changefreq' => 'weekly'],
        ['url' => route('kontak'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['url' => route('faq'), 'priority' => '0.6', 'changefreq' => 'monthly'],
    ];

    $news = \App\Models\News::published()->orderBy('published_at', 'desc')->get();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($staticPages as $page) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($page['url']) . '</loc>';
        $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
        $xml .= '<priority>' . $page['priority'] . '</priority>';
        $xml .= '</url>';
    }

    foreach ($news as $item) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars(route('berita.detail', $item->slug)) . '</loc>';
        $xml .= '<lastmod>' . ($item->published_at ? $item->published_at->format('Y-m-d') : $item->created_at->format('Y-m-d')) . '</lastmod>';
        $xml .= '<changefreq>monthly</changefreq>';
        $xml .= '<priority>0.7</priority>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml',
    ]);
});
