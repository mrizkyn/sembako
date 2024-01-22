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
                <h2><b>Data Kategori</b></h2>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDataModal">
                    Tambah Data
                </button>
                <br>
                <br>
        <div class="table-responsive nowrap" style="width:100%">
            <table id="accountsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

          
        </div>
    </div>

    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name">Nama Kategory:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <div class="modal-footer">
                            <button id="btnSimpan" type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
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