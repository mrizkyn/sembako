<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sembakokeluar;
use App\Models\Sembakomasuk;
use App\Models\Unit;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.dashboard');   
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
    public function reportin()
    {
        $sembakomasuk = Sembakomasuk::OrderBy('date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('owner.index', compact('sembakomasuk','categories','units'));
    }
    public function printin()
    {
        $sembakomasuk = Sembakomasuk::OrderBy('date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('owner.cetak.index', compact('sembakomasuk','categories','units'));
    }
    public function reportout()
    {
        $sembakokeluar = Sembakokeluar::OrderBy('out_date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('owner.keluar.index', compact('sembakokeluar', 'units', 'categories'));
    }
    public function printout()
    {
        $sembakokeluar = Sembakokeluar::OrderBy('out_date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('owner.keluar.cetak', compact('sembakokeluar', 'units', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
