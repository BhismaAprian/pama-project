<?php

namespace App\Http\Controllers;

use App\Models\RoomReservation;
use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $total = Room::all();
        $today = Carbon::now();
        $pinjaman = RoomReservation::whereMonth('reservation_start', Carbon::now()->month);
        $kadaluarsa = RoomReservation::where('reservation_end', '<', $today);
        $ongoing = RoomReservation::where('reservation_end', '>=', $today);
        $data['ongoing'] = $ongoing->count();
        $data['selesai'] = $kadaluarsa->count();
        $data['totalroom'] = $total->count();
        $data['pinjaman'] = $pinjaman->count();
        $data['history'] = RoomReservation::with('room','user')->latest()->get();

        return view('pages.home', $data);
    }

    public function header()
    {
        $data['history'] = RoomReservation::with('user', 'room')->get();

        return view('layouts.header', $data);
    }
}
