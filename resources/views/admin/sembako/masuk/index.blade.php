@extends('layouts.app')
@section('content')

<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#keluarkanModal{{ $s->id }}">Keluarkan</button>
                                        
                                        <!-- Modal Keluarkan -->
                                        <div class="modal fade" id="keluarkanModal{{ $s->id }}" tabindex="-1" aria-labelledby="keluarkanModalLabel{{ $s->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="keluarkanModalLabel">Keluarkan Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('keluar.keluarkan', $s->id) }}" method="POST">                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="out_date">Tanggal Keluar:</label>
                                                                <input type="date" class="form-control" id="out_date" name="out_date" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="amount">Jumlah:</label>
                                                                <input type="number" class="form-control" id="amount" name="amount" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Keluarkan</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Keluarkan -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Data Modal -->
        <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('masuk.store') }}" method="POST" id="dynamicForm">
                            @csrf
                            <div class="mb-3">
                                <label for="date">Tanggal Masuk:</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="product-container">
                                <!-- Initial product input fields -->
                                <div class="product-item">
                                    <div class="mb-3">
                                        <label for="name">Nama Barang:</label>
                                        <input type="text" class="form-control" name="items[0][name]" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id">Kategori:</label>
                                        <select class="form-control" name="items[0][category_id]">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="amount">Jumlah:</label>
                                        <input type="number" class="form-control" name="items[0][amount]" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="unit_id">Satuan:</label>
                                        <select class="form-control" name="items[0][unit_id]">
                                            <option value="">Pilih Satuan</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exp_date">Tanggal Kadaluarsa:</label>
                                        <input type="date" class="form-control" name="items[0][exp_date]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="addProduct">Tambah Barang</button>
                                <button type="submit" class="btn btn-success" id="btnSimpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#addProduct").click(function() {
                var newProduct = $(".product-item:first").clone();
                newProduct.find("input, select").val("");
                newProduct.appendTo(".product-container");
            });
        });
    </script>
@endsection
