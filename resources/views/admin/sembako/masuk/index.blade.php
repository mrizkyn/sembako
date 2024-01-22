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
                <h2><b>Sembako Masuk</b></h2>
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
                        <th>Tanggal Masuk</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($sembakomasuk as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->date }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->Category->category_name }}</td>
                            <td>{{ $s->amount }}</td>
                            <td>{{ $s->Unit->unit_name }}</td> 
                            <td>{{ $s->exp_date }}</td>
                            <td>
                                <button class="btn btn-warning bi bi-door-open" onclick="moveToKeluar({{ $s->id }})">Keluarkan</button>
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
                    <form action="{{ route('masuk.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date">Tanggal Masuk:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="name">Nama Barang:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id">Kategori:</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount">Jumlah:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_id">Satuan:</label>
                            <select class="form-control" id="unit_id" name="unit_id">
                                <option value="">Pilih Satuan</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exp_date">Tanggal Kadaluarsa:</label>
                            <input type="date" class="form-control" id="exp_date" name="exp_date" required>
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