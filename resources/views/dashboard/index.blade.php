@extends('layouts.app')

@section('title')
  <title>
    Dashboard
  </title>
@endsection

@section('content')
  <div class="dashboard">
    <div class="antrian" style="width: 300px">
      <div class="nomor">
        <h3>NOMOR URUT PEMERIKSAAN POLI UMUM</h3>
        <p style="font-size: 24px;">{{ $antrian_sekarang_umum->nomor_antrian ?? 'Tidak Ada Antrian' }}</p>
      </div>
    </div>
  </div>
  <div class="dashboard">
    <div class="antrian" style="width: 300px">
      <div class="nomor">
        <h3>NOMOR URUT PEMERIKSAAN POLI GIGI</h3>
        <p style="font-size: 24px;">{{ $antrian_sekarang_gigi->nomor_antrian ?? 'Tidak Ada Antrian' }}</p>
      </div>
    </div>
  </div>
@endsection
