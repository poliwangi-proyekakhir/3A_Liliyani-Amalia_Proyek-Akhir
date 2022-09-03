@extends('layouts.app')

@section('title')
  <title>
    Data Pasien
  </title>
@endsection

@php
use App\Models\User;
@endphp

@section('content')
  <div class="poliklinik">
    <div class="card">
      <div class="table-header" style="text-align: end">
        <h2 style="font-size: 22px; font-weight: bold;">Data Pasien</h2>
        <select id="filter" onchange="filterTable()">
          <option>ALL</option>
          <option>MENUNGGU ANTRIAN</option>
          <option>HADIR</option>
          <option>TIDAK HADIR</option>
        </select>
      </div>
      <br style="background-color: black;">
      <div class="card-body" style="overflow-x: scroll;">
        @if (count($pasiens) < 1)
          <h1 style="text-align: center; font-size: 18px;">Tidak ada data</h1>
        @else
          <table class="table table-borderless" id="table" style="width: 100vw;">
            <thead>
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>No. Whatsapp</th>
                <th>Poli</th>
                {{-- <th>Dokter</th> --}}
                <th>Tanggal Periksa</th>
                <th>Keluhan</th>
                <th>Kehadiran</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 0;
              @endphp
              @foreach ($pasiens as $pasien)
                <tr>
                  <th scope="row">{{ ++$i }}</th>
                  <td>{{ $pasien->nik }}</td>
                  <td>{{ $pasien->name }}</td>
                  <td>{{ Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') }}</td>
                  <td>{{ $pasien->tempat_lahir }}</td>
                  <td>{{ $pasien->phone }}</td>
                  <td>{{ $pasien->poliklinik }}</td>
                  {{-- <td>{{ User::find($pasien->dokter_id)->name }}</td> --}}
                  <td>{{ Carbon\Carbon::createFromTimestamp($pasien->jadwal)->format('d-m-Y') }}</td>
                  <td>{{ $pasien->keluhan }}</td>
                  <td class="kehadiran">{{ $pasien->kehadiran }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>
  </div>

  <script>
    function filterTable() {
      // Variables
      let dropdown, table, rows, cells, kehadiran, filter;
      dropdown = document.getElementById("filter");
      table = document.getElementById("table");
      rows = table.getElementsByTagName("tr");
      filter = dropdown.value;

      // Loops through rows and hides those with countries that don't match the filter
      for (let row of rows) { // `for...of` loops through the NodeList
        cells = row.getElementsByTagName("td");
        kehadiran = cells[9] || null; // gets the 2nd `td` or nothing
        // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
        if (filter === "ALL") {
          row.style.display = ""; // shows this row
        } else if (!kehadiran || (filter === kehadiran.textContent)) {
          row.style.display = ""; // shows this row
        } else {
          row.style.display = "none"; // hides this row
        }
      }
    }
  </script>
@endsection
