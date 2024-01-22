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
                <h2><b>Laporan Sembako Masuk</b></h2>
                <a href="{{ route('owner.print1') }}" target="_blank" type="button" class="btn btn-success">
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
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sembakomasuk as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->date }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->Category->category_name }}</td>
                            <td>{{ $s->amount }}</td>
                            <td>{{ $s->Unit->unit_name }}</td> 
                            <td>{{ $s->exp_date }}</td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

          
        </div>
    </div>

    
<script>
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