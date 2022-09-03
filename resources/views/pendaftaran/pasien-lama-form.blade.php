<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Pendaftaran Pasien Lama</title>

  <!-- Fonts -->
  <link rel="icon" href="{{ asset('icons/ic_rs.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Styles -->


  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
  @include('sweetalert::alert')

  <div class="login-container">
    <div class="left">
      <div class="content">
        <img src="{{ asset('icons/ic_rs.png') }}" style="width: 200px; margin-bottom: 20px;" alt="logo">
        <div class="title">
          <h2 style="font-weight: bold">Klinik Pratama</h2>
          <h2>Dr. Didik Sulasmono</h2>
        </div>
      </div>
    </div>
    <div class="pasien_baru">
      <div class="form-register">
        <a href="{{ route('pendaftaran.lama') }}">
          <img class="ic-back" src="{{ asset('icons/arrow-left.svg') }}" style="color: red;">
        </a>
        <p style="text-align: center; font-weight: bold; font-size: 25px; margin-bottom: 20px">Pendaftaran
          Pasien Lama</p>
        <form method="POST" action="{{ route('pendaftaran.save') }}">
          @csrf

          {{-- <div class="row mb-3">
            <div class="col">
              <input id="nik" type="nik" class="form-control @error('nik') is-invalid @enderror"
                name="nik" maxlength="16" minlength="16" value={{ $pasien_lama[0]->nik }} placeholder="Nik" autocomplete="nik">

              @error('nik')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> --}}

          <div class="row mb-3">
            <div class="col">
              <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                name="email" required autocomplete="email" value={{ $pasien_lama[0]->email }} placeholder="Email">

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                name="nama" required autocomplete="nama" value={{ $pasien_lama[0]->name }} placeholder="Nama">

              @error('nama')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          {{-- <div class="row mb-3">
            <div class="col">
              <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                name="tempat_lahir" required autocomplete="tempat_lahir" value={{ $pasien_lama[0]->tempat_lahir }}
                placeholder="Tempat Lahir">

              @error('tempat_lahir')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> --}}

          <input id="tipe" name="tipe" type="text" value="lama" hidden>

          {{-- <div class="row mb-3">
            <div class="col">
              <input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                placeholder="Tanggal Lahir" name="tanggal_lahir" onfocusin="(this.type='date')" style="cursor: pointer;"
                onfocusout="(this.type='text')" value={{ $pasien_lama[0]->tanggal_lahir }} />
              @error('tanggal_lahir')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> --}}


          <div class="row mb-3">
            <div class="col">
              <input id="alamat" type='text' class="form-control @error('alamat') is-invalid @enderror"
                name="alamat" required autocomplete="alamat" value={{ $pasien_lama[0]->alamat }} placeholder="Alamat">

              @error('alamat')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <input id="whatsapp" type='text' class="form-control @error('whatsapp') is-invalid @enderror"
                name="whatsapp" required autocomplete="whatsapp" value={{ $pasien_lama[0]->phone }}
                placeholder="Nomor Whatsapp">

              @error('whatsapp')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <select id="poli" class="form-select" name="poliklinik_id" aria-label="Default select example">
                <option selected>Pilih Poliklinik</option>
                @foreach ($polikliniks as $poliklinik)
                  <option value="{{ $poliklinik->id }}">{{ $poliklinik->nama }}
                  </option>
                @endforeach
              </select>

              {{-- @foreach ($polikliniks as $poliklinik)
                                <form id="cari_dokter{{$poliklinik->id}}" action="{{ route('poli.delete', $poliklinik->id) }}"
                                    method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach --}}

              @error('poliklinik_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror


            </div>
          </div>


          {{-- <div class="row mb-3">
            <div class="col">
              <select id="dokter" class="form-select" name="dokter_id" aria-label="Default select example">
                <option selected>Pilih Dokter</option>
                @foreach ($dokters as $dokter)
                  <option data-poli={{ $dokter->id_poli }} onclick="" value="{{ $dokter->dokter_id }}">Dr.
                    {{ $dokter->nama_dokter }}, {{ $dokter->jadwal_buka }} - {{ $dokter->jadwal_tutup }}, Poli
                    {{ $dokter->nama_poli }}
                  </option>
                @endforeach
              </select>

              @error('dokter_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> --}}

          <div class="row mb-3">
            <div class="col">
              <input type="text" class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror"
                placeholder="Pilih Tanggal" name="tanggal_pemeriksaan" onfocusin="(this.type='date')"
                style="cursor: pointer;" onfocusout="(this.type='text')" />
              @error('tanggal_pemeriksaan')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>


          <div class="row mb-3">
            <div class="col">
              <input id="keluhan" type='text' class="form-control @error('keluhan') is-invalid @enderror"
                name="keluhan" required autocomplete="keluhan" placeholder="Keluhan">

              @error('keluhan')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>


          <div class="row mb-0">
            <div class="col">
              <button type="submit" class="btn1">
                Daftar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script>
      $('#poli').on('change', function(e) {
      let selector = $(this).val();
      $("#dokter > option").hide();
      $("#dokter > option").filter(function(){return $(this).data('poli') == selector}).show();
});
    </script>

  </body>

</html>
