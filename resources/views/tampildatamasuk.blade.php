<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Surat Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <h2 class="text-center" style="font-family: Times New Roman, Times, serif;">Edit Data Surat Masuk</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/updatedatamasuk/{{ $data->id }}" method="POST"
                            enctype="multipart/form-data">
                            <!-- <form action="{{ route('updatedatamasuk', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data"> -->
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Agenda</label>
                                <input type="text" name="nomor_agenda" value="{{ $data->nomor_agenda }}"
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor Surat</label>
                                <input type="text" name="nomor_surat" value="{{ $data->nomor_surat }}"
                                    class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Surat</label>
                                <select class="form-select" name="jenis_surat" aria-label="Default select example">
                                    <option selected>Pilih Jenis Surat</option>
                                    @foreach ($jenis_surat as $key => $value)
                                        <option @if ($value->id === $data->jenis_surat) selected @endif>{{ $value->nama }}
                                        </option>
                                    @endforeach

                                    <!-- <option >Surat Biasa</option>
                <option >Nota Dinas</option>
                <option >Telegram</option>
                <option >Sprin</option>
                <option >Surat Izin</option>
                <option >Surat Rahasia</option> -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pengirim</label>
                                <input type="text" name="pengirim_id"
                                    value="{{ $data->asal_surat()->first()->nama_pengirim }}" class="form-control"
                                    id="exampleInputPassword1">
                            </div>

                            <div class="mb-3">
                                <label for="nama_unit">Nama Unit</label>
                                <select class="form-select  @error('nama_unit') is-ivalid @enderror"
                                    value="{{ old('nama_unit') }}" name="nama_unit"
                                    aria-label="Default select example" required>
                                    <option selected>Pilih Unit</option>
                                    @foreach ($unit_penerima as $key => $value)
                                        <option @if($value->id === $data->penerima()->first()->id) selected @endif>{{ $value->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Perihal</label>
                                <input type="text" name="perihal" value="{{ $data->perihal }}" class="form-control"
                                    id="exampleInputPassword1">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">KKA</label>
                                    <select class="form-select" name="kka" aria-label="Default select example">
                                        <option selected>Pilih KKA</option>
                                        @foreach ($kka as $item)
                                            <option @if ($item->id === $data->kka) selected @endif>
                                                {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tanggal Surat</label>
                                    <input type="date" name="tanggal_surat" value="{{ $data->tanggal_surat }}"
                                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jam Terima</label>
                                    <input type="time" name="jam_terima" value="{{ $data->jam_surat }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="disposisi_kepada" class="form-label">Disposisi Kepada</label>

                                    <br>

                                    <label>
                                        <input type="checkbox" name="disposisi[]" value="Ksbd. Tekkom">
                                        Yth. Ksbd. Tekkom
                                    </label>

                                    <br>

                                    <label>
                                        <input type="checkbox" name="disposisi[]" value="Ksbd. Tekinfo">
                                        Yth. Ksbd. Tekinfo
                                    </label>

                                    <br>

                                    <label>
                                        <input type="checkbox" name="disposisi[]" value="Ksbg. Renmin">
                                        Yth. Ksbg. Renmin
                                    </label>

                                    <br>

                                    <label>
                                        <input type="checkbox" id="other_checkbox">
                                        Yth. ...
                                    </label>

                                    <input type="text" name="disposisi[]" id="other_text_input"
                                        style="display: none;">

                                </div>
                                <!-- <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Disposisi Kepada</label>
              <input type="text" name="disposisi_kepada" value="{{ $data->disposisi_kepada }}" class="form-control" id="exampleInputEmail1">
            </div> -->
                                <div class="mb-3">
                                    <label for="penerima" class="form-label">Penerima</label>
                                    <select class="form-select
              @error('penerima_id') is-ivalid @enderror"
                                        value="{{ old('penerima_id') }}" name="penerima_id"
                                        aria-label="Default select example" required>
                                        <option selected>Pilih Penerima</option>
                                        @foreach ($unit_penerima as $item)
                                            <option @if($item->id === $data->penerima) selected @endif>{{ $item->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <label for="exampleInputPassword1" class="form-label">Penerima</label>
                  <select class="form-select" name="penerima_id" aria-label="Default select example">
                    <option selected>{{ $data->receiver_name }}</option>
                    <option>Mabes POLRI</option>
                    <option>Kapolda DIY</option>
                    <option>Wakapolda DIY</option>
                    <option>Irwasda</option>
                    <option>Karo Ops</option>
                    <option>Karo Rena</option>
                    <option>Karo SDM</option>
                    <option>Karo Log</option>
                    <option>Dirintelkom</option>
                    <option>Dirreskrimum</option>
                    <option>Dirreskrimsus</option>
                    <option>Dirresnarkoba</option>
                    <option>Kabid Propam</option>
                    <option>Kabid Humas</option>
                    <option>Kabid TIK</option>
                    <option>Kabid Dokkes</option>
                    <option>Kabid Kum</option>
                    <option>Kabid Keu</option>
                    <option>Dittahti</option>
                    <option>Kayanma</option>
                    <option>Koorspripim</option>
                    <option>Karumkit Bhayangkara</option>
                    <option>KA SPKT POLDA DIY</option>
                    <option>KA SPN</option>
                    <option>Dansat Brimob</option>
                    <option>Polrestu YKA</option>
                    <option>Polrestu Sleman</option>
                    <option>Polres Bantul</option>
                    <option>Polres KLP</option>
                    <option>Polres ONK/option>
                    <option>Instansi Luar POLDA</option>
                  </select> --}}
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Isi Disposisi</label>
                                    <input type="text" name="isi_disposisi" value="{{ $data->isi_disposisi }}"
                                        class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" value="{{ $data->keterangan }}"
                                        class="form-control">
                                </div>
                                {{-- <div class="mb-3">
                  <label for="formFile" class="form-label">Upload File</label>
                  <input class="form-control" name="file" value="{{ $data->file }}" type="file" id="formFile">
                </div> --}}
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Dokumen</label>
                                    <input class="form-control" name="file" type="file" id="formFile">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="/daftar-surat-masuk" type="submit"
                                    class="btn btn-danger">Cancel</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('other_checkbox').addEventListener('change', function() {
            var otherTextInput = document.getElementById('other_text_input');
            otherTextInput.style.display = this.checked ? 'block' : 'none';
            otherTextInput.value = this.checked ? '' : '';
        });
    </script>
</body>

</html>
