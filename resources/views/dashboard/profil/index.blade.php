<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Auth::user()->name }}</title>

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
        <div class="right">
            <div class="form-register">
                <a href="{{ route('dashboard.index') }}">
                    <img class="ic-back" src="{{ asset('icons/arrow-left.svg') }}" style="color: red;">
                </a>
                <p style="text-align: center; font-weight: bold; font-size: 25px; margin-bottom: 20px">Profil</p>
                <form method="POST" action="{{ route('user.profil.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <div class="col">
                            <div style="text-align: center" class="form-image">
                                <img src={{ Auth::user()->photo ? asset('images/' . Auth::user()->photo) : asset('icons/user-solid.svg') }}
                                    style="width: 140px; border-radius: 50%;">
                                <input type="file" accept="image/jpeg,image/gif,image/png,image/x-eps" id="photo"
                                    name="photo"  style="margin-left: 10px;">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" style="font-weight: bold; margin-bottom: 4px;">Name</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" placeholder="name" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <p style="font-size: 18px; font-weight: bold; margin-top: 12px; margin-bottom: 4px;">Ganti
                            Password</p>

                        <div class="col">
                            <input id="password_lama" type="password"
                                class="form-control @error('password_lama') is-invalid @enderror" name="password_lama"
                                autocomplete="new-password" placeholder="Password Lama">

                            @error('password_lama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <input id="password_baru" type="password"
                                class="form-control @error('password_baru') is-invalid @enderror" name="password_baru"
                                autocomplete="new-password" placeholder="Password Baru">

                            @error('password_baru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col">
                            <button type="submit" class="btn1">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
