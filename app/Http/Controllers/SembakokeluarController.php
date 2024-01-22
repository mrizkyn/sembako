<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sembakokeluar;
use App\Models\Unit;
use Illuminate\Http\Request;

class SembakokeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sembakokeluar = Sembakokeluar::OrderBy('out_date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.sembako.keluar.index', compact('sembakokeluar', 'units', 'categories'));
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
            'category_id' => 'required',
            'unit_id' => 'required',
            'name' => 'required',
            'date' => 'required',
            'out_date' => 'required',
            'exp_date' => 'required',
            'amount' => 'required',
        ]);
        
        $sembakoKeluar = new Sembakokeluar();
        $sembakoKeluar->category_id = $request->input('category_id');
        $sembakoKeluar->unit_id = $request->input('unit_id');
        $sembakoKeluar->name = $request->input('name');
        $sembakoKeluar->date = $request->input('date');
        $sembakoKeluar->out_date = $request->input('date');
        $sembakoKeluar->exp_date = $request->input('exp_date');
        $sembakoKeluar->amount = $request->input('amount');
        
        $sembakoKeluar->save();
        
        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/admin/sembako-keluar');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
