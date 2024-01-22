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
                <h2><b>Data Satuan</b></h2>
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
                        <th>Nama Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $unit->unit_name }}</td>
                            <td>
                                <span>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editDataModal{{ $unit->id }}">
                                        Edit
                                    </button>
                                </span>
                                {{-- <span>
                                    <form action="{{ route('satuan.destroy', $unit->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </span> --}}
                            
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editDataModal{{ $unit->id }}" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editDataModalLabel">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('satuan.update', $unit->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="edit_unit_name">Nama Satuan:</label>
                                                        <input type="text" class="form-control" id="edit_unit_name" name="unit_name" value="{{ $unit->unit_name }}" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <form action="{{ route('satuan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="unit_name">Nama Satuan:</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name" required>
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