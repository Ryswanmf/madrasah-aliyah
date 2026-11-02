@extends('layouts.app')

@section('title', 'Kontak, Lokasi Kampus & Sekretariat Resmi • MA Darun Najah Sambikarto')

@section('content')
<!-- Contact Page Container -->
<div class="bg-slate-50 min-h-screen">
  @if(session('open_wa_url'))
    <script>
      window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
          window.open("{{ session('open_wa_url') }}", "_blank");
        }, 400);
      });
    </script>
  @endif

  <!-- 1. Hero Header Banner (Signature Green & Photo Blend) -->
  <section class="relative bg-emerald-950 text-white overflow-hidden py-16 lg:py-20 border-b border-emerald-900">
    <!-- Background Image & Gradient Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <img src="{{ function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg') }}" 
           alt="Kampus MA Darun Najah" 
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
        <span class="text-amber-300">Kontak & Lokasi</span>
      </nav>

      <!-- Header Content -->
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-900/90 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
          <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
          <span>Layanan Informasi & Sekretariat</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
          Kontak & Lokasi <span class="text-amber-400">Madrasah</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
          Kami siap melayani kebutuhan informasi seputar pendaftaran santri baru (PPDB), kurikulum kepesantrenan, kunjungan orang tua/wali santri, serta kerja sama kelembagaan.
        </p>
      </div>

    </div>
  </section>

  <!-- 2. Main Contact Section -->
  <section class="py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- 4 Quick Contact Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        <!-- Card 1: Alamat -->
        <div class="bg-white p-6 border-t-4 border-emerald-600 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Alamat Kampus</h3>
          <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
            {{ $contact->address ?? 'Jl. Raya Bumi Agung, Desa Sambikarto, Kec. Sekampung, Kab. Lampung Timur 34182.' }}
          </p>
        </div>

        <!-- Card 2: WhatsApp Hotline -->
        <div class="bg-white p-6 border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 bg-amber-50 text-amber-800 border border-amber-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-brands fa-whatsapp"></i>
          </div>
          <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">{{ $contact->name ?? 'Hotline WhatsApp' }}</h3>
          <p class="text-xs sm:text-sm text-slate-600 mt-2 font-mono font-semibold">
            {{ $contact->phone ?? '0856-5897-3426' }}
          </p>
          <a href="{{ $contact ? $contact->getWaLink() : 'https://wa.me/6285658973426' }}" target="_blank" rel="noopener noreferrer" 
             class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 hover:text-emerald-950 mt-3 uppercase tracking-wider">
            <span>Chat Sekarang</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

        <!-- Card 3: Jam Layanan -->
        <div class="bg-white p-6 border-t-4 border-sky-600 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 bg-sky-50 text-sky-800 border border-sky-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-clock"></i>
          </div>
          <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Jam Pelayanan Kantor</h3>
          <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
            {{ $contact->office_hours ?? 'Senin – Sabtu: 07.30 – 14.00 WIB' }}
          </p>
        </div>

        <!-- Card 4: Email & Surat -->
        <div class="bg-white p-6 border-t-4 border-purple-600 border-x border-b border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 bg-purple-50 text-purple-800 border border-purple-200 rounded-lg flex items-center justify-center text-xl mb-4">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Surat & Korespondensi</h3>
          <p class="text-xs sm:text-sm text-slate-600 mt-2 break-all font-mono">
            {{ $contact->email ?? 'madarunnajah.sambikarto@gmail.com' }}
          </p>
        </div>

      </div>

      <!-- Grid Form Pesan & Google Maps Embed -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Form Pesan Langsung (5 Cols) -->
        <div class="lg:col-span-5 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
          <div class="mb-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider rounded-md mb-2 border border-emerald-200">
              <i class="fa-solid fa-paper-plane text-emerald-600"></i>
              <span>Hubungi Sekretariat</span>
            </div>
            <h3 class="text-xl font-extrabold text-slate-900">Kirim Pesan / Pertanyaan</h3>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
              Tulis pesan atau pertanyaan Anda. Pesan akan langsung tersimpan di sistem administrasi madrasah dan ditindaklanjuti oleh panitia.
            </p>
          </div>

          <!-- Alert Success -->
          @if(session('success'))
          <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm flex items-start gap-3 shadow-xs">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5 shrink-0"></i>
            <div class="space-y-1">
              <h4 class="font-bold text-emerald-950">Pesan Berhasil Terkirim!</h4>
              <p class="leading-relaxed">{{ session('success') }}</p>
              @if(session('open_wa_url'))
                <div class="pt-2">
                  <a href="{{ session('open_wa_url') }}" target="_blank" rel="noopener noreferrer" 
                     class="inline-flex items-center gap-1.5 font-bold text-emerald-800 underline hover:text-emerald-950">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Buka WhatsApp Lagi</span>
                  </a>
                </div>
              @endif
            </div>
          </div>
          @endif

          <!-- Alert Validation Errors -->
          @if($errors->any())
          <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm flex items-start gap-3">
            <i class="fa-solid fa-circle-exclamation text-red-500 text-lg mt-0.5 shrink-0"></i>
            <div>
              <h4 class="font-bold text-red-900 mb-1">Mohon Periksa Isian Anda:</h4>
              <ul class="list-disc list-inside space-y-0.5 text-xs text-red-700">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
          @endif

          <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div>
              <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Nama Lengkap Anda <span class="text-red-500">*</span>
              </label>
              <input type="text" 
                     id="name" 
                     name="name" 
                     value="{{ old('name') }}"
                     placeholder="Contoh: Bapak Ahmad Fauzi" 
                     required
                     class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
            </div>

            <!-- Nomor WhatsApp & Email (2 Cols on Tablet/Desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
              <div>
                <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  No. WhatsApp / HP <span class="text-red-500">*</span>
                </label>
                <input type="tel" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone') }}"
                       placeholder="Contoh: 081234567890" 
                       required
                       class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
              </div>

              <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Email (Opsional)
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="nama@email.com" 
                       class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
              </div>
            </div>

            <!-- Keperluan -->
            <div>
              <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Topik / Keperluan <span class="text-red-500">*</span>
              </label>
              <select id="subject" 
                      name="subject" 
                      class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                <option value="Informasi PPDB 2026/2027" {{ old('subject') === 'Informasi PPDB 2026/2027' ? 'selected' : '' }}>Informasi Pendaftaran Santri Baru (PPDB)</option>
                <option value="Kurikulum & Kepesantrenan" {{ old('subject') === 'Kurikulum & Kepesantrenan' ? 'selected' : '' }}>Kurikulum & Kegiatan Pondok Pesantren</option>
                <option value="Administrasi & Surat Menyurat" {{ old('subject') === 'Administrasi & Surat Menyurat' ? 'selected' : '' }}>Administrasi & Surat Menyurat</option>
                <option value="Kunjungan Lembaga" {{ old('subject') === 'Kunjungan Lembaga' ? 'selected' : '' }}>Kunjungan Tamu / Silaturahmi Lembaga</option>
                <option value="Lainnya" {{ old('subject') === 'Lainnya' ? 'selected' : '' }}>Pertanyaan Umum Lainnya</option>
              </select>
            </div>

            <!-- Isi Pesan -->
            <div>
              <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Pesan atau Pertanyaan <span class="text-red-500">*</span>
              </label>
              <textarea id="message" 
                        name="message" 
                        rows="4" 
                        required
                        placeholder="Tuliskan pertanyaan atau hal yang ingin Anda tanyakan secara jelas..." 
                        class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">{{ old('message') }}</textarea>
            </div>

            <!-- Direct WhatsApp Checkbox Option -->
            <div class="flex items-start gap-2.5 pt-1">
              <input type="checkbox" 
                     id="direct_whatsapp" 
                     name="direct_whatsapp" 
                     value="1" 
                     checked
                     class="mt-1 rounded border-slate-300 text-emerald-800 focus:ring-emerald-700">
              <label for="direct_whatsapp" class="text-xs text-slate-600 leading-snug cursor-pointer select-none">
                Juga buka obrolan WhatsApp resmi secara otomatis setelah pesan tersimpan di sistem.
              </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full inline-flex items-center justify-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
              <i class="fa-solid fa-paper-plane text-amber-400"></i>
              <span>Kirim Pesan ke Sekretariat</span>
            </button>
            <p class="text-[11px] text-slate-400 text-center">
              Pesan akan otomatis masuk ke Kotak Pesan Admin Madrasah untuk segera ditindaklanjuti.
            </p>
          </form>
        </div>

        <!-- Right Column: Interactive Maps & Petunjuk Arah (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
          
          <!-- Google Maps Embed Container -->
          <div class="bg-white p-3.5 border border-slate-200 rounded-2xl shadow-sm">
            <div class="relative w-full aspect-16/10 bg-slate-100 rounded-xl overflow-hidden border border-slate-200">
              <iframe 
                title="Peta Lokasi Kampus MA Darun Najah Sambikarto"
                src="{{ $contact?->maps_embed_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15891.127821614049!2d105.3400!3d-5.1500!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMDknMDAuMCJTIDEwNcKwMjAnMjQuMCJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid' }}" 
                class="w-full h-full border-0" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-200 mt-2 flex flex-col sm:flex-row sm:items-center justify-between text-xs gap-3">
              <div>
                <span class="font-bold text-slate-800 block">MA Darun Najah Sambikarto</span>
                <span class="text-slate-500">Sekampung, Kabupaten Lampung Timur, Lampung</span>
              </div>
              <a href="{{ $contact?->maps_link ?: 'https://maps.google.com/?q=MA+Darun+Najah+Sambikarto' }}" target="_blank" rel="noopener noreferrer" 
                 class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold rounded-lg shadow-sm transition-colors uppercase tracking-wider shrink-0">
                <span>Buka di Google Maps</span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-amber-400"></i>
              </a>
            </div>
          </div>

          <!-- Petunjuk Rute Menuju Kampus -->
          <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h4 class="font-bold text-sm text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
              <i class="fa-solid fa-signs-post text-emerald-600"></i>
              <span>Petunjuk Akses Transportasi</span>
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-slate-600">
              <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                <strong class="text-emerald-900 block font-bold mb-1">Dari Arah Kota Metro:</strong>
                Ambil rute Jalan Raya Metro – Sekampung, menuju Desa Sambikarto. Lokasi madrasah berada di kawasan Jl. Raya Bumi Agung dekat komplek pondok pesantren.
              </div>
              <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                <strong class="text-emerald-900 block font-bold mb-1">Dari Arah Sukadana / Way Jepara:</strong>
                Melalui jalur lintas Sekampung menuju Sambikarto. Akses jalan beraspal halus dan dapat dilalui kendaraan roda dua maupun roda empat/bus rombongan.
              </div>
            </div>
          </div>

        </div>

      </div>

      <!-- 3. Directory Kontak Pejabat & Panitia (Dynamic From Database) -->
      <div class="mt-16 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="max-w-2xl mb-8">
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200">
            Direktori Kontak
          </span>
          <h3 class="text-2xl font-extrabold text-slate-900 mt-3">
            Pimpinan & Layanan Divisi Madrasah
          </h3>
          <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Hubungi kontak narahubung resmi sesuai dengan kebutuhan informasi Anda.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($allContacts as $c)
            <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between hover:border-emerald-600 transition-colors">
              <div>
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg mb-3">
                  <i class="fa-solid fa-headset"></i>
                </div>
                <h4 class="font-bold text-sm text-slate-900">{{ $c->name }}</h4>
                @if($c->pic_name)
                  <p class="text-xs text-emerald-800 font-semibold mt-0.5">{{ $c->pic_name }}</p>
                @endif
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                  {{ $c->notes ?: $c->office_hours }}
                </p>
              </div>
              <div class="pt-4 mt-4 border-t border-slate-200 flex items-center justify-between">
                <a href="{{ $c->getWaLink() }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 hover:text-emerald-950 font-mono">
                  <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                  <span>{{ $c->phone ?: $c->whatsapp }}</span>
                </a>
                <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded {{ $c->is_primary ? 'bg-amber-100 text-amber-900' : 'bg-slate-200 text-slate-700' }}">
                  {{ $c->is_primary ? 'Utama' : 'Layanan' }}
                </span>
              </div>
            </div>
          @empty
            <div class="p-5 rounded-xl bg-slate-50 border border-slate-200">
              <h4 class="font-bold text-sm text-slate-900">Ketua Yayasan</h4>
              <p class="text-xs text-emerald-800 font-semibold mt-0.5">Suparno, S.Pd.I</p>
              <p class="text-xs text-slate-500 mt-2">Kebijakan kelembagaan, kemitraan sekolah, dan pengembangan yayasan.</p>
            </div>
            <div class="p-5 rounded-xl bg-slate-50 border border-slate-200">
              <h4 class="font-bold text-sm text-slate-900">Pengasuh Pesantren</h4>
              <p class="text-xs text-emerald-800 font-semibold mt-0.5">KH. Sahlan Abdulloh & KH. Abdul Ghofar, S.Pd.I</p>
              <p class="text-xs text-slate-500 mt-2">Bimbingan santri mukim, kajian kitab salaf, dan spiritual pesantren.</p>
            </div>
            <div class="p-5 rounded-xl bg-slate-50 border border-slate-200">
              <h4 class="font-bold text-sm text-slate-900">Sekretariat PPDB</h4>
              <p class="text-xs text-emerald-800 font-semibold mt-0.5">Panitia Penerimaan Santri Baru</p>
              <p class="text-xs text-slate-500 mt-2">Pendaftaran online, validasi berkas formulir, dan konfirmasi beasiswa.</p>
            </div>
          @endforelse
        </div>
      </div>

      <!-- 4. CTA Card -->
      <div class="mt-12 bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-800 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-white text-9xl pointer-events-none">
          <i class="fa-solid fa-headset"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider rounded-md mb-3 border border-amber-400/30">
              <i class="fa-solid fa-circle-question"></i>
              <span>Pusat Bantuan Cepat</span>
            </div>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
              Punya Pertanyaan yang Sering Diajukan?
            </h3>
            <p class="mt-2 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
              Kunjungi halaman Tanya Jawab (FAQ) kami untuk membaca jawaban seputar biaya pendidikan, aturan handphone santri, rutinitas asrama, dan status akreditasi madrasah.
            </p>
          </div>

          <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ route('faq') }}" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200">
              <i class="fa-solid fa-circle-question"></i>
              <span>Buka Halaman FAQ</span>
            </a>

            <a href="{{ route('ppdb') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-lg bg-emerald-900/90 hover:bg-emerald-800 text-white font-semibold text-xs uppercase tracking-wider border border-emerald-700/80 transition-all duration-200">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Daftar PPDB Online</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
