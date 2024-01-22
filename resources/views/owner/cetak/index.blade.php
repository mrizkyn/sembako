<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Sembako Masuk</title>
    <style>
        body {
            text-align: center; /* Agar teks berada di tengah secara horizontal */
        }

        .form-group {
            display: inline-block; /* Membuat div ini menjadi inline block agar bisa di-center */
        }

        table.static {
            border-collapse: collapse;
            width: 95%;
            margin: 0 auto; /* Membuat tabel berada di tengah secara horizontal */
        }

        table.static, th, td {
            border: 1px solid #543535;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2; /* Warna latar belakang untuk header */
        }
    </style>
</head>
<body>
    <div class="form-group">
        <p><b>Laporan Data Sembako Masuk</b></p>
        <table class="static">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Masuk</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Tanggal Kadaluarsa</th>
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

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
