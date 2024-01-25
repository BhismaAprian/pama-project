<?php

namespace App\Http\Controllers;

use App\Models\RoomReservation;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $data['history'] = RoomReservation::with('room','user')->latest()->get();
        return view('pages.history.index',$data);
    }

    public function destroy (string $id)
    {
        $history = RoomReservation::findOrfail($id);
        $history->delete();
    }
}
