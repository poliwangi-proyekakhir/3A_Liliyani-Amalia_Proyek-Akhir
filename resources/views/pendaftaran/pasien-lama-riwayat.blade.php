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
        <p style="text-align: center; font-weight: bold; font-size: 25px; margin-bottom: 20px">Riwayat
          Pasien Lama</p>
          
        @foreach($riwayat as $data)
          <div class="card mb-2">
            <div class="card-body">
                <div class="row d-flex align-items-center">
                  <div class="col-1">
                    {{ $loop->iteration }}
                  </div>
                  <div class="col-7">
                  <p>Poliklinik : {{ $data->poliklinik }}</p>
                  <p>Keluhan : {{ $data->keluhan .'( '. $data->kehadiran.' )' }}</p>
                  </div>
                  <div class="col-4">
                    <p> {{ \Carbon\Carbon::parse($data->jadwal)->format('d-M-Y') }}</p>
                  </div>
                </div>
            </div>
        </div>
        @endforeach

        <form method="POST" action="{{ route('pendaftaran.cari') }}">
          @csrf
                  <input type="hidden" name="nik" value="{{ $pasien_lama[0]->nik }}" >

          <div class="row mb-3">
              <div class="col">
                  <button type="submit" style="width: 100%" class="btn1">
                      Lanjut Daftar
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
