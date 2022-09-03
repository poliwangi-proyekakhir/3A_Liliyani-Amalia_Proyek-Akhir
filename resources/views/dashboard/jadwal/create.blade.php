@extends('layouts.app')


@section('title')
    <title>
        Tambah - Poliklinik
    </title>
@endsection

@section('content')
    <div class="poliklinik">
        <div>
            <a href="{{ route('jadwal.index') }}">
                <img class="ic-back" src="{{ asset('icons/arrow-left.svg') }}" style="color: red;">
            </a>
        </div>

        <div class="card">
            <div class="table-header" style="text-align: end">
                <h2 style="font-size: 22px; font-weight: bold;">Tambah Jadwal Dokter</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('jadwal.create.save') }}" method="POST" class="form-poli">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">
                        <div class="col">
                            <label for="dokter" class="label-form">Nama Dokter</label>
                            <input id="dokter" type="text" class="form-control @error('dokter') is-invalid @enderror"
                                name="dokter" value="{{ old('dokter') }}" autocomplete="dokter">

                            @error('dokter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="poliklinik" class="label-form">Poliklinik</label>
                            <select id="poliklinik" class="form-select @error('poliklinik') is-invalid @enderror form-width"
                                name="poliklinik" aria-label="Default select example">
                                <option value="pilih_poliklinik" selected>Pilih Poliklinik</option>
                                @foreach ($polikliniks as $poliklinik)
                                    <option value={{ $poliklinik->id }}>{{ $poliklinik->nama }}</option>
                                @endforeach

                            </select>

                            @error('poliklinik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jadwal_buka" class="label-form">Jadwal Buka</label>
                            <input id="jadwal_buka" type="datetime-local"
                                class="form-control @error('jadwal_buka') is-invalid @enderror form-width" value="{{ old('jadwal_buka') }}"
                                name="jadwal_buka" />


                            @error('jadwal_buka')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jadwal_tutup" class="label-form">Jadwal Tutup</label>
                            <input id="jadwal_tutup" type="datetime-local"
                                class="form-control @error('jadwal_tutup') is-invalid @enderror form-width" value="{{ old('jadwal_tutup') }}"
                                name="jadwal_tutup" />


                            @error('jadwal_tutup')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <button style="margin-left: auto" class="btn1" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
