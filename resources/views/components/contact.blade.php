<!-- Kontak & Lokasi Section (Modern Soft Style) -->
<section id="kontak" class="py-16 lg:py-24 bg-slate-50 relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-12 text-center sm:text-left">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-950 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Hubungi Kami</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Lokasi & Sekretariat Madrasah
      </h2>
      <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
        Silakan berkunjung langsung ke kampus kami atau hubungi nomor layanan informasi madrasah.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      
      <!-- Contact Cards Left -->
      <div class="lg:col-span-5 space-y-4">
        
        <!-- Address Card -->
        <div class="bg-white p-5 border-l-4 border-emerald-700 border-y border-r border-slate-200 rounded-xl shadow-sm flex items-start gap-4">
          <div class="w-11 h-11 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-lg shrink-0">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Alamat Kampus</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
              {{ $contact->address ?? 'Jl. Raya Bumi Agung, Desa Sambikarto, Kecamatan Sekampung, Kabupaten Lampung Timur, Lampung 34182.' }}
            </p>
          </div>
        </div>

        <!-- WhatsApp Card -->
        <div class="bg-white p-5 border-l-4 border-emerald-700 border-y border-r border-slate-200 rounded-xl shadow-sm flex items-start gap-4">
          <div class="w-11 h-11 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-xl shrink-0">
            <i class="fa-brands fa-whatsapp"></i>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">{{ $contact->name ?? 'Layanan PPDB & Konsultasi' }}</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 font-mono font-semibold">
              {{ $contact->phone ?? '0856-5897-3426' }}
            </p>
            <a href="{{ $contact ? $contact->getWaLink() : 'https://wa.me/6285658973426' }}" target="_blank" rel="noopener noreferrer" 
               class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 hover:text-emerald-950 mt-2 uppercase tracking-wider">
              <span>Kirim Pesan WhatsApp</span>
              <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>
        </div>

        <!-- Jam Layanan -->
        <div class="bg-white p-5 border-l-4 border-amber-500 border-y border-r border-slate-200 rounded-xl shadow-sm flex items-start gap-4">
          <div class="w-11 h-11 bg-amber-50 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-lg shrink-0">
            <i class="fa-solid fa-clock"></i>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Jam Pelayanan Kantor</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
              {{ $contact->office_hours ?? 'Senin - Sabtu: 07.30 - 14.00 WIB' }}
            </p>
          </div>
        </div>

        <!-- Email & Media Sosial -->
        <div class="bg-emerald-950 text-white p-5 border-l-4 border-amber-400 rounded-xl shadow-sm">
          <h4 class="text-xs font-bold uppercase tracking-widest text-amber-300 mb-2">Media Informasi Resmi</h4>
          @if($contact?->email)
            <p class="text-xs text-emerald-200 mb-2 flex items-center gap-1.5">
              <i class="fa-regular fa-envelope"></i>
              <span>{{ $contact->email }}</span>
            </p>
          @endif
          <p class="text-xs text-emerald-100 mb-3">Ikuti perkembangan kegiatan madrasah melalui kanal resmi kami:</p>
          <div class="flex gap-2">
            <a href="{{ $contact?->facebook_url ?: '#' }}" target="{{ $contact?->facebook_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="w-9 h-9 bg-emerald-900 border border-emerald-700 hover:border-amber-400 rounded-lg text-white flex items-center justify-center text-sm transition-colors" title="Facebook">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="{{ $contact?->instagram_url ?: '#' }}" target="{{ $contact?->instagram_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="w-9 h-9 bg-emerald-900 border border-emerald-700 hover:border-amber-400 rounded-lg text-white flex items-center justify-center text-sm transition-colors" title="Instagram">
              <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="{{ $contact?->youtube_url ?: '#' }}" target="{{ $contact?->youtube_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="w-9 h-9 bg-emerald-900 border border-emerald-700 hover:border-amber-400 rounded-lg text-white flex items-center justify-center text-sm transition-colors" title="YouTube">
              <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="{{ $contact ? $contact->getWaLink() : 'https://wa.me/6285658973426' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-emerald-900 border border-emerald-700 hover:border-amber-400 rounded-lg text-white flex items-center justify-center text-sm transition-colors" title="WhatsApp">
              <i class="fa-brands fa-whatsapp"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Google Maps Embed Right -->
      <div class="lg:col-span-7">
        <div class="bg-white p-3 border-2 border-slate-300 rounded-xl shadow-md">
          <div class="relative w-full aspect-16/11 bg-slate-100 rounded-lg overflow-hidden">
            <iframe 
              title="Peta Lokasi MA Darun Najah Sambikarto"
              src="{{ $contact?->maps_embed_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15891.127821614049!2d105.3400!3d-5.1500!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMDknMDAuMCJTIDEwNcKwMjAnMjQuMCJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid' }}" 
              class="w-full h-full border-0" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <div class="p-3 bg-slate-50 border-t border-slate-200 mt-2 flex flex-col sm:flex-row sm:items-center justify-between text-xs gap-2">
            <span class="text-slate-600 font-medium">MA Darun Najah Sambikarto, Sekampung, Lampung Timur</span>
            <a href="{{ $contact?->maps_link ?: 'https://maps.google.com/?q=MA+Darun+Najah+Sambikarto' }}" target="_blank" rel="noopener noreferrer" 
               class="text-emerald-800 font-bold hover:text-emerald-950 flex items-center gap-1 uppercase tracking-wider">
              <span>Buka di Google Maps</span>
              <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
