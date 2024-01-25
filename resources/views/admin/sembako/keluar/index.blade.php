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
                <h2><b>Sembako Keluar</b></h2>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#keluarModal">Keluarkan Sembako</button>

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
                
                        <th>Tanggal Kadaluarsa</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($sembakokeluar as $sk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sk->Sembakomasuk->date }}</td>
                            <td>{{ $sk->created_at }}</td>
                            <td>{{ $sk->Sembakomasuk->name }}</td>
                            <td>{{ $sk->Category->category_name }}</td>
                            <td>{{ $sk->amount }}</td>
                            
                            <td>{{ $sk->Sembakomasuk->exp_date }}</td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

          
        </div>
    </div>

    
    <div class="modal fade" id="keluarModal" tabindex="-1" role="dialog" aria-labelledby="keluarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="keluarModalLabel">Keluarkan Sembako</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form here with a dropdown for sembakomasuks and an input for amount -->
                    <form id="keluarForm" action="{{ route('sembako-keluar.store') }}" method="post">
                        @csrf
                        <!-- Dropdown to select sembakomasuks -->
                        <div class="form-group">
                            <label for="sembakoSelect">Pilih Barang Sembako:</label>
                            <select id="sembakoSelect" class="form-control select2" name="sembako_id">
                                @foreach ($sembakomasuk as $sembako)
                                    <option value="{{ $sembako->id }}" data-category="{{ $sembako->category->id }}" data-exp-date="{{ $sembako->exp_date }}">{{ $sembako->name }} - {{ $sembako->amount }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="mb-3">
                            <label for="category">Kategori:</label>
                            <input type="text" class="form-control" id="category" name="category_id" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exp_date">Kadaluarsa:</label>
                            <input type="text" class="form-control" id="exp_date" name="exp_date" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="amountInput">Jumlah:</label>
                            <input type="number" class="form-control" id="amountInput" name="amount" min=1 max="{{ $sembako->amount }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- ... (your existing code) ... -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Saat nilai dropdown berubah
        $('#sembakoSelect').on('change', function () {
            // Ambil nilai kategori dan tanggal kadaluarsa dari atribut data
            var selectedCategory = $('option:selected', this).data('category');
            var selectedExpDate = $('option:selected', this).data('exp-date');
            
            // Set nilai kategori dan tanggal kadaluarsa pada input
            $('#category').val(selectedCategory);
            $('#exp_date').val(selectedExpDate);
        });
    });
</script>

<!-- ... (your existing code) ... -->

</div>

@endsection