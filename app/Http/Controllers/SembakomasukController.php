<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sembakokeluar;
use App\Models\Unit;
use App\Models\Sembakomasuk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SembakomasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
             $sembakokeluar->category_id = $sembakomasuk->category_id;
             $sembakokeluar->amount = $request->input('amount');
             $sembakokeluar->unit_id = $sembakomasuk->unit_id;
             $sembakokeluar->exp_date = $sembakomasuk->exp_date;
             $sembakokeluar->date = $sembakomasuk->date;
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
     

    public function index()
    {
        // $sembakomasuk = Sembakomasuk::All();
        $sembakomasuk = Sembakomasuk::OrderBy('date','desc')->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.sembako.masuk.index', compact('sembakomasuk','categories','units'));
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
            'exp_date' => 'required',
            'amount' => 'required',
        ]);
        
        $sembakoMasuk = new Sembakomasuk();
        $sembakoMasuk->category_id = $request->input('category_id');
        $sembakoMasuk->unit_id = $request->input('unit_id');
        $sembakoMasuk->name = $request->input('name');
        $sembakoMasuk->date = $request->input('date');
        $sembakoMasuk->exp_date = $request->input('exp_date');
        $sembakoMasuk->amount = $request->input('amount');
        
        $sembakoMasuk->save();
        
        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/admin/sembako-masuk');
   
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
    // Tambahkan metode baru untuk menangani pemindahan
public function moveToKeluar($id)
{
    $sembakoMasuk = Sembakomasuk::find($id);

    if (!$sembakoMasuk) {
        return redirect('/admin/sembako-masuk')->with('error', 'Data tidak ditemukan');
    }

    $sembakoKeluar = new Sembakokeluar();
    $sembakoKeluar->category_id = $sembakoMasuk->category_id;
    $sembakoKeluar->unit_id = $sembakoMasuk->unit_id;
    $sembakoKeluar->name = $sembakoMasuk->name;
    $sembakoKeluar->date = $sembakoMasuk->date;
    $sembakoKeluar->out_date = now(); 
    $sembakoKeluar->exp_date = $sembakoMasuk->exp_date;
    $sembakoKeluar->amount = $sembakoMasuk->amount;

    $sembakoKeluar->save();

    $sembakoMasuk->delete();

    return redirect('/admin/sembako-masuk')->with('success', 'Data berhasil dikeluarkan');
}

}
