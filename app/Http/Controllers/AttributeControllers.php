<?php

namespace App\Http\Controllers;

use App\Models\attribute;
use Attribute as GlobalAttribute;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AttributeControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now();

        $data['attributes'] = $data['barangSedia'] = DB::table('attributes')
        ->leftJoin('reservation_attributes', function ($join) use ($today) {
            $join->on('attributes.id', '=', 'reservation_attributes.attribute_id')
                 ->where('reservation_attributes.reservation_end', '>=', $today);
        })
        ->select(
            'attributes.*',
            DB::raw('IFNULL(attributes.qty - COALESCE(SUM(reservation_attributes.qty), 0), attributes.qty) as qty_sedia')
        )
        ->groupBy('attributes.id')
        ->get();
      
        $data['totalbarang'] = attribute::all()->sum('qty');
        $data['barangSedia'] = DB::table('attributes')
            ->leftJoin('reservation_attributes', function ($join) use ($today) {
                $join->on('attributes.id', '=', 'reservation_attributes.attribute_id')
                     ->where('reservation_attributes.reservation_end', '>=', $today);
            })
            ->select(
                'attributes.*',
                DB::raw('IFNULL(attributes.qty - COALESCE(SUM(reservation_attributes.qty), 0), attributes.qty) as qty_sedia')
            )
            ->groupBy('attributes.id')
            ->get();
        // $data['barangSedia'] = DB::table('attributes')
        // ->leftJoin('reservation_attributes', function ($join) use ($today) {
        //     $join->on('attributes.id', '=', 'reservation_attributes.attribute_id');
        // })
        // ->leftJoin('room_reservations', function ($join) use ($today) {
        //     $join->on('reservation_attributes.room_reservation_id', '=', 'room_reservations.id')
        //         ->where('room_reservations.reservation_end', '>=', $today);
        // })
        // ->select(
        //     'attributes.*',
        //     DB::raw('IFNULL(attributes.qty - COALESCE(SUM(reservation_attributes.qty), 0), attributes.qty) as qty_sedia')
        // )
        // ->groupBy('attributes.id')
        // ->get();

        return view('pages.attributes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['attributes'] = Attribute::all();

        return view('pages.attributes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Attribute::create([
            'name'  => $request->name,
            'description'  => $request->description,
            'qty'  => $request->qty,

        ]);

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
        $data['attribute'] = Attribute::findOrFail($id);
        $data['attributes'] = Attribute::all();

        return view('pages.attributes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attribute = Attribute::findorFail($id);

        $attribute->update([
            'name' => $request->name,
            'description' => $request->description,
            'qty'  => $request->qty,

        ]);

        session()->flash('toastr-success', 'Data berhasil diubah.');
        return redirect()->view('pages.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = attribute::findOrfail($id);
        $attribute->delete();
    }
}
