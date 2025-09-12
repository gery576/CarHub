<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // Beérkező üzenetek lekérdezése - beleértve az eredeti üzeneteket és a nekünk küldött válaszokat
        $received = Message::where(function($query) {
            $query->where('receiver_id', Auth::id());  // Nekünk címzett üzenetek (eredeti + válasz)
        })
        ->with(['sender', 'car', 'originalMessage'])
        ->latest()
        ->get();

        // Elküldött üzenetek
        $sent = Message::where('sender_id', Auth::id())
            ->with(['receiver', 'car', 'originalMessage'])
            ->latest()
            ->get();

        return view('messages.index', [
            'received' => $received,
            'sent' => $sent
        ]);
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'message' => 'required|min:10'
        ]);

        // Ha ez egy válaszüzenet
        if ($request->has('reply_to')) {
            $originalMessage = Message::findOrFail($request->reply_to);

            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $originalMessage->sender_id, // A válasz az eredeti üzenet küldőjének megy
                'car_id' => $car->id,
                'message' => $request->message,
                'reply_to' => $request->reply_to
            ]);
        }
        // Ha ez egy új üzenet
        else {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $car->user_id,
                'car_id' => $car->id,
                'message' => $request->message
            ]);
        }

        return back()->with('success', 'Üzenet elküldve!');
    }
}
