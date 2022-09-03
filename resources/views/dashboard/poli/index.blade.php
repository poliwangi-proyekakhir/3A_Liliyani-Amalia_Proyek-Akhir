@extends('layouts.app')

@section('title')
    <title>
        Poliklinik
    </title>
@endsection

@section('content')
    <div class="poliklinik">
        <div class="card">
            <div class="table-header" style="text-align: end">
                <h2 style="font-size: 22px; font-weight: bold;">Poliklinik</h2>
                <a href="{{ route('poli.create.view') }}" class="btn1">Tambah</a>
            </div>
            <br style="background-color: black;">
            <div class="card-body">
                @if (count($poliklinik) < 1)
                    <h1 style="text-align: center; font-size: 18px;">Tidak ada poliklinik</h1>
                @else
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($poliklinik as $poli)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $poli->nama }}</td>
                                <td>
                                    <a href="{{ route('poli.edit.view', $poli->id) }}" class="btn3">Ubah</a>
                                    <a class="btn4" data-bs-toggle="modal" data-bs-target="#poliModal-{{ $poli->id }}" href=""
                                        onclick="event.preventDefault();">
                                        Hapus
                                    </a>

                                    <form id="hapus-poliklinik-{{ $poli->id }}" action="{{ route('poli.delete', $poli->id) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="poliModal-{{ $poli->id }}" tabindex="-1" aria-labelledby="poliModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="poliModalLabel">Hapus Poliklinik</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Hapus sekarang? 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn1"
                                                onclick="document.getElementById('hapus-poliklinik-{{ $poli->id }}').submit();">Hapus</button>
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

        <!-- Modal -->
        
    </div>
@endsection
