@extends('layouts.app')

@section('title')
    <title>
        Edit - Jadwal
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
                <h2 style="font-size: 22px; font-weight: bold;">Edit Jadwal Dokter</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('jadwal.edit.save', $user->id) }}" method="POST" class="form-poli">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">
                        <div class="col">
                            <label for="dokter" class="label-form">Nama Dokter</label>
                            <input id="dokter" type="text" class="form-control @error('dokter') is-invalid @enderror"
                                name="dokter" value="{{ $user->name }}" autocomplete="dokter">

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
                                @foreach ($polikliniks as $poliklinik)
                                    @if ($poliklinik->id === $user->dokterPolikliniks()->get()[0]->id)
                                        <option value="{{ $poliklinik->id }}" selected>{{ $poliklinik->nama }}</option>
                                    @elseif($poliklinik->id !== $user->dokterPolikliniks()->get()[0]->id)
                                        <option value="{{ $poliklinik->id }}">{{ $poliklinik->nama }}</option>
                                    @endif
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
                        <button style="margin-left: auto" class="btn1" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
