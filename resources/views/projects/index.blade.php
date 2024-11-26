@extends('layouts._layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Projects</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <div class="col">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#formModalAdd">
                        Tambah Data
                    </button>
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
    <form action="{{ route('projects.filter') }}" method="get">
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3 d-flex flex-column">
                    <label for="selectPanel" class="form-label">Nama Panel</label>
                    <select aria-label="Default select example" id="selectPanel"name="panel_id"
                        class="form-select selectPanel">
                        <option selected value="0">Pilih Salah Satu</option>
                        @foreach ($panels as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_panel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="mb-3 d-flex flex-column">
                    <label for="selectCustomer"class="form-label">Nama Customer</label>
                    <select aria-label="Default select example" id="selectCustomer"name="customer_id"
                        class="form-select selectCustomer">
                        <option selected value="0">Pilih Salah Satu</option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_customer }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="tanggalAwal"class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggalAwal"
                        name="tanggalAwal"placeholder="name@example.com">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggalAkhir"
                        name="tanggalAkhir"placeholder="name@example.com">
                </div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
    </div>

    <hr>
    <div class="container table table-striped table-hover table-responsive mt-2">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Project</th>
                    <th>Nama Project</th>
                    <th>Tanggal</th>
                    <th>Nama Panel</th>
                    <th>Nama Customer</th>
                    <th>Link GoogleDrive</th>
                    @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($projects as $index => $item)
                    @if ($item->status == 1)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ $item->singkatan_project }}</td>

                            <td>{{ $item->nama_project }}</td>

                            <td>{{ date('Y-M-d', strtotime($item->updated_at)) }}</td>

                            <td>{{ $item->panel->nama_panel }}</td>

                            <td>{{ $item->customer->nama_customer }}</td>

                            <td>
                                <a href="{{ $item->link_googledrive }}" class="btn btn-primary me-1"target="_blank"><i
                                        class="bi bi-link-45deg"></i> Link</a>
                            </td>
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}"><i
                                                    class="bi bi-pencil-square"></i>
                                                Edit</button>
                                        </div>
                                        <div>
                                            <form action="{{ route('project.deleteDataProject', $item->id) }}"
                                                method="post" id="deleteForm{{ $index }}">
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-danger text-light"onclick="deletepro({{ $index }})"><i
                                                        class="bi bi-trash"></i>
                                                    Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>
    {{-- FormModalAdd --}}
    <div class="modal fade" id="formModalAdd" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('project.addDataProject') }}" method="post" id="addForm">
                        @csrf

                        <!-- Isi form disini -->
                        <div class="mb-3">
                            <label for="inputNamaProject" class="form-label">Nama Project</label>
                            <input type="text" class="form-control" id="inputNamaProject" name="nama_project" required>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="selectCustomer" class="form-label">Nama Customer</label>
                            <select aria-label="Default select example" id="selectCustomerAdd" name="customer_id"
                                class="form-select">
                                <option selected>Pilih Salah Satu</option>
                                @foreach ($customers as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="selectPanel" class="form-label">Nama Panel</label>
                            <select aria-label="Default select example" id="selectPanelAdd" name="panel_id"
                                class="form-select">
                                <option selected>Pilih Salah Satu</option>
                                @foreach ($panels as $item)
                                    @foreach ($item->images as $image)
                                        <option value="{{ $item->id }}"
                                            data-image="{{ asset('images/panels/' . $image->image_path) }}">
                                            {{ $item->nama_panel }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <!-- Area untuk menampilkan gambar -->
                        <div class="mb-3">
                            <label for="imagePreview" class="form-label">Preview Gambar</label>
                            <div id="imagePreview" class="d-flex justify-content-center">
                                <!-- Gambar akan ditampilkan di sini -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="inputLinkGoogleDrive" class="form-label">Link GoogleDrive</label>
                            <input type="text" class="form-control" id="inputLinkGoogleDrive"
                                name="link_googledrive">
                        </div>

                        <!-- Tombol simpan berada di dalam tag form -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <!-- Tombol tutup di luar tag form -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of FormModal --}}

    {{-- editModal --}}

    <!-- Form Modal Edit -->
    @foreach ($projects as $index => $item)
        <div class="modal fade formModalEdit" id="editModal{{ $item->id }}"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Form Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('project.editDataProject', $item->id) }}"
                            method="post"id="editForm{{ $index }}">
                            @csrf
                            <!-- Isi form disini -->
                            <input type="hidden" name="id"value="{{ $item->id }}">
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Nama Project</label>
                                <input type="text" class="form-control" id="inputNama" name="nama_project"
                                    value="{{ $item->nama_project }}">
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label for="selectCustomer"class="form-label">Nama Customer</label>
                                <select aria-label="Default select example"
                                    id="selectCustomerEdit{{ $index }}"name="customer_id" class="form-select">
                                    <option selected value="{{ $item->customer->id }}">
                                        {{ $item->customer->nama_customer }}</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama_customer }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label for="selectPanel" class="form-label">Nama Panel</label>
                                <select aria-label="Default select example"
                                    id="selectPanelEdit{{ $index }}"name="panel_id" class="form-select">
                                    <option selected
                                        value="{{ $item->panel->id }}"data-image="{{ asset('images/panels/' . $image->image_path) }}">
                                        {{ $item->panel->nama_panel }}</option>
                                    @foreach ($panels as $item)
                                        @foreach ($item->images as $image)
                                            <option value="{{ $item->id }}"
                                                data-image="{{ asset('images/panels/' . $image->image_path) }}">
                                                {{ $item->nama_panel }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <!-- Area untuk menampilkan gambar -->
                            <div class="mb-3">
                                <label for="imagePreview" class="form-label">Preview Gambar</label>
                                <div id="imagePreview{{ $index }}" class="d-flex justify-content-center">
                                    <!-- Gambar akan ditampilkan di sini -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Link GoogleDrive</label>
                                <input type="text" class="form-control" id="inputNama" name="link_googledrive"
                                    value="{{ $item->link_googledrive }}">
                            </div>
                            <!-- Tombol simpan berada di dalam tag form -->
                            <button type="button" onclick="edit({{ $index }})"
                                class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <!-- Tombol tutup di luar tag form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#selectPanelEdit" + {{ $index }}).select2({
                dropdownParent: $(".formModalEdit")
            });
            $("#selectCustomerEdit" + {{ $index }}).select2({
                dropdownParent: $(".formModalEdit")
            });
            $(document).ready(function() {
                function updateImagePreviewEdit(selectElement) {
                    const imageUrl = $(selectElement).find(':selected').data('image');
                    $('#imagePreview{{ $index }}').empty();

                    if (imageUrl) {
                        const img = $('<img>').attr('src', imageUrl)
                            .attr('alt', 'Preview Gambar')
                            .addClass('img-thumbnail')
                            .css('max-width', '200px');
                        $('#imagePreview{{ $index }}').append(img);
                    }
                }

                $('#selectPanelEdit{{ $index }}').change(function() {
                    updateImagePreviewEdit(this);
                });

                // Trigger image preview on load if needed
                updateImagePreviewEdit($('#selectPanelEdit{{ $index }}'));
            });
        </script>
    @endforeach
    {{-- end of edit modal --}}
    <script>
        $(document).ready(function() {

            function updateImagePreview(selectElement) {
                const imageUrl = $(selectElement).find(':selected').data('image');
                $('#imagePreview').empty();

                if (imageUrl) {
                    const img = $('<img>').attr('src', imageUrl)
                        .attr('alt', 'Preview Gambar')
                        .addClass('img-thumbnail')
                        .css('max-width', '200px');
                    $('#imagePreview').append(img);
                }
            }

            $('#selectPanelAdd').change(function() {
                updateImagePreview(this);
            });

            document.title = "Projects - PT.BSG";
            $("#projectActive").addClass('active')
            $('#myTable').DataTable({
                responsive: true,
                searching: true,
                "ordering": false
            });

            //bug search
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $("#selectPanel").select2();
            $("#selectCustomer").select2();
            $("#selectPanelAdd").select2({
                dropdownParent: $("#formModalAdd")
            });
            $("#selectCustomerAdd").select2({
                dropdownParent: $("#formModalAdd")
            });

            // $('.selectPanel').searchBox();
            // $('.selectPanelAdd').searchBox();

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

        function edit(id) {
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
                    $('#editForm' + id).submit();
                }
            });
        }

        function deletepro(id) {
            Swal.fire({
                title: "Apa Kamu Yakin Menghapus Data ini?",
                text: "Pastikan Data Yang Dihapus Sudah Benar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm' + id).submit();
                }
            });
        }
    </script>

@stop
