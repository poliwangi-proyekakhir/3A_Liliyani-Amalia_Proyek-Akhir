@extends('layouts.app')

@section('title')
    <title>
        Jadwal Dokter
    </title>
@endsection

@section('content')
    <div class="poliklinik">
        <div class="card">
            <div class="table-header" style="text-align: end">
                <h2 style="font-size: 22px; font-weight: bold;">Jadwal Dokter</h2>
                <a href="{{ route('jadwal.create.view') }}" class="btn1">Tambah</a>
            </div>
            <br style="background-color: black;">
            <div class="card-body">
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
                                <th>Keterangan</th>
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
                                    <td>
                                        <a href="{{ route('jadwal.edit.view', $jadwal->dokter_id) }}" class="btn3">Ubah</a>
                                        <a class="btn4" data-bs-toggle="modal" data-bs-target="#jadwalDokterModal-{{$jadwal->dokter_id}}"
                                            href="" onclick="event.preventDefault();">
                                            Hapus
                                        </a>

                                        <form id="hapus-jadwal-{{$jadwal->dokter_id}}"
                                            action="{{ route('jadwal.delete', $jadwal->dokter_id) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="jadwalDokterModal-{{$jadwal->dokter_id}}" tabindex="-1" aria-labelledby="kosModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="kosModalLabel">Hapus Jadwal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Hapus sekarang?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn1"
                                                    onclick="document.getElementById('hapus-jadwal-{{$jadwal->dokter_id}}').submit();">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
