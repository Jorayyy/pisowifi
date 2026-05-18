<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class ClientWebController extends Controller
{
    /**
     * Display a listing of currently connected WiFi clients.
     */
    public function index()
    {
        // Fetch active sessions (where expires_at is in the future and not ended)
        $activeClients = Session::with(['device', 'voucher'])
            ->where('expires_at', '>', now())
            ->latest()
            ->paginate(15);

        return view('clients.index', compact('activeClients'));
    }

    /**
     * Kick a client (end their session manually).
     */
    public function destroy(Session $session)
    {
        $session->update([
            'expires_at' => now(), // Force expiration
        ]);

        return back()->with('success', 'Client disconnected successfully.');
    }
}
