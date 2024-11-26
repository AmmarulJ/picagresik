@extends('layouts._layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Real Count</h2>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                            <li class="breadcrumb-item active">Real Count</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <div class="col">
                    <a type="button" class="btn btn-primary mb-3" href="{{ route('RealCount.insert') }}">
                        Tambah Real Count
                    </a>
            @endif
            @if (session()->has('success'))
                <script>
                    Swal.fire({
                        title: "Success!",
                        text: "{{ session()->get('success') }}",
                        icon: "success"
                    });
                </script>
            @endif

            @if ($errors->any())
                <div class="col">
                    @foreach ($errors->all() as $error)
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "{{ $error }}"
                            });
                        </script>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <hr>


    <hr>
    <div class="container table table-striped table-hover table-responsive mt-2">
        <table id="myTable" class="display">
            <thead class="border">
                <tr>
                    <th class="text-center border">No</th>
                    <th class="text-center border">Kecamatan</th>
                    <th class="text-center border">Kelurahan</th>
                    <th class="text-center border">No TPS</th>
                    <th class="text-center border">Paslon1 : Fandi Akhmad Yani - Asluchul Alif</th>
                    <th class="text-center border">Kotak Kosong</th>
                    <th class="text-center border">Suara Tidak Sah</th>
                    <th class="text-center border">Jumlah Kehadiran</th>
                    <th class="text-center border">Gambar Bukti</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($hasilSuara as $item)
                    <tr>
                        <td class="text-center border">{{ $loop->iteration }}</td>
                        <td class="text-center border">{{ $item->Tps->kelurahan->kecamatan->nama }}</td>
                        <td class="text-center border">{{ $item->Tps->kelurahan->nama }}</td>
                        <td class="text-center border">{{ $item->Tps->nama }}</td>
                        <td class="text-center border">{{ $item->paslon1 }}</td>
                        <td class="text-center border">{{ $item->kotak_kosong }}</td>
                        <td class="text-center border">{{ $item->suara_tidak_sah }}</td>
                        <td class="text-center border">{{ $item->jumlah_kehadiran }}</td>
                        <td>
                            @foreach ($item->gambarBukti as $gambar)
                                <img src="{{ asset('storage/' . $gambar->path) }}" alt="Gambar Bukti"
                                    style="max-width: 200px; margin: 10px;">
                                <a href="{{ asset('storage/' . $gambar->path) }}" download="image"
                                    class="btn btn-primary">Download Image</a>
                            @endforeach
                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            document.title = "Real Count - PICA";
            $("#RealActive").addClass('active');

            // Inisialisasi DataTable dengan opsi
            $('#myTable').DataTable({
                responsive: true,
                searching: true,
                ordering: false, // Menonaktifkan pengurutan
                dom: 'Bfrtip', // Menambahkan elemen untuk tombol eksport
                buttons: [{
                        extend: 'csvHtml5',
                        text: 'Download CSV',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Download Excel',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Download PDF',
                        className: 'btn btn-danger'
                    }
                ]
            });

            // Mengatasi bug search saat tekan Enter
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@stop
