<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:35',
            'email' => 'nullable|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|min:5|max:3000',
            'direct_whatsapp' => 'nullable|boolean',
        ], [
            'name.required' => 'Mohon cantumkan nama lengkap Anda.',
            'phone.required' => 'Mohon cantumkan nomor WhatsApp / HP yang aktif.',
            'subject.required' => 'Mohon pilih topik atau keperluan pesan Anda.',
            'message.required' => 'Mohon tuliskan isi pesan atau pertanyaan Anda.',
            'message.min' => 'Isi pesan minimal 5 karakter.',
        ]);

        $messageRecord = ContactMessage::create([
            'name' => strip_tags($validated['name']),
            'phone' => strip_tags($validated['phone']),
            'email' => !empty($validated['email']) ? strip_tags($validated['email']) : null,
            'subject' => strip_tags($validated['subject']),
            'message' => strip_tags($validated['message']),
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ]);

        // Get official school WhatsApp hotline
        $contact = Contact::first();
        $officialWa = $contact ? $contact->clean_whatsapp : '6285658973426';

        $waText = "Assalamu'alaikum Warahmatullahi Wabarakatuh,\n\n"
            . "Nama: {$messageRecord->name}\n"
            . "No. HP/WA: {$messageRecord->phone}\n"
            . "Email: " . ($messageRecord->email ?: '-') . "\n"
            . "Keperluan: {$messageRecord->subject}\n\n"
            . "Pesan:\n{$messageRecord->message}\n\n"
            . "(Terkirim resmi melalui Website MA Darun Najah Sambikarto)";

        $waUrl = "https://wa.me/{$officialWa}?text=" . rawurlencode($waText);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Alhamdulillah, pesan Anda telah terkirim dan tercatat di sistem kami.',
                'wa_url' => $waUrl,
            ]);
        }

        $response = redirect()->route('kontak')
            ->with('success', 'Alhamdulillah, pesan Anda berhasil terkirim ke Sekretariat MA Darun Najah Sambikarto! Tim panitia/tata usaha kami akan segera merespons.');

        if ($request->boolean('direct_whatsapp')) {
            $response->with('open_wa_url', $waUrl);
        }

        return $response;
    }
}
