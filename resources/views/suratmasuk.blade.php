@extends('layouts.main')

@section('container')
<h1 style="font-family: Times New Roman, Times, serif; padding-top:3rem;">Daftar Surat Masuk</h1>
<hr>
</hr>
<div class="container-fluid mb-3">
    <div class="row mx-auto mb-3">
        <div class="col">
            <a href="/mails" class="btn btn-primary" style="font-family: Times New Roman, Times, serif;">Back to
                Mails</a>
        </div>
        <div class="col text-right">
            <a href="/masuk" class="btn btn-primary" style="font-family: Times New Roman, Times, serif;">Tambah
                Surat</a>
        </div>
    </div>
    <form action="/daftar-surat-masuk/search" method="GET" class="d-flex flex-wrap justify-content-between mx-auto"
        style="gap:1.25rem" role="search">
        <div class="col-auto align-items-center">
            <a href="/pilih-bulan-masuk" class="btn btn-info" style="font-family: Times New Roman, Times, serif;">Rekap
                Surat</a>
            <!-- <button button id="rekapButton" class="btn btn-info" style="margin-bottom: 1rem; margin-right:45rem;">Rekap Surat</button> -->
        </div>
        <div class="col-auto d-flex align-items-center">
            <input class="form-control me-2" name="search" type="search" value="{{ request('search') }}"
                placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>
</div>
@if (!empty($pesan))
<p>{{ $pesan }}</p>
@elseif (!empty($data))
<div class="table-responsive d-flex">
    <table class="table" id="datatable"
        style="text-align:center; font-size:14px; font-family: Times New Roman, Times, serif; ">
        <thead>
            <tr style="text-wrap:nowrap;">
                <th scope="col">Nomor Agenda</th>
                <th scope="col">Nomor Surat</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Perihal</th>
                <th scope="col">KKA</th>
                <th scope="col">Tanggal Surat</th>
                <th scope="col">Jam Diterima </th>
                <th scope="col">Disposisi</th>
                <th scope="col">Penerima</th>
                <th scope="col">Isi Disposisi</th>
                <th scope="col">Keterangan</th>
                <th scope="col">File</th>
                <th scope="col">Aksi</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($data as $row)
            <tr>
                <th scope="row">{{ $row->nomor_agenda }}</th>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ $row->jenis_surat()->first()->nama }}</td>
                <td>{{ $row->asal_surat()->first()->nama_pengirim }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->kka()->first()->nama }}</td>
                <td>{{ date('d-m-Y', strtotime($row->tanggal_surat)) }}</td>
                <td>{{ $row->jam_surat }}</td>
                <td>{{ $row->disposisi_kepada }}</td>
                <td>{{ $row->penerima()->first()->nama_unit }}</td>
                <td>{{ $row->isi_disposisi }}</td>
                <td>{{ $row->keterangan }}</td>
                <td>
                    <a href="dokumensuratmasuk/{{ $row->file_name }}" class="btn btn-success"
                        style="font-size: 13px; font-family: Times New Roman, Times, serif;">Download</a>
                </td>
                <td scope="row"><a href="/tampilkandatamasuk/{{ $row->id }}" class="btn btn-primary"
                        style="font-size: 13px; font-family: Times New Roman, Times, serif;">Edit</td>
                <td scope="row">
                    <a href="#" class="btn btn-danger delete-button" data-id="{{ $row->id }}"
                        style="font-size: 13px; font-family: Times New Roman, Times, serif;">Delete</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@include('sweetalert::alert')
<!-- Masukkan ini di dalam bagian <head> atau sebelum penutup </body> -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var deleteButtons = document.querySelectorAll(".delete-button");

        deleteButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                var confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
                if (confirmDelete) {
                    var dataId = this.getAttribute("data-id");
                    window.location.href = '/deletemasuk/' +
                        dataId; // Ganti dengan URL delete yang sesuai
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            pageLength: 5
        });
    });
</script>
@endsection

<!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var rekapButton = document.getElementById("rekapButton");
            var card = document.getElementById("card");

            rekapButton.addEventListener("click", function() {
                card.style.display = "block";
            });
        });
    </script>
    <style>
        .card {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }
    </style>
    <div id="card" class="card">
        <h4>Pilih Bulan untuk Rekap Surat</h4>
        <form action="{{ route('exportpdfmasuk') }}" method="post">
            @csrf
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
                            <button type="submit" class="btn btn-primary">Generate PDF</button>
        </form>
    </div> -->