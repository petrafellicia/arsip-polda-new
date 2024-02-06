<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        @page {
            size: landscape;
        }
    </style>
</head>

<body>
    <div class="form-group" style="font-size:14px;">
        <p align="center"><b>Laporan Surat Keluar Bulan {{ date('F', mktime(0, 0, 0, $bulan, 1)) }}</b></p>
        <table id="customers">
            <tr>
                <th>No</th>
                <th>Nomor Agenda</th>
                <th>Nomor Surat</th>
                <th>Jenis Surat</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th>Dasar Pembuatan Surat</th>
                <th>Tanggal dan Jam Diterima Surat</th>
                <th>Penerima</th>
                <th>Feedback</th>
            </tr>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td scope="row">{{ $row->no_agenda }}</td>
                <td>{{ $row->no_surat }}</td>
                <td>{{ $row->surattypes->nama }}</td>
                <td>{{ $row->pengirim }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->dasar_surat }}</td>
                <td>{{ date('d-m-Y H:i', strtotime($row->tgl_surat.' '.$row->jam_surat)) }}</td>
                <td>{{ $row->penerima }}</td>
                <td>{{ $row->feedback }}</td>
            </tr>
            @endforeach

        </table>
    </div>
</body>

</html>