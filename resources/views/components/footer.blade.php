<!-- Footer Section (Modern Soft Style) -->
<footer class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Top Footer Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800">
      
      <!-- Col 1: Identity (5 cols) -->
      <div class="lg:col-span-5 space-y-4">
        <div class="flex items-center gap-3">
          <img src="{{ !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png')) }}" alt="Logo {{ $siteSetting->site_name ?? 'MA Darun Najah' }}" loading="lazy" decoding="async" class="w-12 h-12 object-contain">
          <div>
            <h3 class="text-white font-extrabold text-lg tracking-tight">{{ $siteSetting->site_name ?? 'PPDN Darun Najah' }}</h3>
            <p class="text-amber-400 text-xs font-semibold">{{ $siteSetting->site_tagline ?? 'Madrasah Aliyah • Sambikarto, Sekampung' }}</p>
          </div>
        </div>
        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-sm">
          Pendidikan menengah Islam terakreditasi di bawah naungan LP Ma'arif NU. Mengedepankan integritas moral, kedalaman ilmu agama salafiyah, dan kemandirian santri.
        </p>
        <div class="pt-2 text-xs text-slate-400 space-y-1">
          <p><span class="text-slate-200 font-semibold">Ketua Yayasan:</span> {{ $siteSetting->foundation_head ?? 'Suparno, S.Pd.I' }}</p>
          <p><span class="text-slate-200 font-semibold">Pengasuh:</span> {{ $siteSetting->leader_name ?? 'KH. Sahlan Abdulloh & KH. Abdul Ghofar, S.Pd.I' }}</p>
        </div>

        <!-- Social Media Icons (Soft Rounded) -->
        <div class="flex gap-2 pt-2">
          <a href="{{ $contact?->facebook_url ?: '#' }}" target="{{ $contact?->facebook_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-emerald-700 text-slate-300 hover:text-white flex items-center justify-center text-xs transition-colors" title="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="{{ $contact?->instagram_url ?: '#' }}" target="{{ $contact?->instagram_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-emerald-700 text-slate-300 hover:text-white flex items-center justify-center text-xs transition-colors" title="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="{{ $contact?->youtube_url ?: '#' }}" target="{{ $contact?->youtube_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-emerald-700 text-slate-300 hover:text-white flex items-center justify-center text-xs transition-colors" title="YouTube">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a href="{{ $contact ? $contact->getWaLink() : 'https://wa.me/6285658973426' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-emerald-700 text-slate-300 hover:text-white flex items-center justify-center text-xs transition-colors" title="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
          </a>
        </div>
      </div>

      <!-- Col 2: Quick Links (3 cols) -->
      <div class="lg:col-span-3 space-y-3">
        <h4 class="text-white font-bold text-sm tracking-wider uppercase">Navigasi Utama</h4>
        <ul class="space-y-2 text-xs sm:text-sm">
          <li><a href="{{ url('/') }}#beranda" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Beranda</a></li>
          <li><a href="{{ route('sejarah') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Profil & Sejarah</a></li>
          <li><a href="{{ route('guru') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Dewan Guru & Asatidz</a></li>
          <li><a href="{{ route('kurikulum') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Kurikulum Pendidikan</a></li>
          <li><a href="{{ route('ekstrakulikuler') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Ekstrakurikuler</a></li>
          <li><a href="{{ route('fasilitas') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Fasilitas Kampus</a></li>
          <li><a href="{{ route('galeri') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Galeri Foto</a></li>
          <li><a href="{{ route('berita') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Warta & Berita</a></li>
          <li><a href="{{ route('faq') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Tanya Jawab (FAQ)</a></li>
          <li><a href="{{ route('kontak') }}" class="hover:text-amber-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Kontak & Lokasi</a></li>
        </ul>
      </div>

      <!-- Col 3: Sekretariat & Layanan (4 cols) -->
      <div class="lg:col-span-4 space-y-3">
        <h4 class="text-white font-bold text-sm tracking-wider uppercase">Sekretariat & Pendaftaran</h4>
        <div class="space-y-3 text-xs sm:text-sm text-slate-400">
          <div class="flex items-start gap-2.5">
            <i class="fa-solid fa-location-dot text-emerald-500 mt-1 shrink-0"></i>
            <span>{{ $contact->address ?? 'Jl. Raya Bumi Agung, Desa Sambikarto, Kec. Sekampung, Kab. Lampung Timur 34182' }}</span>
          </div>
          <div class="flex items-center gap-2.5">
            <i class="fa-brands fa-whatsapp text-emerald-500 shrink-0"></i>
            <a href="{{ $contact ? $contact->getWaLink() : 'https://wa.me/6285658973426' }}" target="_blank" rel="noopener noreferrer" class="hover:text-amber-400 transition-colors font-mono">
              {{ $contact->phone ?? '0856-5897-3426' }} ({{ $contact->name ?? 'Panitia PPDB' }})
            </a>
          </div>
          <div class="pt-2">
            <a href="{{ route('ppdb') }}" class="inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-lg transition-all border-b-2 border-emerald-950 hover:-translate-y-0.5 shadow-sm">
              <i class="fa-solid fa-graduation-cap text-amber-400"></i>
              <span>Daftar Santri Baru (Online)</span>
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom Footer -->
    <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-400">
      
      <!-- Copyright & Support By -->
      <div class="text-center md:text-left space-y-1">
        <p>&copy; 2026 Madrasah Aliyah Darun Najah Sambikarto. Hak Cipta Dilindungi.</p>
        <p class="inline-flex items-center gap-1.5 text-slate-300">
          <i class="fa-solid fa-laptop-code text-amber-400"></i>
          <span>Support By</span>
          <a href="https://www.langgas-sinau.com/" target="_blank" rel="noopener noreferrer" 
             class="font-bold text-amber-400 underline decoration-amber-400/50 hover:text-white hover:decoration-white transition-all">
            LKP Langgas Sinau
          </a>
        </p>
      </div>

      <!-- Back to Top Link (Soft Rounded) -->
      <div class="flex items-center gap-4">
        <a href="{{ url('/') }}#beranda" class="px-3.5 py-1.5 rounded-lg bg-slate-800 hover:bg-emerald-800 text-slate-300 hover:text-white transition-colors flex items-center gap-1.5 text-xs">
          <span>Kembali ke Atas</span>
          <i class="fa-solid fa-arrow-up text-[10px]"></i>
        </a>
      </div>

    </div>

  </div>
</footer>
