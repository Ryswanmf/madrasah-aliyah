<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Bukti Pendaftaran PPDB - {{ $registration->registration_number }} - {{ $registration->full_name }}</title>
  
  <link rel="icon" type="image/png" href="{{ !empty($siteSetting?->site_favicon) ? $siteSetting->site_favicon_url : asset('assets/images/favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      background-color: #f1f5f9;
      color: #0f172a;
      line-height: 1.4;
      font-size: 13px;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    /* Print Controls Bar */
    .no-print-bar {
      position: sticky;
      top: 0;
      z-index: 100;
      background: #022c22;
      color: #ffffff;
      padding: 12px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .no-print-bar .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 18px;
      font-size: 13px;
      font-weight: 700;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s;
    }
    .btn-print {
      background: #f59e0b;
      color: #022c22;
      border: 1px solid #d97706;
    }
    .btn-print:hover {
      background: #fbbf24;
    }
    .btn-back {
      background: rgba(255,255,255,0.1);
      color: #ffffff;
      border: 1px solid rgba(255,255,255,0.2);
    }
    .btn-back:hover {
      background: rgba(255,255,255,0.2);
    }

    /* A4 Document Container */
    .document-page {
      width: 210mm;
      min-height: 297mm;
      margin: 20px auto;
      background: #ffffff;
      padding: 18mm 20mm;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
      position: relative;
    }

    /* Official Kop Surat */
    .kop-header {
      display: flex;
      align-items: center;
      gap: 16px;
      padding-bottom: 12px;
      border-bottom: 3px double #064e3b;
      margin-bottom: 16px;
    }
    .kop-logo {
      width: 72px;
      height: 72px;
      object-fit: contain;
    }
    .kop-text {
      flex: 1;
      text-align: center;
    }
    .kop-text .foundation {
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: #064e3b;
    }
    .kop-text .institution {
      font-size: 19px;
      font-weight: 800;
      text-transform: uppercase;
      color: #0f172a;
      line-height: 1.2;
      margin: 2px 0;
    }
    .kop-text .accreditation {
      font-size: 11px;
      font-weight: 700;
      color: #b45309;
      letter-spacing: 0.5px;
    }
    .kop-text .address {
      font-size: 10.5px;
      color: #475569;
      margin-top: 2px;
    }

    /* Document Title */
    .doc-title-box {
      text-align: center;
      margin-bottom: 16px;
    }
    .doc-title {
      display: inline-block;
      font-size: 15px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #064e3b;
      padding: 4px 20px;
      border-bottom: 2px solid #f59e0b;
    }
    .doc-subtitle {
      font-size: 11px;
      color: #64748b;
      margin-top: 3px;
      font-weight: 600;
    }

    /* Registration Badge Bar */
    .reg-badge-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #f8fafc;
      border: 1px solid #cbd5e1;
      border-left: 4px solid #064e3b;
      padding: 10px 16px;
      border-radius: 8px;
      margin-bottom: 16px;
    }
    .reg-number-wrap .label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-weight: 700;
      color: #64748b;
    }
    .reg-number-wrap .value {
      font-family: 'JetBrains Mono', monospace;
      font-size: 17px;
      font-weight: 700;
      color: #064e3b;
      letter-spacing: 1px;
    }
    .reg-status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .status-pending {
      background: #fef3c7;
      color: #92400e;
      border: 1px solid #fde68a;
    }
    .status-accepted {
      background: #dcfce7;
      color: #166534;
      border: 1px solid #bbf7d0;
    }

    /* Content Layout */
    .content-grid {
      display: flex;
      gap: 20px;
      margin-bottom: 16px;
    }
    .data-table-wrap {
      flex: 1;
    }
    .photo-box-wrap {
      width: 120px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
    }
    .photo-box {
      width: 30mm;
      height: 40mm;
      border: 2px dashed #94a3b8;
      background: #f8fafc;
      border-radius: 6px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #94a3b8;
      font-size: 11px;
      text-align: center;
      padding: 8px;
    }
    .photo-box i {
      font-size: 24px;
      margin-bottom: 4px;
    }

    /* Data Table */
    table.data-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
    }
    table.data-table th, 
    table.data-table td {
      padding: 6px 8px;
      vertical-align: top;
      border-bottom: 1px solid #e2e8f0;
    }
    table.data-table td.label-col {
      width: 32%;
      font-weight: 600;
      color: #475569;
    }
    table.data-table td.sep-col {
      width: 3%;
      text-align: center;
      font-weight: bold;
      color: #64748b;
    }
    table.data-table td.val-col {
      width: 65%;
      font-weight: 700;
      color: #0f172a;
    }

    /* Section Subheaders */
    .section-title {
      font-size: 12px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #064e3b;
      background: #f0fdf4;
      padding: 5px 10px;
      border-left: 3px solid #064e3b;
      margin-bottom: 8px;
      margin-top: 10px;
    }

    /* Requirements & Info Box */
    .info-box {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 10px 14px;
      margin-bottom: 16px;
      font-size: 11px;
      line-height: 1.5;
    }
    .info-box h4 {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      color: #0f172a;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .info-box ul {
      padding-left: 16px;
      color: #334155;
    }

    /* Signature Section */
    .signature-grid {
      display: flex;
      justify-content: space-between;
      margin-top: 24px;
      page-break-inside: avoid;
    }
    .sig-col {
      width: 45%;
      text-align: center;
      font-size: 11.5px;
    }
    .sig-space {
      height: 60px;
    }
    .sig-name {
      font-weight: 700;
      text-decoration: underline;
      color: #0f172a;
    }
    .sig-role {
      font-size: 10.5px;
      color: #64748b;
      margin-top: 2px;
    }

    /* Responsive Screen Styles (Mobile & Tablet Screen Preview) */
    @media screen and (max-width: 768px) {
      body {
        background-color: #e2e8f0;
      }
      .no-print-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
        padding: 12px 16px;
      }
      .no-print-bar > div:last-child {
        display: flex;
        gap: 8px;
        width: 100%;
      }
      .no-print-bar .btn {
        flex: 1;
        justify-content: center;
        padding: 10px 12px;
      }
      .document-page {
        width: calc(100% - 20px);
        max-width: 100%;
        min-height: auto;
        margin: 12px auto 24px;
        padding: 16px 12px;
        border-radius: 8px;
      }
      .kop-header {
        gap: 10px;
        padding-bottom: 8px;
      }
      .kop-logo {
        width: 52px;
        height: 52px;
      }
      .kop-text .foundation {
        font-size: 11px;
      }
      .kop-text .institution {
        font-size: 14px;
      }
      .kop-text .accreditation {
        font-size: 9.5px;
      }
      .kop-text .address {
        font-size: 9px;
        line-height: 1.3;
      }
      .reg-badge-bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 10px 12px;
      }
      .content-grid {
        flex-direction: column-reverse;
        align-items: center;
        gap: 14px;
      }
      .data-table-wrap {
        width: 100%;
      }
      table.data-table td.label-col {
        width: 38%;
        font-size: 11.5px;
      }
      table.data-table td.val-col {
        width: 59%;
        font-size: 11.5px;
        word-break: break-word;
      }
      .signature-grid {
        flex-direction: column;
        gap: 20px;
        align-items: center;
      }
      .sig-col {
        width: 100%;
        max-width: 260px;
      }
      .sig-space {
        height: 48px;
      }
    }

    /* Print Media Queries */
    @media print {
      body {
        background: #ffffff;
      }
      .no-print-bar {
        display: none !important;
      }
      .document-page {
        margin: 0;
        padding: 12mm 15mm;
        box-shadow: none;
        width: 100%;
        min-height: auto;
      }
      @page {
        size: A4;
        margin: 8mm;
      }
    }
  </style>
