<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Status Pasien</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('icons/ic_rs.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Styles -->


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="home-status">
        <div class="antrian">
            <div class="status">
                <h3>PASIEN BARU</h3>
            </div>
            <a href="{{route('pendaftaran.baru')}}" class="btn1" style="margin-top: 20px">Daftar Antrian</a>
        </div>
        <div class="antrian">
            <div class="status">
                <h3>PASIEN LAMA</h3>
            </div>
            <a href="{{route('pendaftaran.lama')}}" class="btn1" style="margin-top: 20px">Daftar Antrian</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
