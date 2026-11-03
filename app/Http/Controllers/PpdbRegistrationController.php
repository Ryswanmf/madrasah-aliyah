<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\HomeSetting;
use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use Illuminate\Http\Request;

class PpdbRegistrationController extends Controller
{
    /**
     * Store a newly created registration in storage.
     */
    public function store(Request $request)
    {
        $ppdbSetting = PpdbSetting::first();
        if ($ppdbSetting && ! $ppdbSetting->is_open) {
            return redirect()->back()->withErrors([
                'full_name' => $ppdbSetting->closed_message ?: 'Pendaftaran siswa/i baru online saat ini sedang ditutup.',
            ]);
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'nisn' => ['nullable', 'string', 'max:20'],
            'gender' => ['required', 'in:L,P'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date'],
            'school_origin' => ['required', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string'],
            'program_choice' => ['required', 'string', 'max:100'],
            'dormitory_choice' => ['required', 'boolean'],
        ]);

        $validated['registration_number'] = PpdbRegistration::generateRegistrationNumber();
        $validated['status'] = 'pending';

        $registration = PpdbRegistration::create($validated);

        // Pre-build WhatsApp message for confirmation
        $primaryContact = Contact::where('is_active', true)->orderBy('is_primary', 'desc')->first();
        $waAdmin = !empty($ppdbSetting?->contact_phone)
            ? preg_replace('/[^0-9]/', '', $ppdbSetting->contact_phone)
            : ($primaryContact ? $primaryContact->clean_whatsapp : '6285658973426');
        if (str_starts_with($waAdmin, '0')) {
            $waAdmin = '62' . substr($waAdmin, 1);
        }
        $program = $registration->program_choice;
        $dorm = $registration->dormitory_choice ? 'Siswa/i Asrama' : 'Siswa/i Reguler';
        $waText = "Assalamu'alaikum Panitia PPDB MA Darun Najah Sambikarto,\n\n"
            . "Saya telah mengisi formulir pendaftaran siswa/i baru online dengan data:\n"
            . "• No. Registrasi: {$registration->registration_number}\n"
            . "• Nama Calon Siswa/i: {$registration->full_name}\n"
            . "• Asal Sekolah: {$registration->school_origin}\n"
            . "• Pilihan Program: {$program}\n"
            . "• Status Asrama: {$dorm}\n"
            . "• No. WA Wali: {$registration->phone_number}\n\n"
            . "Mohon info tahapan verifikasi berkas selanjutnya. Terima kasih.";

        $waLink = "https://wa.me/{$waAdmin}?text=" . rawurlencode($waText);

        $previous = url()->previous();
        $target = str_contains($previous, 'ppdb') ? (str_contains($previous, '#') ? $previous : $previous . '#form-ppdb') : $previous . '#ppdb';

        return redirect()->to($target)->with([
            'ppdb_success' => true,
            'registration' => $registration,
            'wa_link' => $waLink,
        ]);
    }

    /**
     * Check status of registration online.
     */
    public function checkStatus(Request $request)
    {
        $query = $request->input('query');
        $result = null;

        if ($query) {
            $result = PpdbRegistration::where('registration_number', $query)
                ->orWhere('phone_number', $query)
                ->first();
        }

        $previous = url()->previous();
        $target = str_contains($previous, 'ppdb') ? (str_contains($previous, '#') ? $previous : $previous . '#form-ppdb') : $previous . '#ppdb';

        return redirect()->to($target)->with([
            'status_checked' => true,
            'search_query' => $query,
            'status_result' => $result,
        ]);
    }

    /**
     * Display printable registration card.
     */
    public function printCard($registration_number)
    {
        $registration = PpdbRegistration::where('registration_number', $registration_number)
            ->firstOrFail();

        $ppdbSetting = PpdbSetting::first();
        $siteSetting = HomeSetting::first();
        $contact = Contact::where('is_active', true)->orderBy('is_primary', 'desc')->first();

        return view('pages.ppdb-print', compact('registration', 'ppdbSetting', 'siteSetting', 'contact'));
    }

    /**
     * Export all PPDB registrations to CSV (Excel compatible).
     */
    public function exportCsv()
    {
        $fileName = 'data-pendaftar-ppdb-ma-darun-najah-' . date('Y-m-d-His') . '.csv';
        $registrations = PpdbRegistration::orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = [
            'No. Registrasi',
            'Nama Lengkap',
            'Jenis Kelamin',
            'NISN',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Asal Sekolah',
            'Nama Orang Tua / Wali',
            'Nomor WhatsApp',
            'Pilihan Program',
            'Status Asrama',
            'Alamat',
            'Status Verifikasi',
            'Waktu Pendaftaran',
        ];

        $callback = function () use ($registrations, $columns) {
            $file = fopen('php://output', 'w');
            // Write UTF-8 BOM so Excel opens it with correct encoding
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns, ';');

            foreach ($registrations as $reg) {
                $gender = $reg->gender === 'L' ? 'Laki-laki' : 'Perempuan';
                $dorm = $reg->dormitory_choice ? 'Siswa/i Asrama' : 'Siswa/i Reguler';
                $status = match($reg->status) {
                    'accepted' => 'Diterima',
                    'verified' => 'Berkas Terverifikasi',
                    'rejected' => 'Tidak Lolos',
                    default => 'Menunggu Verifikasi',
                };

                fputcsv($file, [
                    $reg->registration_number,
                    $reg->full_name,
                    $gender,
                    $reg->nisn ?: '-',
                    $reg->birth_place,
                    $reg->birth_date ? date('d/m/Y', strtotime($reg->birth_date)) : '-',
                    $reg->school_origin,
                    $reg->parent_name,
                    $reg->phone_number,
                    $reg->program_choice,
                    $dorm,
                    str_replace(["\r", "\n"], ' ', $reg->address),
                    $status,
                    $reg->created_at ? $reg->created_at->format('d/m/Y H:i') : '-',
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
