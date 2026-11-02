@extends('layouts.app')

@section('content')
  <!-- 1. Hero Section (Banner Slider & Pengumuman Ticker Dinamis) -->
  <x-hero :heroSlides="$heroSlides ?? null" :homeSetting="$homeSetting ?? null" />

  <!-- 2. Profil Lembaga & Visi Misi (Dinamis) -->
  <x-profile :homeSetting="$homeSetting ?? null" />

  <!-- 3. Kurikulum Terpadu (Dinamis) -->
  <x-curriculum />

  <!-- 4. Dewan Guru & Asatidz Pesantren (Dinamis) -->
  <x-teachers :teachers="$featuredTeachers ?? null" />

  <!-- 5. Ekstrakurikuler (Dinamis) -->
  <x-extracurricular />

  <!-- 5. Deretan Prestasi & Kejuaraan Santri (Dinamis) -->
  <x-achievements :achievements="$featuredAchievements ?? null" />

  <!-- 6. Fasilitas Madrasah (Dinamis) -->
  <x-facilities :homeFacilities="$homeFacilities ?? null" />

  <!-- 7. Galeri & Dokumentasi (Dinamis) -->
  <x-gallery />

  <!-- 8. Berita & Informasi Terkini (Khusus Berita Unggulan) -->
  <x-news :featuredNews="$featuredNews ?? null" />

  <!-- 9. Suara Alumni & Testimoni Wali Santri (Dinamis) -->
  <x-testimonials :testimonials="$featuredTestimonials ?? null" />

  <!-- 10. Penerimaan Peserta Didik Baru (PPDB Online Dinamis) -->
  <x-ppdb :ppdbSetting="$ppdbSetting ?? null" />

  <!-- 11. Kontak & Lokasi (Dinamis) -->
  <x-contact />
@endsection
