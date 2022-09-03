@extends('layouts.app')

@section('title')
  <title>
    Update Antrian
  </title>
@endsection

@section('content')
  <div class="dashboard">
    <div class="antrian_content">
      <div class="">
        <form id="tidak-hadir" action="{{ route('antrian.tidakhadir',  $antrian_sekarang_umum->id_antrian ?? 0) }}"
          method="POST">
          @csrf
          @method('POST')
        </form>
        <button style="padding: 10px; background-color:#02C0B0; color:#fff; border: 0; cursor: pointer; border-radius:10px"
          onclick="document.getElementById('tidak-hadir').submit()">
          {{-- <img style="width: 80px" src="{{ asset('icons/ic_minus.svg') }}"> --}}
          TIDAK HADIR
        </button>
      </div>
      <div class="antrian" style="width: 300px; margin: 0 24px;">
        <div class="nomor">
          <h3>Update Nomor Urut Poli Umum</h3>
          <p style="font-size: 24px;">{{ $antrian_sekarang_umum->nomor_antrian ?? 'Tidak Ada Antrian' }}</p>
        </div>
      </div>
      {{-- @php
          echo $antrian_sekarang->id_antrian;
      @endphp --}}
      <div class="">
        <form id="hadir" action="{{ route('antrian.hadir', $antrian_sekarang_umum->id_antrian ?? 0) }}" method="POST">
          @csrf
          @method('POST')
        </form>
        <button style="padding: 10px; background-color:#02C0B0; color:#fff; border: 0; cursor: pointer; border-radius:10px"
          onclick="document.getElementById('hadir').submit()">
          {{-- <img style="width: 80px" src="{{ asset('icons/ic_plus.svg') }}"> --}}
          HADIR
        </button>
      </div>
    </div>
  </div>

  <div class="dashboard">
    <div class="antrian_content">
      <div class="">
        <form id="tidak-hadir" action="{{ route('antrian.tidakhadir',  $antrian_sekarang_gigi->id_antrian ?? 0) }}"
          method="POST">
          @csrf
          @method('POST')
        </form>
        <button style="padding: 10px; background-color:#02C0B0; color:#fff; border: 0; cursor: pointer; border-radius:10px"
          onclick="document.getElementById('tidak-hadir').submit()">
          {{-- <img style="width: 80px" src="{{ asset('icons/ic_minus.svg') }}"> --}}
          TIDAK HADIR
        </button>
      </div>
      <div class="antrian" style="width: 300px; margin: 0 24px;">
        <div class="nomor">
          <h3>Update Nomor Urut Poli Gigi</h3>
          <p style="font-size: 24px;">{{ $antrian_sekarang_gigi->nomor_antrian ?? 'Tidak Ada Antrian' }}</p>
        </div>
      </div>
      {{-- @php
          echo $antrian_sekarang->id_antrian;
      @endphp --}}
      <div class="">
        <form id="hadir" action="{{ route('antrian.hadir', $antrian_sekarang_gigi->id_antrian ?? 0) }}" method="POST">
          @csrf
          @method('POST')
        </form>
        <button style="padding: 10px; background-color:#02C0B0; color:#fff; border: 0; cursor: pointer; border-radius:10px"
          onclick="document.getElementById('hadir').submit()">
          {{-- <img style="width: 80px" src="{{ asset('icons/ic_plus.svg') }}"> --}}
          HADIR
        </button>
      </div>
    </div>
  </div>
@endsection
