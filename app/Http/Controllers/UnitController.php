<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('admin.satuan.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit_name' => 'required'
        ]);
        
        $units = new Unit();
        $units->unit_name = $request->input('unit_name');
        
        $units->save();
        
        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/admin/satuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_name' => 'required',
        ]);
    
        $unit = Unit::find($id);
        $unit->unit_name = $request->input('unit_name');
        $unit->save();
    
        return redirect()->route('satuan')->with('success', 'Data berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $unit = Unit::find($id);
    
        if (!$unit) {
            return redirect()->route('satuan')->with('error', 'Data tidak ditemukan.');
        }
    
        $unit->delete();
    
        return redirect()->route('satuan')->with('success', 'Data berhasil dihapus.');
    }
}
