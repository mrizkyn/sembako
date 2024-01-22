@extends('layouts.app')
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
                <h2><b>Sembako Keluar</b></h2>
               
                <br>
                <br>
        <div class="table-responsive nowrap" style="width:100%">
            <table id="accountsTable" class="table table-striped">
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

    
    
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#accountsTable').DataTable();
        });
    
        function moveToKeluar(id) {
            // Tampilkan konfirmasi
            if (confirm("Apakah Anda yakin ingin memindahkan data ini ke Sembako Keluar?")) {
                // Redirect ke route atau action yang menangani pemindahan dengan menyertakan parameter id
                window.location.href = "{{ url('/admin/sembako-masuk/move-to-keluar') }}/" + id;
            }
        }
    </script>
    
  
</div>

@endsection