</head>
<body>

  <!-- Non-Print Floating Toolbar -->
  <div class="no-print-bar">
    <div>
      <span style="font-weight: 700; font-size: 14px;">🖨️ Cetak Kartu Bukti Pendaftaran PPDB</span>
      <span style="opacity: 0.8; font-size: 12px; margin-left: 8px;">(Format Resmi A4)</span>
    </div>
    <div style="display: flex; gap: 10px;">
      <a href="{{ route('home') }}" class="btn btn-back">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Website</span>
      </a>
      <button onclick="window.print()" class="btn btn-print">
        <i class="fa-solid fa-print"></i>
        <span>Cetak / Simpan PDF</span>
      </button>
    </div>
  </div>

  <!-- A4 Printable Page -->
  <div class="document-page">
    
    <!-- 1. Kop Surat Resmi -->
    <div class="kop-header">
      <img src="{{ !empty($siteSetting?->site_logo) ? $siteSetting->site_logo_url : (function_exists('webp_asset') ? webp_asset('assets/images/logo.png') : asset('assets/images/logo.png')) }}" 
           alt="Logo Madrasah Aliyah Darun Najah" 
           class="kop-logo">
      <div class="kop-text">
        <div class="foundation">Yayasan Darun Najah Sambikarto</div>
        <h1 class="institution">Madrasah Aliyah Darun Najah</h1>
        <div class="accreditation">TERAKREDITASI BAN-SM • KEMENTERIAN AGAMA REPUBLIK INDONESIA</div>
        <div class="address">
          Jl. Raya Bumi Agung, Desa Sambikarto, Kec. Sekampung, Kab. Lampung Timur, Kode Pos 34182<br>
          Website: madarunnajah.sch.id • WhatsApp Panitia: {{ $ppdbSetting->contact_phone ?: ($contact->phone ?? '0856-5897-3426') }}
        </div>
      </div>
    </div>

    <!-- 2. Judul Dokumen -->
    <div class="doc-title-box">
      <div class="doc-title">KARTU BUKTI PENDAFTARAN SISWA/I BARU</div>
      <div class="doc-subtitle">Penerimaan Peserta Didik Baru (PPDB Online) Tahun Ajaran {{ $ppdbSetting->academic_year ?? '2026/2027' }}</div>
    </div>

    <!-- 3. Nomor Registrasi & Status -->
    <div class="reg-badge-bar">
      <div class="reg-number-wrap">
        <div class="label">Nomor Registrasi Siswa/i</div>
        <div class="value">{{ $registration->registration_number }}</div>
      </div>
      <div>
        @php
          $statusClass = match($registration->status) {
            'accepted' => 'status-accepted',
            default => 'status-pending',
          };
          $statusText = match($registration->status) {
            'accepted' => 'Diterima sebagai Siswa',
            'verified' => 'Berkas Terverifikasi',
            'rejected' => 'Tidak Lolos',
            default => 'Menunggu Verifikasi Berkas',
          };
        @endphp
        <span class="reg-status-badge {{ $statusClass }}">
          <i class="fa-solid fa-circle-check"></i>
          <span>{{ $statusText }}</span>
        </span>
      </div>
    </div>

    <!-- 4. Data Diri Calon Siswa & Foto Placeholder -->
    <div class="content-grid">
      <div class="data-table-wrap">
        <div class="section-title">A. Data Calon Siswa</div>
        <table class="data-table">
          <tr>
            <td class="label-col">Nama Lengkap Siswa</td>
            <td class="sep-col">:</td>
            <td class="val-col" style="font-size: 13px; text-transform: uppercase;">{{ $registration->full_name }}</td>
          </tr>
          <tr>
            <td class="label-col">NISN Siswa</td>
            <td class="sep-col">:</td>
            <td class="val-col" style="font-family: 'JetBrains Mono', monospace;">{{ $registration->nisn ?: '-' }}</td>
          </tr>
          <tr>
            <td class="label-col">Jenis Kelamin</td>
            <td class="sep-col">:</td>
            <td class="val-col">{{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
          </tr>
          <tr>
            <td class="label-col">Tempat, Tanggal Lahir</td>
            <td class="sep-col">:</td>
            <td class="val-col">{{ $registration->birth_place }}, {{ $registration->birth_date ? date('d F Y', strtotime($registration->birth_date)) : '-' }}</td>
          </tr>
          <tr>
            <td class="label-col">Asal Sekolah (SMP/MTs)</td>
            <td class="sep-col">:</td>
            <td class="val-col">{{ $registration->school_origin }}</td>
          </tr>
          <tr>
            <td class="label-col">Pilihan Program Studi</td>
            <td class="sep-col">:</td>
            <td class="val-col" style="color: #064e3b;">{{ $registration->program_choice }}</td>
          </tr>
          <tr>
            <td class="label-col">Pilihan Tempat Tinggal</td>
            <td class="sep-col">:</td>
            <td class="val-col">{{ $registration->dormitory_choice ? 'Tinggal di Asrama (Bermukim)' : 'Siswa Reguler (Pulang-Pergi)' }}</td>
          </tr>
        </table>

        <div class="section-title" style="margin-top: 12px;">B. Data Orang Tua / Wali & Tempat Tinggal</div>
        <table class="data-table">
          <tr>
            <td class="label-col">Nama Orang Tua / Wali</td>
            <td class="sep-col">:</td>
            <td class="val-col">{{ $registration->parent_name }}</td>
          </tr>
          <tr>
            <td class="label-col">No. WhatsApp / Telepon</td>
            <td class="sep-col">:</td>
            <td class="val-col" style="font-family: 'JetBrains Mono', monospace;">{{ $registration->phone_number }}</td>
          </tr>
          <tr>
            <td class="label-col">Alamat Lengkap</td>
            <td class="sep-col">:</td>
            <td class="val-col" style="font-weight: 500;">{{ $registration->address }}</td>
          </tr>
          <tr>
            <td class="label-col">Waktu Mendaftar Online</td>
            <td class="sep-col">:</td>
            <td class="val-col" style="font-size: 11px; color: #475569;">{{ $registration->created_at ? $registration->created_at->format('d F Y, H:i') . ' WIB' : '-' }}</td>
          </tr>
        </table>
      </div>

      <!-- Pas Foto Box -->
      <div class="photo-box-wrap">
        <div class="photo-box">
          <i class="fa-regular fa-image"></i>
          <span>Pas Foto</span>
          <span style="font-weight: 700; font-size: 10px; margin-top: 2px;">3 x 4 cm</span>
          <span style="font-size: 9px; margin-top: 4px; color: #94a3b8;">Tempel Disini</span>
        </div>
      </div>
    </div>

    <!-- 5. Berkas Persyaratan yang Wajib Dibawa -->
    <div class="info-box">
      <h4><i class="fa-solid fa-clipboard-check text-amber-600"></i> Petunjuk Verifikasi Berkas Fisik di Sekretariat Madrasah:</h4>
      <p style="margin-bottom: 6px; color: #475569;">
        Harap cetak kartu ini dan bawa ke Sekretariat PPDB Madrasah Aliyah Darun Najah bersama kelengkapan dokumen persyaratan berikut:
      </p>
      <ul>
        @if($ppdbSetting && !empty($ppdbSetting->requirements_list))
          @foreach($ppdbSetting->requirements_list as $req)
            <li>{{ $req }}</li>
          @endforeach
        @else
          <li>Fotokopi Ijazah / Surat Keterangan Lulus (SKL) MTs/SMP terlegalisir (2 lembar)</li>
          <li>Fotokopi Kartu Keluarga (KK) dan KTP Orang Tua / Wali (2 lembar)</li>
          <li>Fotokopi Akta Kelahiran calon siswa (2 lembar)</li>
          <li>Pas foto resmi ukuran 3x4 latar belakang merah (4 lembar)</li>
          <li>Fotokopi KIP / PKH / Piagam Sertifikat Kejuaraan / Tahfidz (jika memiliki)</li>
        @endif
      </ul>
    </div>

    <!-- 6. Lembar Tanda Tangan -->
    <div class="signature-grid">
      <div class="sig-col">
        <div>Calon Siswa / Orang Tua Wali,</div>
        <div class="sig-space"></div>
        <div class="sig-name">{{ $registration->full_name }}</div>
        <div class="sig-role">Tanda tangan & Nama Terang</div>
      </div>

      <div class="sig-col">
        <div>Sambikarto, {{ date('d F Y') }}<br>Panitia Penerimaan Peserta Didik Baru,</div>
        <div class="sig-space"></div>
        <div class="sig-name">{{ $ppdbSetting->contact_name ?? 'Panitia PPDB Madrasah Aliyah Darun Najah' }}</div>
        <div class="sig-role">NIP / NIY Panitia Sekretariat</div>
      </div>
    </div>

  </div>

</body>
</html>
