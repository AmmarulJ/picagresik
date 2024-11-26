@extends('layouts._layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Users</h2>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            @if (Auth::user()->role == 'superadmin')
                <div class="col">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
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


    <hr>
    <div class="container table table-striped table-hover table-responsive mt-2">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    @if (Auth::user()->role == 'superadmin')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>{{ $item->name }}</td>

                        <td>{{ $item->email }}</td>

                        <td>{{ $item->role }}</td>

                        <td>{{ date('Y-M-d', strtotime($item->updated_at)) }}</td>

                        @if ($item->status == 1)
                            <td>
                                <span class="badge text-bg-success">Active</span>
                            </td>
                        @else
                            <td>
                                <span class="badge text-bg-danger">Non Active</span>
                            </td>
                        @endif


                        @if (Auth::user()->role == 'superadmin')
                            <td>
                                <div class="d-flex justify-conten-around">
                                    <div>
                                        <button type="button" class="btn btn-warning text-light me-1"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"><i
                                                class="bi bi-pencil-square"></i>
                                            Edit</button>
                                    </div>
                                    <div>
                                        <form action="{{ route('user.deleteDataUser', $item->id) }}" method="post"
                                            id="deleteForm{{ $index }}">
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
                @endforeach

            </tbody>
        </table>
    </div>

    {{-- FormModal --}}
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Registrasi Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form style="width: 23rem;" method="POST" action="{{ route('user.addDataUser') }}" id="addForm">

                        @csrf
                        <div class="mb-3">
                            <label for="floatingInputUsername" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="floatingInputUsername" placeholder="akun"
                                name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingInputUsername"class="form-label">Email</label>
                            <input type="email" class="form-control" id="floatingInputUsername"
                                placeholder="akun@gmail.com" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingPassword"class="form-label">Password</label>
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingSelect"class="form-label">Role Akun</label>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                name="role" required>
                                <option value="user" selected>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="button" onclick="add();" class="btn btn-primary">Simpan</button>
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
    @foreach ($users as $index => $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Form Edit Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form style="width: 23rem;" method="POST" action="{{ route('user.editDataUser', $item->id) }}"
                            id="editForm{{ $index }}">
                            @csrf
                            <div class="mb-3">
                                <label for="floatingInputUsername" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="floatingInputUsername" placeholder="akun"
                                    name="name" required value="{{ $item->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="floatingInputUsername"class="form-label">Email</label>
                                <input type="email" class="form-control" id="floatingInputUsername"
                                    placeholder="akun@gmail.com" name="email" required value="{{ $item->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="floatingPassword"class="form-label">Password</label>
                                <input type="password" class="form-control" id="floatingPassword"
                                    placeholder="Password Harus Baru" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="floatingSelect"class="form-label">Role Akun</label>
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="role" required>
                                    <option value="user" selected>Role Saat Ini = {{ $item->role }}</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <button type="button" onclick="edit({{ $index }});"
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
    @endforeach
    {{-- end of edit modal --}}
    <script>
        $(document).ready(function() {
            document.title = "Users - PT.BSG";
            $("#userActive").addClass('active')
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
