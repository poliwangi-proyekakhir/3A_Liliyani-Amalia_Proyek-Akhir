<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Klinik Pratama - Antrian Pasien</title>

  <!-- Fonts -->
  <link rel="icon" href="{{ asset('icons/ic_rs.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Styles -->


  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  {{-- <style>
    .hilang{
      transition:ease-in-out 0.4s;
      opacity: 0;
    }

    .hilang:hover{
      transition:ease-in-out 0.4s;
      opacity: 1;
    }
  </style> --}}
</head>

<body>
  {{-- <div class="home-nav" >
    <div class="dropdown hilang">
      <div class="dropdown-container" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('icons/user-solid.svg') }}" class="welcome-icon" />
      </div>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li><a href="{{ route('user.register.view') }}" class="dropdown-item" type="button">Register Petugas</a></li>
        <li><a href="{{ route('user.login.view') }}" class="dropdown-item" type="button">Login</a></li>
      </ul>
    </div>
  </div> --}}

  

  <div class="container" style="padding-top: 50px">
    <div class="card">
      <div class="card-header" style="background-color: rgb(78, 201, 191);">
       <p style="color: white"><b> Alur Pendaftaran Pemeriksaan</b></p>
      </div>
      <div class="card-body">
        <div class="box">
          <div class="row contentForm d-flex align-items-center justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-5">
              <div class="home-antrian">
                <div class="antrian">
                  <div class="nomor mb-3">
                    <h3>NOMOR URUT PEMERIKSAAN POLI UMUM</h3>
                    <p>{{ $antrian_sekarang_umum->nomor_antrian ?? 'Antrian Kosong' }}</p>
                  </div>
                  <div class="nomor">
                    <h3>NOMOR URUT PEMERIKSAAN POLI GIGI</h3>
                    <p>{{ $antrian_sekarang_gigi->nomor_antrian ?? 'Antrian Kosong' }}</p>
                  </div>
                  <a href="{{ route('pendaftaran.status') }}" class="btn1" style="margin-top: 20px">Daftar Antrian</a>
                </div>
              </div>
    
            </div>
            <div class="col-sm-12 col-md-6 col-lg-7">
              <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                  <img src="{{ asset('icons/tatacara.png') }}" style="width: 350px;">
                </div>
                <div class="col-sm-12 d-flex justify-content-center">
                  <p><a class="btn1" style="margin-top: 20px; width: 300px; border-radius: 100px; font-size:16px">Alur Pendaftaran Pemeriksaan</a></p>
                </div>
                  <div class="col-sm-12 d-flex justify-content-center">
                  <img src="{{ asset('icons/ketentuan.png') }}" style="width: 550px; margin-top:20px; margin-bottom:20px">
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
          </div>


          <div class="container" style="padding-top: 55px">
            <div class="card">
              <div class="card-header" style="background-color: rgb(78, 201, 191);">
               <p style="color: white"><b> Jadwal Dokter</b></p>
              </div>
              <div class="card-body">
                <div class="box">
                  <div class="row contentForm d-flex align-items-center justify-content-center">
        
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      @if (count($jadwals) == 0)
                          <h1 style="text-align: center; font-size: 18px;">Tidak ada jadwal dokter</h1>
                      @else
                          <table class="table table-borderless">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama Dokter</th>
                                      <th>Poli</th>
                                      <th>Jadwal Buka</th>
                                      <th>Jadwal Tutup</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @php
                                      $i = 0;
                                  @endphp
                                  @foreach ($jadwals as $jadwal)
                                      <tr>
                                          <th scope="row">{{ ++$i }}</th>
                                          <td>{{ $jadwal->nama_dokter }}</td>
                                          <td>{{ $jadwal->poliklinik }}</td>
                                          <td>{{ $jadwal->jadwal_buka }}</td>
                                          <td>{{ $jadwal->jadwal_tutup }}</td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
                  </div>


        </div>
      </div>
    </div>



  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
