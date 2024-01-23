<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sembakokeluar;
use App\Models\Sembakomasuk;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SembakokeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sembakomasuk = Sembakomasuk::All();
        $sembakokeluar = Sembakokeluar::OrderBy('out_date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.sembako.keluar.index', compact('sembakomasuk','sembakokeluar', 'units', 'categories'));
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

        public function keluarkanForm($id)
    {
        $sembakomasuk = Sembakomasuk::findOrFail($id); // Menggunakan findOrFail agar melemparkan 404 jika tidak ditemukan
        return view('admin.sembako.keluar.keluarkan', compact('sembakomasuk'));
    
    }

    public function keluarkan(Request $request, $id)
    {
        $request->validate([
            'out_date' => 'required|date',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'exp_date' => 'required|date',
        ]);
        try {
            DB::beginTransaction();
    
            $sembakomasuk = Sembakomasuk::findOrFail($id);
    
            $sembakokeluar = new Sembakokeluar();
            $sembakokeluar->out_date = $request->input('out_date');
            $sembakokeluar->name = $sembakomasuk->name;
            // $sembakokeluar->category_id = $sembakomasuk->category_id;
            $sembakokeluar->amount = $request->input('amount');
            // $sembakokeluar->unit_id = $sembakomasuk->unit_id;
            // $sembakokeluar->exp_date = $sembakomasuk->exp_date;
            // $sembakokeluar->date = $sembakomasuk->date;
            $sembakokeluar->save();
    
            $sembakomasuk->amount -= $request->input('amount');
            $sembakomasuk->save();
    
            DB::commit();
    
            return redirect()->route('masuk')->with('success', 'Data berhasil keluar.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan saat mengeluarkan data.']);
        }
    }
    

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            // 'sembako_id' => 'required|exists:sembakomasuks,id',
            'amount' => 'required|integer|min:1',
            'outDate' => 'required|date',
            // 'expDate' => 'required|date',
            // 'date' => 'required|date',
            // 'category_id' => 'required', // Adjust according to your actual field name
            // 'unit_id' => 'required', // Adjust according to your actual field name
            // Add more validation rules for additional fields as needed
        ]);
    
        // Create a new SembakoKeluar instance
        $sembakoKeluar = new SembakoKeluar;
        $sembakoKeluar->category_id = $request->input('category_id');
        $sembakoKeluar->unit_id = $request->input('unit_id');
        $sembakoKeluar->out_date = $request->input('outDate');
        $sembakoKeluar->amount = $request->input('amount');
        $sembakoKeluar->sembakomasuk_id = $request->input('sembako_id');
        $sembakoKeluar->exp_date = $request->input('expDate');
        $sembakoKeluar->date = $request->input('date');
        
        // Save the data
        $sembakoKeluar->save();

        // You can add a success message or redirect to a specific page
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
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
