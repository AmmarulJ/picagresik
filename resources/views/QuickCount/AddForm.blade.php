@extends('layouts._layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Tambah Quick Count</h2>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quick Count</a></li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            @if (Auth::user()->role == 'superadmin')
                <div class="col">
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

    {{-- Form --}}
    <div class="container header">
        <h5 class="title" id="formModalLabel">Form Quick Count</h5>
    </div>
    <div class="Container">
        <form method="POST" action="{{ route('QuickCount.insertData') }}" id="addForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Status" value="QuickCount">

            <div class="mb-3">
                <label for="tps" class="form-label">TPS:</label>
                <select name="tps" class="form-control dropdownSelect" id="tps">
                    <option value="">Pilih TPS</option>
                    @foreach ($tps as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->kelurahan->kecamatan->nama }}-{{ $item->kelurahan->nama }}-{{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="paslon1" class="form-label">Paslon 1: Fandi Akhmad Yani - Asluchul Alif</label>
                <input type="number" class="form-control" name="paslon1" required>
            </div>
            <div class="mb-3">
                <label for="kotak_kosong" class="form-label">Kotak Kosong</label>
                <input type="number" class="form-control" name="kotak_kosong" required>
            </div>
            <div class="mb-3">
                <label for="paslon1" class="form-label">Suara Tidak Sah:</label>
                <input type="number" class="form-control" name="suara_tidak_sah" required>
            </div>
            <div class="mb-3">
                <label for="paslon1" class="form-label">Jumlah Kehadiran:</label>
                <input type="number" class="form-control" name="jumlah_kehadiran" required>
            </div>
            <div class="input-group mb-3">
                <input type="file" name="gambar[]" multiple accept="image/*" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload Bukti</label>
            </div>

            <button type="button" onclick="add();" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    {{-- end of Form --}}
    <script>
        $(document).ready(function() {
            document.title = "Quick Count - PICA";
            $("#QuickActive").addClass('active')
            $('.dropdownSelect').select2();
            //bug search
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        // check
        function add() {
            Swal.fire({
                title: "Apa Kamu Yakin?",
                text: "Pastikan Inputan Sudah Benar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Kirim!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#addForm').submit();
                }
            });
        }
    </script>

@stop
