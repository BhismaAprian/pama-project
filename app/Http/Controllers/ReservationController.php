<?php

namespace App\Http\Controllers;
use app\Models\attribute;
use App\Models\Room;
use App\Models\room_attributes;
use App\Models\RoomReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['room'] = Room::with('roomAttributes', 'roomReservation')->get();

        // dd($data);
        $data['attributes'] = room_attributes::with('attributes')->get();        
        return view('pages.reservation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::findOrfail($id);
        $history = RoomReservation::with('room', 'user')->latest('created_at')->limit(2)->get();
        
        return view('pages.reservation.edit',compact('room','history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);
        $user_id = optional(auth()->user())->id;

        RoomReservation::Create([
            'room_id' => $room->id,
            'user_id' => $user_id,
            'guest' => $user_id ? null : $request->guest ?? '-',
            'reservation_start' => $request->reservation_start,
            'reservation_end'   => $request->reservation_end,
            'description'       => $request->description,
            'created_at'        => Carbon::now(),
        ]);

        session()->flash('sweet-success', 'Ruangan Berhasil Dipinjam');
        return redirect()->route('reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
