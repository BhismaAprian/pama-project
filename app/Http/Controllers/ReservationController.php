<?php

namespace App\Http\Controllers;

use App\Models\attribute;
use App\Models\ReservationAttributes;
use App\Models\Room;
use App\Models\room_attributes;
use App\Models\RoomReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['room'] = Room::with('roomAttributes', 'roomReservation')->get();
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
        $today = \Carbon\Carbon::now()->timezone('asia/makassar');
        $room = Room::findOrfail($id);
        $room->load('roomReservation');

        $barang = attribute::all();

        $today = Carbon::now()->timezone('asia/makassar');
        // KODE YANG BENARDIBAWAH

        // $barangSedia = $barangPinjam->selectRaw('attributes.qty -  reservation_attributes.qty as qty_sedia')->get();
        // $barangSedia = DB::table('attributes')
        // ->leftJoin('reservation_attributes', function($join) use ($today) {
        //     $join->on('attributes.id', '=', 'reservation_attributes.attribute_id');
        // })
        // ->leftJoin('room_reservations', function($join) use ($today) {
        //     $join->on('reservation_attributes.room_reservation_id', '=', 'room_reservations.id')
        //         ->where('room_reservations.reservation_end', '>=', $today);
        // })
        // ->select(
        //     'attributes.*',
        //     DB::raw('IFNULL(attributes.qty - COALESCE(SUM(reservation_attributes.qty), 0), attributes.qty) as qty_sedia'),
        //     DB::raw('(IFNULL(attributes.qty - COALESCE(SUM(reservation_attributes.qty), 0), attributes.qty) > 0) as tersedia')
        // )
        // ->groupBy('attributes.id')
        // ->get();
        $barangSedia = DB::table('attributes')
            ->leftJoin('reservation_attributes', function ($join) use ($today) {
                $join->on('attributes.id', '=', 'reservation_attributes.attribute_id')
                    ->where('reservation_attributes.reservation_end', '>=', $today);
            })
            ->select(
                'attributes.*',
                DB::raw('IFNULL(attributes.qty - COALESCE(SUM(reservation_attributes.qty), 0), attributes.qty) as qty_sedia')
            )
            ->groupBy('attributes.id')
            ->havingRaw('qty_sedia > 0')
            ->get();


        $history = RoomReservation::with('room', 'user')->latest('created_at')->limit(2)->get();

        return view('pages.reservation.edit', compact('room', 'history', 'barangSedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);
        $user_id = optional(auth()->user())->id;

        $roomReservation = RoomReservation::Create([
            'room_id' => $room->id,
            'user_id' => $user_id,
            'guest' => $user_id ? null : $request->guest ?? '-',
            'reservation_start' => $request->reservation_start,
            'reservation_end'   => $request->reservation_end,
            'description'       => $request->description,
            'created_at'        => Carbon::now(),
        ]);

        $attribut = $request->input('objekSelect');
        foreach ($attribut as $barang) {
            ReservationAttributes::create([
                'room_reservation_id' => $roomReservation->id,
                'attribute_id' => $barang,
                'qty' => $request->qty,
                'reservation_end'   => $request->reservation_end,
            ]);
        }

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
