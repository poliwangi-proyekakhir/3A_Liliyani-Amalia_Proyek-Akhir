@extends('layouts.app')

@section('title')
    <title>
        Tambah - Poliklinik
    </title>
@endsection

@section('content')
    <div class="poliklinik">
        <div>
            <a href="{{ route('poli.index') }}">
                <img class="ic-back" src="{{ asset('icons/arrow-left.svg') }}" style="color: red;">
            </a>
        </div>

        <div class="card">
            <div class="table-header" style="text-align: end">
                <h2 style="font-size: 22px; font-weight: bold;">Tambah Poliklinik</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('poli.create.save') }}" method="POST" class="form-poli">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">
                        <div class="col">
                            <input id="poliklinik" type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" value="{{ old('poliklinik') }}" placeholder="Nama Poliklinik" required
                                autocomplete="poliklinik">

                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Nama poliklinik sudah ada</strong>
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
