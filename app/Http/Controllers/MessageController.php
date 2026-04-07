<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Nampilin halaman chat CS.
     */
    public function index()
    {
        $messages = Message::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandain pesan dari admin jadi udah dibaca
        Message::where('user_id', Auth::id())
            ->where('is_admin', true)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('chat.index', compact('messages'));
    }

    /**
     * Ngirim pesan baru ke admin.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->isChatClosed()) {
            return redirect()->route('chat.index')->with('error', 'Percakapan telah ditutup oleh admin. Silakan mulai percakapan baru.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ], [
            'content.required' => 'Pesan tidak boleh kosong.',
        ]);

        try {
            Message::create([
                'user_id' => $user->id,
                'content' => $request->content,
                'is_admin' => false,
            ]);

            return redirect()->route('chat.index')->with('success', 'Pesan terkirim.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim pesan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan.')->withInput();
        }
    }

    /**
     * Mulai percakapan baru (reset chat_closed_at).
     */
    public function startNew()
    {
        try {
            $user = Auth::user();
            $user->update(['chat_closed_at' => null]);

            return redirect()->route('chat.index')->with('success', 'Percakapan baru dimulai. Silakan kirim pesan Anda.');
        } catch (\Exception $e) {
            Log::error('Gagal memulai percakapan baru: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memulai percakapan baru.');
        }
    }
}
