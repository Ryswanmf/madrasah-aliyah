@props(['ppdbSetting' => null])

@php
  $setting = $ppdbSetting ?? \App\Models\PpdbSetting::first();
  $isOpen = $setting ? $setting->is_open : true;
  $reqList = $setting ? $setting->requirements_list : [
    'Fotokopi Ijazah / SKL SMP/MTs (legalisir 2 lembar)',
    'Fotokopi Kartu Keluarga (KK) & KTP Orang Tua',
    'Fotokopi Akta Kelahiran calon santri',
    'Pas foto ukuran 3x4 (4 lembar, latar biru/merah)',
    'Fotokopi KIP / PKH / Piagam Prestasi (jika memiliki)'
  ];
@endphp

<!-- PPDB Section (Modern Soft Style) -->
<section id="ppdb" class="py-16 lg:py-24 bg-gradient-to-b from-white via-emerald-50/20 to-white relative border-b border-slate-200" x-data="{ currentTab: 'daftar' }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Heading -->
    <div class="max-w-3xl mb-12 text-center sm:text-left">
      <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 bg-emerald-950 text-amber-300 text-xs font-bold uppercase tracking-widest border-l-4 border-amber-400 rounded-md shadow-sm mb-4">
        <span class="w-1.5 h-1.5 bg-amber-400 rotate-45"></span>
        <span>Tahun Ajaran {{ $setting->academic_year ?? '2026/2027' }} • {{ $setting->wave_name ?? 'Gelombang 1' }}</span>
      </div>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
        Penerimaan Peserta Didik Baru (PPDB)
      </h2>
      <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
        Bergabunglah bersama keluarga besar Madrasah Aliyah Darun Najah Sambikarto. Pendaftaran mudah, transparan, dan dapat diakses secara online.
        @if(!empty($setting?->quota_info))
          <span class="inline-block font-semibold text-emerald-800 bg-emerald-100/80 px-2.5 py-0.5 rounded-md mt-1">
            <i class="fa-solid fa-users text-xs mr-1"></i> {{ $setting->quota_info }}
          </span>
        @endif
      </p>
    </div>

    <!-- Success Alert (Soft Rounded) -->
    @if(session('ppdb_success'))
      <div class="max-w-3xl mb-8 bg-emerald-50 border-l-4 border-emerald-600 border-y border-r border-emerald-200 p-6 rounded-xl shadow-md">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-emerald-700 text-white border border-emerald-800 rounded-lg flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-check"></i>
          </div>
          <div class="flex-1">
            <h3 class="text-lg font-bold text-emerald-950">Pendaftaran Berhasil Dikirim!</h3>
            <p class="text-sm text-emerald-800 mt-1">
              Data pendaftaran an. <strong>{{ session('registration')->full_name }}</strong> telah tersimpan di database madrasah.
            </p>
            <div class="bg-white p-3.5 border border-emerald-300 rounded-lg mt-3 flex items-center justify-between">
              <div>
                <span class="text-xs text-slate-500 font-medium uppercase tracking-wider block">Nomor Registrasi:</span>
                <div class="text-base font-extrabold text-emerald-800 tracking-wide font-mono">
                  {{ session('registration')->registration_number }}
                </div>
              </div>
              <span class="text-xs font-bold px-3 py-1 bg-amber-100 text-amber-900 border-l-2 border-amber-500 rounded-md uppercase tracking-wider">
                Menunggu Verifikasi
              </span>
            </div>
            <div class="mt-4 flex flex-wrap gap-2.5">
              <a href="{{ route('ppdb.print', session('registration')->registration_number) }}" target="_blank"
                 class="inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-400 text-emerald-950 font-extrabold text-xs uppercase tracking-wider px-6 py-3 rounded-lg shadow-md transition-all">
                <i class="fa-solid fa-print text-sm"></i>
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

    <!-- Status Result Alert (Soft Rounded) -->
    @if(session('status_checked'))
      <div class="max-w-3xl mb-8 bg-white border-t-4 border-emerald-700 border-x border-b border-slate-200 p-6 rounded-xl shadow-md">
        <h3 class="text-base font-bold text-slate-900 mb-3 uppercase tracking-wider border-b border-slate-200 pb-2">
          Hasil Pencarian Status Pendaftaran
        </h3>
        @if(session('status_result'))
          @php $reg = session('status_result'); @endphp
          <div class="bg-slate-50 p-4 border border-slate-200 rounded-lg space-y-2.5 text-sm">
            <div class="flex justify-between items-center pb-2 border-b border-slate-200">
              <span class="text-slate-500">No. Registrasi:</span>
              <strong class="font-mono text-emerald-800 font-bold">{{ $reg->registration_number }}</strong>
            </div>
            <div class="flex justify-between">
              <span class="text-slate-500">Nama Lengkap:</span>
              <strong class="text-slate-800">{{ $reg->full_name }}</strong>
            </div>
            <div class="flex justify-between">
              <span class="text-slate-500">Asal Sekolah:</span>
              <span>{{ $reg->school_origin }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-slate-500">Pilihan Program:</span>
              <span>{{ $reg->program_choice }}</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-slate-200">
              <span class="text-slate-500">Status:</span>
              @if($reg->status === 'accepted')
                <span class="bg-emerald-100 text-emerald-800 font-bold px-3 py-1 text-xs border-l-2 border-emerald-600 rounded-md">DITERIMA</span>
              @elseif($reg->status === 'verified')
                <span class="bg-blue-100 text-blue-800 font-bold px-3 py-1 text-xs border-l-2 border-blue-600 rounded-md">BERKAS TERVERIFIKASI</span>
              @elseif($reg->status === 'rejected')
                <span class="bg-red-100 text-red-800 font-bold px-3 py-1 text-xs border-l-2 border-red-600 rounded-md">TIDAK LOLOS</span>
              @else
                <span class="bg-amber-100 text-amber-800 font-bold px-3 py-1 text-xs border-l-2 border-amber-600 rounded-md">MENUNGGU VERIFIKASI</span>
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
          <div class="p-4 bg-red-50 text-red-700 text-sm border-l-4 border-red-600 border-y border-r border-red-200 rounded-lg">
            Data tidak ditemukan untuk pencarian "<strong>{{ session('search_query') }}</strong>". Pastikan nomor registrasi atau nomor HP sudah sesuai.
          </div>
        @endif
      </div>
    @endif

    <!-- PPDB Form & Info Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Left Column: Syarat & Alur (Soft Rounded) -->
      <div class="lg:col-span-5 space-y-6">
        
        <!-- Info Card: Alur PPDB -->
        <div class="bg-white p-6 border-t-4 border-emerald-700 border-x border-b border-slate-200 rounded-xl shadow-sm space-y-4">
          <h3 class="text-base font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2 pb-2 border-b border-slate-100">
            <i class="fa-solid fa-route text-emerald-700"></i>
            <span>Alur Pendaftaran</span>
          </h3>
          <ol class="space-y-3.5 text-xs sm:text-sm text-slate-600">
            <li class="flex items-start gap-3">
              <span class="w-6 h-6 bg-emerald-900 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 rounded-md border border-emerald-800">1</span>
              <div>
                <strong class="text-slate-800 block">{{ $setting->step_1_title ?? 'Pengisian Formulir Online' }}</strong>
                <span>{{ $setting->step_1_desc ?? 'Isi formulir online di website ini dengan data diri lengkap calon santri.' }}</span>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <span class="w-6 h-6 bg-emerald-900 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 rounded-md border border-emerald-800">2</span>
              <div>
                <strong class="text-slate-800 block">{{ $setting->step_2_title ?? 'Konfirmasi WhatsApp Panitia' }}</strong>
                <span>{{ $setting->step_2_desc ?? 'Dapatkan nomor registrasi dan konfirmasi pendaftaran melalui WhatsApp panitia.' }}</span>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <span class="w-6 h-6 bg-emerald-900 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 rounded-md border border-emerald-800">3</span>
              <div>
                <strong class="text-slate-800 block">{{ $setting->step_3_title ?? 'Verifikasi Berkas Fisik' }}</strong>
                <span>{{ $setting->step_3_desc ?? 'Verifikasi berkas fisik (Fotokopi KK, Akta, SKL/Ijazah) ke sekretariat madrasah.' }}</span>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <span class="w-6 h-6 bg-emerald-900 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 rounded-md border border-emerald-800">4</span>
              <div>
                <strong class="text-slate-800 block">{{ $setting->step_4_title ?? 'Pengumuman & Daftar Ulang' }}</strong>
                <span>{{ $setting->step_4_desc ?? 'Pengumuman hasil seleksi dan daftar ulang santri baru.' }}</span>
              </div>
            </li>
          </ol>
        </div>

        <!-- Info Card: Berkas Persyaratan -->
        <div class="bg-emerald-950 text-white p-6 border-t-4 border-amber-400 border-x border-b border-emerald-900 rounded-xl shadow-sm space-y-3">
          <h3 class="text-sm font-bold text-amber-300 uppercase tracking-wider flex items-center gap-2 pb-2 border-b border-emerald-900">
            <i class="fa-solid fa-folder-open"></i>
            <span>Berkas Persyaratan</span>
          </h3>
          <ul class="text-xs sm:text-sm text-emerald-100 space-y-2">
            @foreach($reqList as $req)
            <li class="flex items-start gap-2">
              <i class="fa-solid fa-check text-amber-400 mt-1 text-xs shrink-0"></i>
              <span>{{ $req }}</span>
            </li>
            @endforeach
          </ul>
        </div>

        <!-- Cek Status Box -->
        <div class="bg-slate-50 p-5 border-l-4 border-slate-700 border-y border-r border-slate-200 rounded-xl">
          <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1">Sudah Mendaftar?</h4>
          <p class="text-xs text-slate-600 mb-3">Cek status pendaftaran atau hasil seleksi berkas Anda:</p>
          <form action="{{ route('ppdb.status') }}" method="GET" class="flex gap-2">
            <input type="text" name="query" placeholder="No. Registrasi / No. WA" required
                   class="flex-1 bg-white border border-slate-300 text-xs sm:text-sm px-3 py-2 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-700">
            <button type="submit" class="bg-slate-900 hover:bg-black text-white text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-lg transition-colors cursor-pointer">
              Cek
            </button>
          </form>
        </div>

      </div>

      <!-- Right Column: Registration Form (Soft Rounded Card) -->
      <div class="lg:col-span-7">
        @if(!$isOpen)
        <div class="bg-white p-6 sm:p-10 border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-xl shadow-md text-center py-12 space-y-4">
          <div class="w-16 h-16 bg-amber-100 text-amber-700 border border-amber-300 rounded-2xl flex items-center justify-center text-3xl mx-auto shadow-sm">
            <i class="fa-solid fa-lock"></i>
          </div>
          <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 uppercase tracking-wide">
            Pendaftaran Online Sedang Ditutup
          </h3>
          <p class="text-sm text-slate-600 max-w-md mx-auto leading-relaxed">
            {{ $setting->closed_message ?: 'Mohon maaf, pendaftaran santri baru saat ini sedang ditutup atau kuota pendaftaran telah terpenuhi. Silakan hubungi sekretariat madrasah untuk informasi gelombang berikutnya.' }}
          </p>
          <div class="pt-4">
            <a href="{{ $setting->wa_link }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs sm:text-sm uppercase tracking-wider px-7 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all border-b-2 border-emerald-950">
              <i class="fa-brands fa-whatsapp text-lg text-emerald-300"></i>
              <span>Hubungi Sekretariat Panitia (WA)</span>
            </a>
          </div>
        </div>
        @else
        <div class="bg-white p-6 sm:p-8 border-t-4 border-amber-500 border-x border-b border-slate-200 rounded-xl shadow-md">
          <div class="border-b border-slate-100 pb-4 mb-6">
            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 uppercase tracking-wide">
              Formulir Pendaftaran Online
            </h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pastikan nomor WhatsApp yang dimasukkan aktif untuk keperluan verifikasi berkas.</p>
          </div>

          <form action="{{ route('ppdb.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
              <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Nama Lengkap Calon Santri <span class="text-red-500">*</span>
              </label>
              <input type="text" name="full_name" id="full_name" required placeholder="Contoh: Muhammad Ali Ridho"
                     value="{{ old('full_name') }}"
                     class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
              @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- NISN & Gender Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="nisn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  NISN (Nomor Induk Siswa Nasional)
                </label>
                <input type="text" name="nisn" id="nisn" placeholder="10 digit nomor NISN"
                       value="{{ old('nisn') }}"
                       class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                @error('nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label for="gender" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Jenis Kelamin <span class="text-red-500">*</span>
                </label>
                <select name="gender" id="gender" required
                        class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                  <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki (Santri Putra)</option>
                  <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan (Santri Putri)</option>
                </select>
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

            <!-- Asal Sekolah & Nama Orang Tua -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="school_origin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Asal Sekolah (SMP/MTs) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="school_origin" id="school_origin" required placeholder="Contoh: MTs Sekampung"
                       value="{{ old('school_origin') }}"
                       class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                @error('school_origin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label for="parent_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Nama Orang Tua / Wali <span class="text-red-500">*</span>
                </label>
                <input type="text" name="parent_name" id="parent_name" required placeholder="Contoh: Bapak Ahmad"
                       value="{{ old('parent_name') }}"
                       class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            </div>

            <!-- No WhatsApp & Pilihan Program -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="phone_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  No. WhatsApp Aktif <span class="text-red-500">*</span>
                </label>
                <input type="tel" name="phone_number" id="phone_number" required placeholder="08xxxxxxxxxx"
                       value="{{ old('phone_number') }}"
                       class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                @error('phone_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label for="program_choice" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Pilihan Peminatan <span class="text-red-500">*</span>
                </label>
                <select name="program_choice" id="program_choice" required
                        class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">
                  <option value="MIPA (Sains & Teknologi)">MIPA (Sains & Teknologi)</option>
                  <option value="IPS (Sosial & Humaniora)">IPS (Sosial & Humaniora)</option>
                  <option value="Keagamaan (Tafaqquh Fiddin)">Keagamaan (Tafaqquh Fiddin)</option>
                </select>
                @error('program_choice') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            </div>

            <!-- Pilihan Asrama -->
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                Pilihan Tempat Tinggal <span class="text-red-500">*</span>
              </label>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg cursor-pointer hover:border-emerald-700 hover:bg-emerald-50/50 transition-colors">
                  <input type="radio" name="dormitory_choice" value="1" checked class="text-emerald-700 focus:ring-emerald-600">
                  <div class="text-xs">
                    <strong class="block text-slate-900 font-bold">Santri Mukim (Tinggal di Asrama)</strong>
                    <span class="text-slate-500">Mengikuti program pembiasaan pesantren 24 jam</span>
                  </div>
                </label>

                <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg cursor-pointer hover:border-emerald-700 hover:bg-emerald-50/50 transition-colors">
                  <input type="radio" name="dormitory_choice" value="0" class="text-emerald-700 focus:ring-emerald-600">
                  <div class="text-xs">
                    <strong class="block text-slate-900 font-bold">Santri Non-Mukim (Reguler)</strong>
                    <span class="text-slate-500">Pulang pergi dari rumah / domisili sekitar</span>
                  </div>
                </label>
              </div>
            </div>

            <!-- Alamat Lengkap -->
            <div>
              <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Alamat Lengkap Tempat Tinggal <span class="text-red-500">*</span>
              </label>
              <textarea name="address" id="address" rows="3" required placeholder="Dusun, RT/RW, Desa, Kecamatan, Kabupaten"
                        class="w-full text-sm bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:bg-white focus:outline-none focus:border-emerald-700 transition-all">{{ old('address') }}</textarea>
              @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button (Soft Rounded) -->
            <div class="pt-2">
              <button type="submit" 
                      class="w-full inline-flex items-center justify-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs sm:text-sm uppercase tracking-wider py-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer border-b-2 border-emerald-950">
                <i class="fa-solid fa-paper-plane text-amber-400"></i>
                <span>Kirim Pendaftaran Santri Baru</span>
              </button>
              <p class="text-center text-[11px] text-slate-400 mt-2.5">
                Data Anda dilindungi dan hanya digunakan untuk keperluan penerimaan santri baru MA Darun Najah Sambikarto.
              </p>
            </div>

          </form>
        </div>
        @endif
      </div>

    </div>

  </div>
</section>
