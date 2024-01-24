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
                        <th>Satuan</th>
                        <th>Tanggal Kadaluarsa</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($sembakokeluar as $sk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sk->Sembakomasuk->date }}</td>
                            <td>{{ $sk->out_date }}</td>
                            <td>{{ $sk-->Sembakomasuk->name }}</td>
                            <td>{{ $sk->Category->category_name }}</td>
                            <td>{{ $sk->amount }}</td>
                            <td>{{ $sk->Unit->unit_name }}</td> 
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
                            <select id="sembakoSelect" class="form-control select2">
                                @foreach ($sembakomasuk as $sembako)
                                    <option value="{{ $sembako->id }}">{{ $sembako->name }} - {{ $sembako->amount }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="sembakoSelect">tangg:</label>
                            <select id="sembakoSelect" class="form-control select2">
                                @foreach ($sembakomasuk as $sembako)
                                    <option value="{{ $sembako->id }}">{{ $sembako->name }} - {{ $sembako->amount }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="sembakoSelect">Pilih Barang Sembako:</label>
                            <select id="sembakoSelect" class="form-control select2">
                                @foreach ($sembakomasuk as $sembako)
                                    <option value="{{ $sembako->id }}">{{ $sembako->name }} - {{ $sembako->amount }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="sembakoSelect">Pilih Barang Sembako:</label>
                            <select id="sembakoSelect" class="form-control select2">
                                @foreach ($sembakomasuk as $sembako)
                                    <option value="{{ $sembako->id }}">{{ $sembako->name }} - {{ $sembako->amount }}</option>
                                @endforeach
                            </select>
                        </div> 
                    
                        <div class="form-group">
                            <label for="amountInput">Jumlah:</label>
                            <input type="number" class="form-control" id="amountInput" name="amount">
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
<script>
    $(document).ready(function () {
        // Initialize DataTable and Select2
        $('#accountsTable').DataTable();
        $('.select2').select2();

        // Show modal when the "Keluarkan Sembako" button is clicked
        $('.btn-warning').on('click', function () {
            $('#keluarModal').modal('show');
        });

        // Populate the dropdown dynamically (you may need to fetch data from the server)
        var $sembakoSelect = $('#sembakoSelect');
        var sembakoData = {!! json_encode($sembakomasuk) !!}; // Assuming you passed $sembakomasuks from the controller
        sembakoData.forEach(function (item) {
            $sembakoSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
        });

        // Handle form submission
        $('#keluarForm').submit(function (e) {
            e.preventDefault();

            var sembakoId = $sembakoSelect.val();
            var amount = $('#amountInput').val();
            var outDate = $('#outDateInput').val(); // Assuming you have an input for the date

            // Validate the amount and date
            if (amount <= 0 || !outDate) {
                alert('Harap lengkapi semua kolom.');
                return;
            }

            // Find the selected sembako in the data
            var selectedSembako = sembakoData.find(function (item) {
                return item.id == sembakoId;
            });

            // Validate if the amount is not greater than the available amount
            if (amount > selectedSembako.amount) {
                alert('Jumlah melebihi stok yang ada.');
                return;
            }

            // Add CSRF token and other form fields to the form data
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('sembako_id', sembakoId);
            formData.append('amount', amount);
            formData.append('outDate', outDate);
            formData.append('category_id', selectedSembako.category_id);
            formData.append('unit_id', selectedSembako.unit_id);

            // You can now handle the submission using AJAX
            $.ajax({
                url: '{{ route('sembako-keluar.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle the success response, e.g., display a message or refresh the page
                    console.log(response);
                    $('#keluarModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Handle the error response, e.g., display an error message
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<!-- ... (your existing code) ... -->

</div>

@endsection