<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <h2 class="text-center" style="font-family: Times New Roman, Times, serif;">Input Data Surat Keluar</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body" style="font-family: Times New Roman, Times, serif">
                        <form method="POST" action="/insertsuratkeluar" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Agenda</label>
                                <input type="text" name="no_agenda" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor Surat</label>
                                <input type="text" name="no_surat" class="form-control" id="exampleInputPassword1"
                                    required>
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
                                <label for="exampleInputPassword1" class="form-label">Pengirim</label>
                                <select class="form-select  @error('pengirim') is-ivalid @enderror"
                                    value="{{ old('pengirim') }}" name="pengirim" aria-label="Default select example"
                                    required>
                                    <option selected>Pilih Unit</option>
                                    @foreach ($datapengirim as $key => $value)
                                        <option>{{ $value->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Perihal</label>
                                <input type="text" name="perihal" class="form-control" id="exampleInputPassword1"
                                    required>
                            </div>
                            <!-- <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Perihal</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="perihal" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Majalah
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="perihal" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                  News
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="perihal" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                  Tribut
                  </label>
                </div>
              </div> -->
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
                                <label for="exampleInputPassword1" class="form-label">Dasar Pembuatan Surat</label>
                                <input type="text" name="dasar_surat" class="form-control" id="exampleInputPassword1"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Surat</label>
                                <input type="date" name="tgl_surat" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jam Terima</label>
                                <input type="time" name="jam_surat" class="form-control"
                                    id="exampleInputPassword1" required>
                            </div>
                            <!-- <div class="mb-3">
                            <label for="disposisi" class="form-label">Disposisi Kepada</label>

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

                                <br>

                            </div> -->
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Penerima</label>
                                <select class="form-select" name="penerima_id" aria-label="Default select example"
                                    required>
                                    <option selected>Pilih penerima</option>
                                    @foreach ($datapenerima as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->nama_tujuan }}</option>
                                    @endforeach
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
                            <!-- <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Isi Disposisi</label>
                                <input type="text" name="isi_disposisi" class="form-control"
                                    id="exampleInputPassword1" required>
                            </div> -->
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Feedback</label>
                                <input type="text" name="feedback" class="form-control"
                                    id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label" required>Upload Dokumen</label>
                                <input class="form-control" name="file" type="file" id="formFile" required>
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
        document.getElementById('other_checkbox').addEventListener('change', function() {
            var otherTextInput = document.getElementById('other_text_input');
            otherTextInput.style.display = this.checked ? 'block' : 'none';
            otherTextInput.value = this.checked ? '' : '';
        });
    </script>
</body>

</html>
