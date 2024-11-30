<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }

        /* Header styling */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px 0;
        }
        .header .company-info {
            font-size: 12px;
            padding-top: 10px;
        }

        /* Tanggal cetak styling */
        .date {
            text-align: right;
            font-size: 12px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <!-- Header: Logo dan Informasi Perusahaan -->
    <div class="header">
        <!-- Logo BCA -->
        <img src="https://minang.geoparkrun.com/wp-content/uploads/2022/11/bca-logo.png" width="100px" height="100px" alt="Logo BCA">

        <!-- Informasi Perusahaan -->
        <div class="company-info">
            <p><strong>PT Bank Central Asia Tbk (BCA)</strong></p>
            <p>Jl. M.H. Thamrin No. 1, Jakarta, Indonesia</p>
            <p>Phone: (021) 1500888 | Website: www.bca.co.id</p>
        </div>
    </div>

    <!-- Tabel Data -->
    <h2 style="text-align: center;">Log Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No. VA</th>
                <th>Nama Mahasiswa</th>
                <th>Nama Instansi</th>
                <th>Jenis Tagihan</th>
                <th>Tanggal Transaksi</th>
                <th>Total Bayar</th>
                <th>Status Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $data)
                <tr>
                    <td>{{ $data['no_va'] }}</td>
                    <td>{{ $data['nama_mahasiswa'] }}</td>
                    <td>{{ $data['nama_instansi'] }}</td>
                    <td>{{ $data['jenis_tagihan'] }}</td>
                    <td>{{ $data['tanggal_transaksi'] }}</td>
                    <td>{{ $data['total_bayar'] }}</td>
                    <td>{{ $data['status_transaksi'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanggal Cetak -->
    <div class="date">
        <p><strong>Tanggal Cetak: </strong>{{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>
</body>
</html>
