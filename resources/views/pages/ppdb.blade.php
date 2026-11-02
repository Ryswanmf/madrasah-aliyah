@extends('layouts.app')

@section('title', 'PPDB Online 2026/2027 • Pendaftaran Santri Baru MA Darun Najah Sambikarto')

@section('content')
<!-- PPDB Dedicated Page Container -->
<div class="bg-slate-50 min-h-screen" x-data="{ currentTab: '{{ session('status_checked') ? 'status' : 'daftar' }}' }">

  <!-- Hero Header Banner (Emerald & Amber Accents) -->
  <section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white py-16 sm:py-20 lg:py-24 overflow-hidden border-b-4 border-amber-400">
    <!-- Background Texture / Overlay -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fbbf24_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Breadcrumbs -->
      <nav class="flex items-center gap-2 text-xs text-emerald-300/80 mb-6 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-300 transition-colors flex items-center gap-1.5">
          <i class="fa-solid fa-house text-[11px]"></i>
          <span>Beranda</span>
        </a>
        <i class="fa-solid fa-chevron-right text-[10px] text-emerald-400/50"></i>
        <span class="text-amber-300 font-semibold">PPDB Online</span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-8 space-y-4">
          <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-800/80 border border-emerald-600/40 text-amber-300 text-xs font-bold uppercase tracking-widest rounded-md backdrop-blur-xs">
            <span class="w-2 h-2 bg-amber-400 rotate-45"></span>
            <span>Tahun Ajaran {{ $ppdbSetting->academic_year ?? '2026/2027' }} • {{ $ppdbSetting->wave_name ?? 'Gelombang 1' }}</span>
          </div>

          <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
            Penerimaan Peserta Didik Baru <br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-amber-200 to-yellow-400">
              MA Darun Najah Sambikarto
            </span>
          </h1>

          <p class="text-emerald-100/90 text-sm sm:text-base leading-relaxed max-w-2xl">
            Mari bergabung menjadi generasi santri yang berakhlakul karimah, berwawasan ilmiah, hafal Al-Qur'an, dan siap menghadapi tantangan zaman. Pendaftaran dibuka secara online & transparan.
          </p>

          <!-- Quick Jump Buttons -->
          <div class="flex flex-wrap items-center gap-3 pt-3">
            <a href="#form-ppdb" 
               @click="currentTab = 'daftar'"
               class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-emerald-950 font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
              <i class="fa-solid fa-pen-to-square"></i>
              <span>Isi Formulir Online</span>
            </a>
            <a href="#form-ppdb" 
               @click="currentTab = 'status'"
               class="inline-flex items-center gap-2 bg-emerald-800/80 hover:bg-emerald-800 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-lg border border-emerald-600 transition-all duration-200">
              <i class="fa-solid fa-magnifying-glass"></i>
              <span>Cek Status Pendaftaran</span>
            </a>
            <a href="{{ $contact ? $contact->getWaLink('Halo Panitia PPDB MA Darun Najah Sambikarto, saya ingin bertanya tentang pendaftaran santri baru.') : 'https://wa.me/6285658973426' }}" 
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-emerald-100 font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-lg backdrop-blur-xs transition-colors">
              <i class="fa-brands fa-whatsapp text-sm text-emerald-300"></i>
              <span>Tanya Panitia (WA)</span>
            </a>
          </div>
        </div>

        <!-- Quick Summary Box -->
        <div class="lg:col-span-4">
          <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl shadow-xl text-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-white/10">
              <span class="text-emerald-200 font-medium">Status Pendaftaran</span>
              <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-500 text-white font-bold rounded-full text-[11px] animate-pulse">
                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Dibuka
              </span>
            </div>
            <div class="space-y-2">
              <div class="flex justify-between items-center text-emerald-100">
                <span>Pilihan Peminatan:</span>
                <span class="font-bold text-white">IPA & Keagamaan</span>
              </div>
              <div class="flex justify-between items-center text-emerald-100">
                <span>Pondok Pesantren:</span>
                <span class="font-bold text-amber-300">Mukim / Non-Mukim</span>
              </div>
              <div class="flex justify-between items-center text-emerald-100">
                <span>Sekretariat:</span>
                <span class="font-semibold text-white">Sekampung, Lamtim</span>
              </div>
            </div>
            <div class="pt-2 border-t border-white/10 text-[11px] text-emerald-200/90 leading-relaxed">
              *Tersedia program <strong>Beasiswa Tahfidz Al-Qur'an</strong> dan <strong>Keringanan Santri Yatim/Dhuafa</strong>.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 1. Jadwal Gelombang & Info Beasiswa -->
  <section class="py-12 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-2xl mx-auto mb-10">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
          Jadwal Gelombang Pendaftaran
        </h2>
        <p class="text-xs sm:text-sm text-slate-600 mt-2">
          Pilihlah gelombang pendaftaran yang sesuai untuk mendapatkan kuota kamar asrama terbaik.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Gelombang 1 -->
        <div class="bg-gradient-to-b from-emerald-50/50 to-white p-6 border-t-4 border-emerald-600 border-x border-b border-emerald-100 rounded-xl shadow-sm relative">
          <div class="absolute -top-3 right-6 bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-0.5 rounded-full shadow-xs">
            Rekomendasi
          </div>
          <div class="text-emerald-800 font-extrabold text-lg mb-1">Gelombang I (Prestasi & Reguler)</div>
          <div class="text-xs font-semibold text-emerald-600 mb-3 flex items-center gap-1.5">
            <i class="fa-regular fa-calendar-check"></i>
            <span>01 Januari – 31 Maret 2026</span>
          </div>
          <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-emerald-100">
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-[11px]"></i>
              <span>Prioritas pemilihan kamar asrama santri</span>
            </li>
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-[11px]"></i>
              <span>Kesempatan seleksi <strong>Beasiswa Tahfidz</strong></span>
            </li>
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-[11px]"></i>
              <span>Bebas biaya pendaftaran awal</span>
            </li>
          </ul>
        </div>

        <!-- Gelombang 2 -->
        <div class="bg-white p-6 border-t-4 border-slate-600 border-x border-b border-slate-200 rounded-xl shadow-sm">
          <div class="text-slate-800 font-extrabold text-lg mb-1">Gelombang II (Reguler)</div>
          <div class="text-xs font-semibold text-slate-500 mb-3 flex items-center gap-1.5">
            <i class="fa-regular fa-calendar-check"></i>
            <span>01 April – 10 Juli 2026</span>
          </div>
          <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-100">
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-slate-500 mt-0.5 text-[11px]"></i>
              <span>Pendaftaran reguler peminatan IPA & Keagamaan</span>
            </li>
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-slate-500 mt-0.5 text-[11px]"></i>
              <span>Penempatan asrama sesuai kuota tersisa</span>
            </li>
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-slate-500 mt-0.5 text-[11px]"></i>
              <span>Tes pemetaan dasar Al-Qur'an & wawancara</span>
            </li>
          </ul>
        </div>

        <!-- Jalur Khusus Beasiswa -->
        <div class="bg-emerald-950 text-white p-6 border-t-4 border-amber-400 border-x border-b border-emerald-900 rounded-xl shadow-sm">
          <div class="text-amber-300 font-extrabold text-lg mb-1">Jalur Beasiswa Khusus</div>
          <div class="text-xs font-semibold text-emerald-200 mb-3 flex items-center gap-1.5">
            <i class="fa-solid fa-award"></i>
            <span>Dibuka Sepanjang Gelombang I</span>
          </div>
          <ul class="text-xs text-emerald-100 space-y-2 pt-2 border-t border-emerald-900">
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-star text-amber-400 mt-0.5 text-[11px]"></i>
              <span><strong>Beasiswa Tahfidz:</strong> Bebas SPP bagi hafidz 3+ Juz</span>
            </li>
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-star text-amber-400 mt-0.5 text-[11px]"></i>
              <span><strong>Beasiswa Prestasi:</strong> Juara MTQ, OSN/KSM, & Porseni</span>
            </li>
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-star text-amber-400 mt-0.5 text-[11px]"></i>
              <span><strong>Santri Yatim:</strong> Bantuan pendidikan khusus</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. Alur Pendaftaran & Berkas Persyaratan -->
  <section class="py-14 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Alur 4 Langkah (7 cols) -->
        <div class="lg:col-span-7 bg-white p-6 sm:p-8 border border-slate-200 rounded-2xl shadow-sm space-y-6">
          <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider block mb-1">Panduan Calon Santri</span>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">4 Langkah Alur Pendaftaran</h2>
          </div>

          <div class="space-y-6">
            <!-- Step 1 -->
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-emerald-900 text-amber-300 font-extrabold flex items-center justify-center shrink-0 text-base shadow-sm border border-emerald-800">
                1
              </div>
              <div class="flex-1">
                <h3 class="text-sm sm:text-base font-bold text-slate-900">Pendaftaran Online</h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                  Isi formulir online di halaman ini dengan data santri yang valid (Nama, NISN, Asal Sekolah, Data Wali, dan Pilihan Program).
                </p>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-emerald-900 text-amber-300 font-extrabold flex items-center justify-center shrink-0 text-base shadow-sm border border-emerald-800">
                2
              </div>
              <div class="flex-1">
                <h3 class="text-sm sm:text-base font-bold text-slate-900">Simpan No. Registrasi & Konfirmasi WA</h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                  Setelah mengirim data, catat <strong>Nomor Registrasi</strong> yang tertera, lalu klik tombol WhatsApp untuk konfirmasi otomatis ke panitia PPDB.
                </p>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-emerald-900 text-amber-300 font-extrabold flex items-center justify-center shrink-0 text-base shadow-sm border border-emerald-800">
                3
              </div>
              <div class="flex-1">
                <h3 class="text-sm sm:text-base font-bold text-slate-900">Verifikasi Berkas & Observasi</h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                  Wali santri menyerahkan berkas fisik ke sekretariat madrasah atau via pos, disertai tes ringan observasi baca Al-Qur'an bagi calon santri.
                </p>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl bg-amber-400 text-emerald-950 font-extrabold flex items-center justify-center shrink-0 text-base shadow-sm border border-amber-500">
                4
              </div>
              <div class="flex-1">
                <h3 class="text-sm sm:text-base font-bold text-slate-900">Pengumuman & Daftar Ulang</h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                  Cek status kelulusan secara online pada fitur Cek Status. Santri yang dinyatakan diterima dapat melakukan daftar ulang dan pengukuran seragam.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Berkas & Dokumen (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
          <div class="bg-emerald-950 text-white p-6 sm:p-7 border-t-4 border-amber-400 border-x border-b border-emerald-900 rounded-2xl shadow-sm space-y-4">
            <h2 class="text-base sm:text-lg font-bold text-amber-300 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-emerald-900">
              <i class="fa-solid fa-folder-open"></i>
              <span>Berkas Persyaratan</span>
            </h2>
            <ul class="text-xs sm:text-sm text-emerald-100 space-y-3">
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-amber-400 mt-0.5 text-xs shrink-0"></i>
                <span>Fotokopi Ijazah / Surat Keterangan Lulus (SKL) SMP/MTs (2 lembar legalisir)</span>
              </li>
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-amber-400 mt-0.5 text-xs shrink-0"></i>
                <span>Fotokopi Kartu Keluarga (KK) & KTP kedua orang tua/wali</span>
              </li>
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-amber-400 mt-0.5 text-xs shrink-0"></i>
                <span>Fotokopi Akta Kelahiran calon santri</span>
              </li>
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-amber-400 mt-0.5 text-xs shrink-0"></i>
                <span>Pas foto resmi ukuran 3x4 (4 lembar, berkerudung bagi putri)</span>
              </li>
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-amber-400 mt-0.5 text-xs shrink-0"></i>
                <span>Fotokopi Kartu Indonesia Pintar (KIP/PKH) <em>*jika memiliki</em></span>
              </li>
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-circle-check text-amber-400 mt-0.5 text-xs shrink-0"></i>
                <span>Sertifikat/Piagam Prestasi atau Syahadah Tahfidz <em>*khusus jalur beasiswa</em></span>
              </li>
            </ul>
          </div>

          <!-- Sekretariat Info Card -->
          <div class="bg-white p-5 border border-slate-200 rounded-2xl shadow-xs text-xs text-slate-600 space-y-2">
            <div class="font-bold text-slate-800 text-sm flex items-center gap-2">
              <i class="fa-solid fa-school text-emerald-700"></i>
              <span>Sekretariat Panitia PPDB</span>
            </div>
            <p>Gedung Kantor MA Darun Najah Sambikarto, Sekampung, Lampung Timur.</p>
            <p class="text-slate-500"><strong>Jam Layanan:</strong> Setiap Hari (08.00 - 15.00 WIB)</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 3. Form Pendaftaran & Cek Status Section -->
  <section id="form-ppdb" class="py-16 lg:py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Tab Selector (Modern Pill Style) -->
      <div class="flex justify-center mb-8">
        <div class="inline-flex bg-slate-100 p-1.5 rounded-xl border border-slate-200 shadow-inner">
          <button @click="currentTab = 'daftar'" 
                  :class="currentTab === 'daftar' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                  class="px-5 sm:px-8 py-2.5 rounded-lg text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-200 cursor-pointer flex items-center gap-2">
            <i class="fa-solid fa-user-plus"></i>
            <span>Formulir Pendaftaran</span>
          </button>
          <button @click="currentTab = 'status'" 
                  :class="currentTab === 'status' ? 'bg-emerald-800 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                  class="px-5 sm:px-8 py-2.5 rounded-lg text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-200 cursor-pointer flex items-center gap-2">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Cek Status Online</span>
          </button>
        </div>
      </div>

      <!-- Success Alert -->
      @if(session('ppdb_success'))
        <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-600 border-y border-r border-emerald-200 p-6 sm:p-7 rounded-2xl shadow-md">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-emerald-700 text-white border border-emerald-800 rounded-xl flex items-center justify-center text-xl shrink-0">
              <i class="fa-solid fa-check"></i>
            </div>
            <div class="flex-1">
              <h3 class="text-lg font-bold text-emerald-950">Alhamdulillah, Pendaftaran Berhasil Dikirim!</h3>
              <p class="text-xs sm:text-sm text-emerald-800 mt-1">
                Data calon santri an. <strong>{{ session('registration')->full_name }}</strong> telah tersimpan di sistem PPDB MA Darun Najah Sambikarto.
              </p>
              
              <div class="bg-white p-4 border border-emerald-300 rounded-xl mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                  <span class="text-[11px] text-slate-500 font-bold uppercase tracking-wider block">Nomor Registrasi Anda:</span>
                  <div class="text-xl font-extrabold text-emerald-800 tracking-wide font-mono mt-0.5">
                    {{ session('registration')->registration_number }}
                  </div>
                </div>
                <div>
                  <span class="text-xs font-bold px-3 py-1 bg-amber-100 text-amber-900 border-l-2 border-amber-500 rounded-md uppercase tracking-wider">
                    Menunggu Verifikasi
                  </span>
                </div>
              </div>

              <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('ppdb.print', session('registration')->registration_number) }}" target="_blank"
                   class="inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-400 text-emerald-950 font-extrabold text-xs uppercase tracking-wider px-6 py-3 rounded-lg shadow-md transition-all">
                  <i class="fa-solid fa-print"></i>
                  <span>Cetak Kartu Bukti Pendaftaran (A4)</span>
                </a>
                <a href="{{ session('wa_link') }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-lg shadow-md transition-colors">
                  <i class="fa-brands fa-whatsapp text-base"></i>
                  <span>Konfirmasi ke WhatsApp Panitia</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endif

      <!-- Status Check Alert -->
      @if(session('status_checked'))
        <div class="mb-8 bg-white border-t-4 border-emerald-700 border-x border-b border-slate-200 p-6 sm:p-7 rounded-2xl shadow-md">
          <h3 class="text-base font-bold text-slate-900 mb-4 uppercase tracking-wider border-b border-slate-200 pb-2 flex items-center justify-between">
            <span>Hasil Pencarian Status Pendaftaran</span>
            <span class="text-xs font-mono text-slate-500 normal-case">Query: {{ session('search_query') }}</span>
          </h3>

          @if(session('status_result'))
            @php $reg = session('status_result'); @endphp
            <div class="bg-slate-50 p-5 border border-slate-200 rounded-xl space-y-3 text-sm">
              <div class="flex justify-between items-center pb-2.5 border-b border-slate-200">
                <span class="text-slate-500 text-xs uppercase font-semibold">No. Registrasi:</span>
                <strong class="font-mono text-emerald-800 text-base font-extrabold">{{ $reg->registration_number }}</strong>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-500">Nama Santri:</span>
                <strong class="text-slate-800">{{ $reg->full_name }}</strong>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-500">Asal Sekolah:</span>
                <span>{{ $reg->school_origin }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-500">Pilihan Peminatan:</span>
                <span class="font-medium text-slate-800">{{ $reg->program_choice }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-500">Status Asrama:</span>
                <span>{{ $reg->dormitory_choice ? 'Santri Mukim (Pondok)' : 'Santri Non-Mukim (Reguler)' }}</span>
              </div>
              <div class="flex justify-between items-center pt-3 border-t border-slate-200">
                <span class="text-slate-500 font-semibold">Status Pendaftaran:</span>
                @if($reg->status === 'accepted')
                  <span class="bg-emerald-100 text-emerald-800 font-bold px-3 py-1.5 text-xs border-l-2 border-emerald-600 rounded-md">
                    <i class="fa-solid fa-check-circle mr-1"></i> DITERIMA
                  </span>
                @elseif($reg->status === 'verified')
                  <span class="bg-blue-100 text-blue-800 font-bold px-3 py-1.5 text-xs border-l-2 border-blue-600 rounded-md">
                    <i class="fa-solid fa-file-circle-check mr-1"></i> BERKAS TERVERIFIKASI
                  </span>
                @elseif($reg->status === 'rejected')
                  <span class="bg-red-100 text-red-800 font-bold px-3 py-1.5 text-xs border-l-2 border-red-600 rounded-md">
                    <i class="fa-solid fa-circle-xmark mr-1"></i> BELUM LOLOS
                  </span>
                @else
                  <span class="bg-amber-100 text-amber-800 font-bold px-3 py-1.5 text-xs border-l-2 border-amber-600 rounded-md">
                    <i class="fa-solid fa-clock mr-1"></i> MENUNGGU VERIFIKASI
                  </span>
                @endif
              </div>

              <div class="pt-3 border-t border-slate-200 flex justify-end">
                <a href="{{ route('ppdb.print', $reg->registration_number) }}" target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-emerald-950 font-bold text-xs uppercase tracking-wider rounded-lg shadow-sm transition-all">
                  <i class="fa-solid fa-print"></i>
                  <span>Cetak Kartu Bukti Pendaftaran (A4)</span>
                </a>
              </div>
            </div>
          @else
            <div class="p-4 bg-red-50 text-red-700 text-xs sm:text-sm border-l-4 border-red-600 border-y border-r border-red-200 rounded-xl">
              Data tidak ditemukan untuk pencarian "<strong>{{ session('search_query') }}</strong>". Pastikan nomor registrasi (contoh: <code>PPDB-2026-0001</code>) atau nomor HP/WhatsApp sudah benar.
            </div>
          @endif
        </div>
      @endif

      <!-- Tab 1: Form Pendaftaran -->
      <div x-show="currentTab === 'daftar'" x-transition>
        @if(!($ppdbSetting->is_open ?? true))
        <div class="bg-white p-6 sm:p-12 border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-2xl shadow-lg text-center py-16 space-y-4">
          <div class="w-16 h-16 bg-amber-100 text-amber-700 border border-amber-300 rounded-2xl flex items-center justify-center text-3xl mx-auto shadow-sm">
            <i class="fa-solid fa-lock"></i>
          </div>
          <h2 class="text-2xl font-extrabold text-slate-900 uppercase tracking-wide">
            Pendaftaran Online Sedang Ditutup
          </h2>
          <p class="text-sm text-slate-600 max-w-lg mx-auto leading-relaxed">
            {{ $ppdbSetting->closed_message ?: 'Mohon maaf, pendaftaran santri baru saat ini sedang ditutup atau kuota pendaftaran telah terpenuhi. Silakan hubungi sekretariat madrasah untuk informasi gelombang berikutnya.' }}
          </p>
          <div class="pt-4">
            <a href="{{ $ppdbSetting ? $ppdbSetting->wa_link : ($contact ? $contact->getWaLink() : 'https://wa.me/6285658973426') }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs sm:text-sm uppercase tracking-wider px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all border-b-2 border-emerald-950">
              <i class="fa-brands fa-whatsapp text-lg text-emerald-300"></i>
              <span>Hubungi Sekretariat Panitia (WhatsApp)</span>
            </a>
          </div>
        </div>
        @else
        <div class="bg-white p-6 sm:p-10 border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-2xl shadow-lg">
          <div class="border-b border-slate-100 pb-5 mb-8">
            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
              Formulir Pendaftaran Santri Baru Online
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
              Silakan lengkapi biodata calon santri di bawah ini dengan data yang benar dan nomor WhatsApp aktif.
            </p>
          </div>

          <form action="{{ route('ppdb.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Data Santri -->
            <div>
              <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-user-graduate"></i>
                <span>A. Biodata Calon Santri</span>
              </h3>

              <div class="space-y-4">
                <!-- Nama Lengkap -->
                <div>
                  <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Nama Lengkap Calon Santri <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="full_name" id="full_name" required placeholder="Sesuai Akta Kelahiran / Ijazah"
                         value="{{ old('full_name') }}"
                         class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                  @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- NISN & Gender Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label for="nisn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                      NISN (10 Digit) <span class="text-slate-400 font-normal lowercase">(opsional)</span>
                    </label>
                    <input type="text" name="nisn" id="nisn" placeholder="Nomor Induk Siswa Nasional"
                           value="{{ old('nisn') }}" maxlength="20"
                           class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all font-mono">
                    @error('nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                      Jenis Kelamin <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-4 pt-1">
                      <label class="flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-slate-700">
                        <input type="radio" name="gender" value="L" {{ old('gender', 'L') === 'L' ? 'checked' : '' }}
                               class="text-emerald-700 focus:ring-emerald-700">
                        <span>Laki-laki (Santri Putra)</span>
                      </label>
                      <label class="flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-slate-700">
                        <input type="radio" name="gender" value="P" {{ old('gender') === 'P' ? 'checked' : '' }}
                               class="text-emerald-700 focus:ring-emerald-700">
                        <span>Perempuan (Santri Putri)</span>
                      </label>
                    </div>
                    @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                  </div>
                </div>

                <!-- Tempat & Tanggal Lahir -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label for="birth_place" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                      Tempat Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="birth_place" id="birth_place" required placeholder="Contoh: Lampung Timur"
                           value="{{ old('birth_place') }}"
                           class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                    @error('birth_place') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div>
                    <label for="birth_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                      Tanggal Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="birth_date" id="birth_date" required
                           value="{{ old('birth_date') }}"
                           class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                    @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                  </div>
                </div>

                <!-- Asal Sekolah -->
                <div>
                  <label for="school_origin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Asal Sekolah (SMP / MTs) <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="school_origin" id="school_origin" required placeholder="Contoh: MTs Darun Najah / SMPN 1 Sekampung"
                         value="{{ old('school_origin') }}"
                         class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                  @error('school_origin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
              </div>
            </div>

            <!-- Section 2: Data Orang Tua / Wali -->
            <div class="pt-4">
              <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-users"></i>
                <span>B. Data Orang Tua / Wali & Alamat</span>
              </h3>

              <div class="space-y-4">
                <!-- Nama Orang Tua / Wali -->
                <div>
                  <label for="parent_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Nama Orang Tua / Wali <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="parent_name" id="parent_name" required placeholder="Nama Ayah / Ibu / Wali Santri"
                         value="{{ old('parent_name') }}"
                         class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                  @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- No WhatsApp -->
                <div>
                  <label for="phone_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    No. WhatsApp Aktif (Wali / Calon Santri) <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="phone_number" id="phone_number" required placeholder="Contoh: 081234567890"
                         value="{{ old('phone_number') }}"
                         class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all font-mono">
                  <p class="text-[11px] text-slate-500 mt-1">Nomor ini akan digunakan panitia untuk konfirmasi berkas dan jadwal tes.</p>
                  @error('phone_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat Domisili -->
                <div>
                  <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Alamat Lengkap Domisili <span class="text-red-500">*</span>
                  </label>
                  <textarea name="address" id="address" rows="3" required placeholder="Dusun, RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten"
                            class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">{{ old('address') }}</textarea>
                  @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
              </div>
            </div>

            <!-- Section 3: Pilihan Jurusan & Asrama -->
            <div class="pt-4">
              <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-shapes"></i>
                <span>C. Peminatan & Status Asrama</span>
              </h3>

              <div class="space-y-4">
                <!-- Program Choice -->
                <div>
                  <label for="program_choice" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Pilihan Peminatan Akademik <span class="text-red-500">*</span>
                  </label>
                  <select name="program_choice" id="program_choice" required
                          class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                    <option value="Peminatan IPA Terpadu" {{ old('program_choice') === 'Peminatan IPA Terpadu' ? 'selected' : '' }}>
                      Peminatan IPA Terpadu (Sains, Teknologi & Kedokteran)
                    </option>
                    <option value="Peminatan Keagamaan (Agama Islam)" {{ old('program_choice') === 'Peminatan Keagamaan (Agama Islam)' ? 'selected' : '' }}>
                      Peminatan Keagamaan (Kajian Kitab Kuning, Dirasah Islamiyah & Bahasa Arab)
                    </option>
                  </select>
                  @error('program_choice') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Dormitory Choice -->
                <div>
                  <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Pilihan Tempat Tinggal Santri <span class="text-red-500">*</span>
                  </label>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                    <label class="flex items-start gap-3 p-3.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-emerald-50/50 has-checked:border-emerald-700 has-checked:bg-emerald-50/50 transition-colors">
                      <input type="radio" name="dormitory_choice" value="1" {{ old('dormitory_choice', '1') == '1' ? 'checked' : '' }}
                             class="mt-1 text-emerald-700 focus:ring-emerald-700">
                      <div>
                        <div class="font-bold text-slate-800 text-xs sm:text-sm">Santri Mukim (Mondok)</div>
                        <div class="text-[11px] text-slate-500">Tinggal di Asrama Pondok Pesantren Darun Najah</div>
                      </div>
                    </label>

                    <label class="flex items-start gap-3 p-3.5 border border-slate-200 rounded-xl cursor-pointer hover:bg-emerald-50/50 has-checked:border-emerald-700 has-checked:bg-emerald-50/50 transition-colors">
                      <input type="radio" name="dormitory_choice" value="0" {{ old('dormitory_choice') == '0' ? 'checked' : '' }}
                             class="mt-1 text-emerald-700 focus:ring-emerald-700">
                      <div>
                        <div class="font-bold text-slate-800 text-xs sm:text-sm">Santri Non-Mukim (Reguler)</div>
                        <div class="text-[11px] text-slate-500">Pulang-pergi dari rumah wali santri</div>
                      </div>
                    </label>
                  </div>
                  @error('dormitory_choice') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-slate-200">
              <button type="submit"
                      class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-sm uppercase tracking-wider py-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer border-b-4 border-emerald-950">
                <i class="fa-solid fa-paper-plane text-amber-400"></i>
                <span>Kirim Formulir Pendaftaran Sekarang</span>
              </button>
              <p class="text-center text-[11px] text-slate-400 mt-3">
                Dengan menekan tombol kirim, Anda menyetujui data yang diisi adalah benar untuk verifikasi madrasah.
              </p>
            </div>

          </form>
        </div>
        @endif
      </div>

      <!-- Tab 2: Cek Status Pendaftaran -->
      <div x-show="currentTab === 'status'" x-transition>
        <div class="bg-white p-6 sm:p-10 border-t-4 border-emerald-700 border-x border-b border-slate-200 rounded-2xl shadow-lg">
          <div class="border-b border-slate-100 pb-5 mb-8">
            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
              Pencarian Status Pendaftaran Santri Baru
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
              Masukkan Nomor Registrasi (contoh: <code>PPDB-2026-0001</code>) atau Nomor WhatsApp yang didaftarkan saat pengisian formulir.
            </p>
          </div>

          <form action="{{ route('ppdb.status') }}" method="GET" class="space-y-5">
            <div>
              <label for="query" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                Nomor Registrasi atau Nomor WhatsApp <span class="text-red-500">*</span>
              </label>
              <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="query" id="query" required
                       placeholder="Contoh: PPDB-2026-0001 atau 081234567890"
                       value="{{ request('query', session('search_query')) }}"
                       class="flex-1 text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-3 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all font-mono">
                <button type="submit"
                        class="bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider px-8 py-3 rounded-lg shadow-md transition-colors cursor-pointer flex items-center justify-center gap-2">
                  <i class="fa-solid fa-magnifying-glass text-amber-400"></i>
                  <span>Cek Status</span>
                </button>
              </div>
            </div>
          </form>

          <!-- Tips Bantuan -->
          <div class="mt-8 pt-6 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-slate-600">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
              <strong class="text-slate-800 block mb-1">Lupa Nomor Registrasi?</strong>
              <p>Nomor registrasi telah dikirimkan saat pertama kali Anda mengisi formulir online dan tercatat di chat WhatsApp panitia.</p>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
              <strong class="text-slate-800 block mb-1">Butuh Bantuan Langsung?</strong>
              <p>Hubungi sekretariat melalui WhatsApp di <strong>{{ $contact->phone ?? '0856-5897-3426' }}</strong> dengan menyertakan nama santri dan asal sekolah.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection
