<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Pendaftaran Selesai</title>

  <!-- Fonts -->
  <link rel="icon" href="{{ asset('icons/ic_rs.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Styles -->


  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
  <div class="home-nav">
    {{-- <div class="dropdown">
            <div class="dropdown-container" id="dropdownMenu2" data-bs-toggle="dropdown"
            aria-expanded="false">
                <img src="{{ asset('icons/user-solid.svg') }}" class="welcome-icon" />
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><a href="{{ route('user.register.view') }}" class="dropdown-item" type="button">Register Petugas</a></li>
                <li><a href="{{ route('user.login.view') }}" class="dropdown-item" type="button">Login</a></li>
            </ul>
        </div> --}}
  </div>

  <div class="home-antrian">
    <div class="antrian">
      <div class="nomor">
        <p>Pendaftaran Berhasil</p>
        <h4>QrCode telah dikirimkan di Whatsapp dan Email anda</h4>
        <h4>Silahkan cek folder spam pada Email</h4>
        <a href="{{ route('antrian') }}" class="btn1" style="margin-top: 20px">Kembali ke antrian</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var data = @json($data);

    var apiKey = "{{ env('RUANGWA_API_KEY') }}";
    var file = 'https://98ce-103-153-63-36.ap.ngrok.io/storage/' + data.file;
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();

    let message = data.caption + ', silakan cek Qr Code melalui link dibawah ini \n\n' + file

    console.log(file)

    var urlencoded = new URLSearchParams();
    urlencoded.append("token", apiKey);
    urlencoded.append("number", data.phone);
    urlencoded.append("file", file);
    urlencoded.append("caption", data.caption);
    // urlencoded.append("message", file);
    urlencoded.append("date", date);
    urlencoded.append("time", time);

    var requestOptions = {
      method: 'POST',
      body: urlencoded,
      redirect: 'follow'
    };

    fetch("https://app.ruangwa.id/api/send_image", requestOptions)
      .then(response => response.text())
      .then(result => console.log(result))
      .catch(error => console.log('error', error));

    // fetch("https://app.ruangwa.id/api/send_message", requestOptions)
    //   .then(response => response.text())
    //   .then(result => console.log(result))
    //   .catch(error => console.log('error', error));
  </script>
</body>

</html>
