<?php

namespace App\Http\Controllers;

use App\Models\attribute;
use App\Models\Room;
use App\Models\room_attributes;
use App\Models\RoomReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RoomControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['room'] = Room::with(['roomAttributes' => function ($query) {
            $query->with('attributes');
        }])->get();

        $data['attributes'] = room_attributes::with('attributes');

        $today = now()->format('Y-m-d');
        $avail = RoomReservation::all();


        $data['roomTersedia'] = $avail->count();
        return view('pages.room.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['rooms'] = Room::take(5)->get();
        $data['attributes'] = Attribute::with('roomAttributes')->get();
        return view('pages.room.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'thumbnail'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload image
        $image = $request->file('thumbnail');
        $image->storeAs('public/thumbnails', $image->hashName());

        $room = Room::create([
            'name'  => $request->name,
            'thumbnail'  => $image->hashName(),
            'description'  => $request->description,
        ]);

        $attribute = $request->input('attribute_id');
        $room_id = $room->id;
        foreach ($attribute as $attributes) {
            DB::table('room_attributes')->insert([
                'room_id' => $room_id,
                'attribute_id' => $attributes,
            ]);
        };
        session()->flash('toastr-success', 'Data berhasil disimpan.');
        return redirect()->back();
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

        $data['room'] = Room::findOrFail($id);
        $data['rooms'] = Room::take(5)->get();

        return view('pages.room.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        // $this->validate($request, [
        //     'thumbnail'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
        // ]);


        $room = Room::findorFail($id);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $image->storeAs('public/thumbnails', $image->hashName());

            $room->update([
                'name'  => $request->name,
                'thumbnail'  => $image->hashName(),
                'description'  => $request->description,
            ]);
        } else {

            $room->update([
                'name'  => $request->name,
                'description'  => $request->description,
            ]);
        }
        session()->flash('toastr-success', 'Data berhasil diubah.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $room = Room::findOrfail($id);
        Storage::delete('public/thumbnails/' . $room->thumbnail);

        $room->delete();
    }
}
