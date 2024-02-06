<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip-Polda | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <h2 class="text-center" style="font-family: Times New Roman, Times, serif;">Input Data Surat Masuk</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body" style="font-family: Times New Roman, Times, serif">
                        <form action="/insertsurat" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nomor_agenda" class="form-label">Nomor Agenda</label>
                                <input type="text" id="nomor_agenda" name="nomor_agenda" class="form-control
               @error('nomor_agenda') is-ivalid @enderror" value="{{ old('nomor_agenda') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" id="nomor_surat" name="nomor_surat" class="form-control
              @error('nomor_agenda') is-ivalid @enderror" value="{{ old('nomor_agenda') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                <select class="form-select  @error('jenis_surat') is-ivalid @enderror"
                                    value="{{ old('jenis_surat') }}" name="jenis_surat"
                                    aria-label="Default select example" required>
                                    <option selected>Pilih Jenis Surat</option>
                                    @foreach ($jenis_surat as $key => $value)
                                        <option>{{ $value->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pengirim_id" class="form-label">Pengirim</label>
                                <input type="text" name="pengirim_id" class="form-control"
                                    id="pengirim_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_unit">Nama Unit</label>
                                <select class="form-select  @error('nama_unit') is-ivalid @enderror"
                                    value="{{ old('nama_unit') }}" name="nama_unit"
                                    aria-label="Default select example" required>
                                    <option selected>Pilih Unit</option>
                                    @foreach ($unit_penerima as $key => $value)
                                        <option>{{ $value->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <input type="text" name="perihal" class="form-control
              @error('perihal') is-ivalid @enderror" value="{{ old('perihal') }}" id="perihal">
                                <div class="mb-3">
                                    <label for="kka" class="form-label">KKA</label>
                                    <select class="form-select
              @error('kka') is-ivalid @enderror" value="{{ old('kka') }}" name="kka"
                                        aria-label="Default select example" required>
                                        <option selected>Pilih KKA</option>
                                        @foreach ($kka as $item)
                                            <option>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                    <input type="date" name="tanggal_surat" class="form-control
              @error('tanggal_surat') is-ivalid @enderror" value="{{ old('tanggal_surat') }}" id="tanggal_surat"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_terima" class="form-label">Jam Terima</label>
                                    <input type="time" name="jam_terima" class="form-control
              @error('jam_terima') is-ivalid @enderror" value="{{ old('jam_terima') }}" required>
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

                                    <input type="text" name="disposisi[]" id="other_text_input" style="display: none;">

                                </div>
                                <div class="mb-3">
                                    <label for="penerima" class="form-label">Penerima</label>
                                    <select class="form-select
              @error('penerima_id') is-ivalid @enderror" value="{{ old('penerima_id') }}" name="penerima_id"
                                        aria-label="Default select example" required>
                                        <option selected>Pilih Penerima</option>
                                        @foreach ($unit_penerima as $item)
                                            <option>{{ $item->nama_unit }}</option>
                                        @endforeach
                                        <!-- <option selected>Pilih Penerima</option> -->
                                        {{-- @foreach ($datasurat2 as $dta)
                                        <option value="{{ $dta->id }}">{{ $dta->nama_penerima }}</option>
                                        @endforeach --}}
                                        <!-- <option>Mabes POLRI</option>
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
                                        <option>Instansi Luar POLDA</option> -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="isi_disposisi" class="form-label">Isi Disposisi</label>
                                    <input type="text" name="isi_disposisi" class="form-control
               @error('isi_disposisi') is-ivalid @enderror" value="{{ old('isi_disposisi') }}" id="isi_disposisi"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control
              @error('keterangan') is-ivalid @enderror" value="{{ old('keterangan') }}" id="keterangan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Dokumen</label>
                                    <input class="form-control
              @error('file') is-ivalid @enderror" value="{{ old('file') }}" name="file" type="file" id="formFile"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        document.getElementById('other_checkbox').addEventListener('change', fun ction() {
            var otherTextInput = document.getElementById('other_text_input');
            otherTextInput.style.display = this.checked ? 'block' : 'none';
            otherTextInput.value = this.checked ? '' : '';
        }); <
            scritsrc = "https://code.jquery.com/jquery-3.7.0.slim.min.                    itgrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz / r4y                      cosorigin = "anony" >
    </script>
</body>

</html>
