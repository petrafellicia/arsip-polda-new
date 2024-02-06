<!DOCTYPE html>
<html>
<head>
    <title>Pilih Bulan Rekap Surat</title>
    <link rel="stylesheet" href="css/pilih-bulan.css">
</head>
<body>
<div class="container" style="font-family: Times New Roman, Times, serif;">
    <div class="bulan">
    <form action="{{ route('exportpdfkeluar') }}" method="post">
        @csrf
        <h1>Pilih Bulan untuk Rekap Surat</h1>
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            <option value="1">Januari</option>
            <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <div class="tombol">
        <button type="submit" class="generate">Generate PDF</button>
        <button type="submit" class="cancel"><a href="/daftar-surat-keluar">Cancel</button></a>
</div>
    </form>
    </div>
</div>
</body>
</html>
