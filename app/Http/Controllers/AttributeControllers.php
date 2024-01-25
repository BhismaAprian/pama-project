<?php

namespace App\Http\Controllers;

use App\Models\attribute;
use Illuminate\Http\Request;

class AttributeControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['attributes'] = Attribute::all();

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
