@extends('layouts.main')

@section('container')
<h1 style="font-family: Times New Roman, Times, serif; padding-top:3rem;">Daftar Surat Keluar</h1>
<hr>
</hr>
<div class="container-fluid mb-3">
    <div class="row mx-auto mb-3">
        <div class="col">
            <a href="/mails" class="btn btn-primary" style="font-family: Times New Roman, Times, serif;">Back to
                Mails</a>
        </div>
        <div class="col text-right">
            <a href="/keluar" class="btn btn-primary" style="font-family: Times New Roman, Times, serif;">Tambah
                Surat</a>
        </div>
    </div>
    <form action="/daftar-surat-keluar/search" method="GET" class="d-flex flex-wrap justify-content-between mx-auto"
        style="gap:1.25rem" role="search">
        <div class="col-auto align-items-center">
            <a href="/pilih-bulan-keluar" class="btn btn-info" style="font-family: Times New Roman, Times, serif;">Rekap
                Surat</a>
        </div>
        <div class="col-auto d-flex align-items-center">
            <input class="form-control me-2" name="search" type="search" value="{{ request('search') }}"
                placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>
</div>

<!-- <div class="container-fluid">
    <a href="/mails" style="font-family: Times New Roman, Times, serif;">Back to Mails</a>
    <button type="button"
        style=" float:right; width:150px; height:40px; border-radius:26.5px; --bs-btn-padding-y: .50rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; border:none; outline:none; padding:8px; cursor:pointer; background:#216588;">
        <a style="color:white; justify-content:center; text-decoration:none; font-family: Times New Roman, Times, serif;"
            href="/keluar">Tambah Surat</a></button>
    <form action="/daftar-surat-keluar/search" method="GET" class="d-flex justify-content-end"
        style="margin-top:30px; margin-bottom:10px;" role="search">
        <div class="col-auto">
            <a href="/pilih-bulan-keluar" class="btn btn-info"
                style="margin-bottom:1rem; margin-right:45rem; font-family: Times New Roman, Times, serif;">Rekap
                Surat</a>
        </div>
        <input class="form-control w-25 me-2" name="search" type="search" value="{{ request('search') }}"
            placeholder="Search" aria-label="Search" style="font-family: Times New Roman, Times, serif;">
        <button class="btn btn-outline-success" type="submit"
            style="margin-bottom:1rem; font-size:14px; font-family: Times New Roman, Times, serif;">Search</button>

    </form>
</div> -->

@if (!empty($message))
<p>{{ $message }}</p>
@elseif (!empty($data))
<div class="table-responsive d-flex">
    <table class="table" id="datatable"
        style="text-align:center; font-size:14px; font-family: Times New Roman, Times, serif;">
        <thead>
            <tr style="text-wrap:nowrap;">
                <th scope="col">Nomor Agenda</th>
                <th scope="col">Nomor Surat</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Perihal</th>
                <th scope="col">KKA</th>
                <th scope="col">Dasar Pembuatan Surat</th>
                <th scope="col">Tanggal Surat</th>
                <th scope="col">Jam Diterima</th>
                <!-- <th scope="col">Disposisi kepada</th> -->
                <th scope="col">Penerima</th>
                <!-- <th scope="col">Isi Disposisi</th> -->
                <th scope="col">Feedback</th>
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
                <td>{{ $row->pengirim()->first()->nama_unit }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->kka()->first()->nama }}</td>
                <td>{{ $row->dasar_surat }}</td>
                <td>{{ date('d-m-Y', strtotime($row->tanggal_surat)) }}</td>
                <td>{{ $row->jam_surat }}</td>
                <!-- <td>{{ $row->disposisi }}</td> -->
                <td>{{ $row->penerima()->first()->nama_tujuan }}</td>
                <!-- <td>{{ $row->isi_disposisi }}</td> -->
                <td>{{ $row->feedback }}</td>
                <td>
                    <a href="dokumensuratkeluar/{{ $row->file_name }}" class="btn btn-success"
                        style="font-size: 13px;">Download</a>
                </td>
                <td><a href="/tampilkandatakeluar/{{ $row->id }}" class="btn btn-primary"
                        style="font-size: 13px;">Edit</button></td>
                <td scope="row">
                    <a href="#" class="btn btn-danger delete-button" data-id="{{ $row->id }}"
                        style="font-size: 13px">Delete</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <!-- {{ $data->links() }} -->
</div>
@include('sweetalert::alert')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var deleteButtons = document.querySelectorAll(".delete-button");

        deleteButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                var confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
                if (confirmDelete) {
                    var dataId = this.getAttribute("data-id");
                    window.location.href = '/deletekeluar/' +
                        dataId; // Ganti dengan URL delete yang sesuai
                }
            });
        });
    });
</script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            pageLength: 5
        });
    });
</script>
@endsection