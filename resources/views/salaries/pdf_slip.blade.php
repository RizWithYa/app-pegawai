<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; font-size: 12px; }
        
        .details-table { width: 100%; margin-bottom: 20px; font-size: 14px; }
        .details-table td { padding: 5px; }
        
        .salary-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .salary-table th, .salary-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .salary-table th { background-color: #f2f2f2; }
        
        .total-row { font-weight: bold; background-color: #e6e6e6; }
        .footer { margin-top: 50px; text-align: right; font-size: 12px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>PT. APLIKASI PEGAWAI LANTARA</h2>
        <p>Jl. Raya ITS, Surabaya</p>
        <h3>SLIP GAJI KARYAWAN</h3>
    </div>

    <table class="details-table">
        <tr>
            <td width="20%"><strong>Nama</strong></td>
            <td>: {{ $salary->employee->nama_lengkap }}</td>
            <td width="20%"><strong>Periode</strong></td>
            <td>: {{ $salary->bulan }}</td>
        </tr>
        <tr>
            <td><strong>Jabatan</strong></td>
            <td>: {{ $salary->employee->position->nama_jabatan }}</td>
            <td><strong>Departemen</strong></td>
            <td>: {{ $salary->employee->department->nama_departemen }}</td>
        </tr>
    </table>

    <table class="salary-table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th style="text-align: right;">Jumlah (IDR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td style="text-align: right;">{{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td style="text-align: right;">{{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="color: red;">Potongan</td>
                <td style="text-align: right; color: red;">- {{ number_format($salary->potongan, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>TOTAL DITERIMA</td>
                <td style="text-align: right;">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
        <br><br><br>
        <p>( __________________________ )</p>
        <p>Bagian Keuangan</p>
    </div>

</body>
</html>