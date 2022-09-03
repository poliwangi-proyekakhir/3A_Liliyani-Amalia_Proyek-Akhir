<nav class="sidebar">
    <div class="profile">
        <a href="{{ route('user.profil.view') }}">
            <img src={{ Auth::user()->photo ? asset('images/' . Auth::user()->photo) : asset('icons/user-white.svg') }} alt="">
        </a>
        <div class="name">
            @php
                
            @endphp
            <h2 style="font-size: 20px;">{{Auth::user()->name}}</h2>
            <p style="opacity: 0.9">Petugas</p>
        </div>
    </div>
    <hr style="color: white">
    <div class="navigation">
        <ul>
            <li class="{{ Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : '' }}">
                <img src="{{ asset('icons/ic_house.svg') }}" alt="">
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="{{ Request::is('poli') || Request::is('poli/*') ? 'active' : '' }}">
                <img src="{{ asset('icons/ic_book.svg') }}" alt="">
                <a href="{{ route('poli.index') }}">Input Nama Poli</a>
            </li>
            <li class="{{ Request::is('jadwal') || Request::is('jadwal/*') ? 'active' : '' }}">
                <img src="{{ asset('icons/ic_calendar.svg') }}" alt="">
                <a href="{{ route('jadwal.index') }}">Input Jadwal Dokter</a>
            </li>
            <li class="{{ Request::is('pasien') || Request::is('pasien/*') ? 'active' : '' }}">
                <img src="{{ asset('icons/ic_chart.svg') }}" alt="">
                <a href="{{ route('pasien.index') }}">Lihat Data Pasien</a>
            </li>
            <li class="{{ Request::is('antrian') || Request::is('antrian/*') ? 'active' : '' }}">
                <img src="{{ asset('icons/ic_check.svg') }}" alt="">
                <a href="{{ route('antrian.index') }}">Update Nomor Antrian</a>
            </li>
        </ul>
    </div>
</nav>