@extends('owner.app')
@section('content')
    

<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    Data Yang Anda Masukan Tidak Lengkap!
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <h2><b>Laporan Sembako Keluar</b></h2>
                <a href="{{ route('owner.print2') }}" target="_blank" type="button" class="btn btn-success">
                    Cetak Laporan
                </a>
                <br>
                <br>
        <div class="table-responsive nowrap" style="width:100%">
            <table id="accountsTable" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Tanggal Kadaluarsa</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($sembakokeluar as $sk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sk->date }}</td>
                            <td>{{ $sk->out_date }}</td>
                            <td>{{ $sk->name }}</td>
                            <td>{{ $sk->Category->category_name }}</td>
                            <td>{{ $sk->amount }}</td>
                            <td>{{ $sk->Unit->unit_name }}</td> 
                            <td>{{ $sk->exp_date }}</td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

          
        </div>
    </div>

    
    
    
  
</div>

@endsection