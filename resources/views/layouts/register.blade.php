<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="{{ asset('storage/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #F6F5F2;
        }
    </style>
</head>

<body>
    <section class="vh-100"">
        <div class=" container-fluid">
            <div class="row">

                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
                <div class="col-sm-6 text-black">

                    <div class="px-5 mt-3 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">PT BSG </span>
                    </div>
                    <hr>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success</strong> {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning</strong> {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endforeach
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                                <form style="width: 23rem;" method="POST" action="{{ route('registrasiAkun') }}">

                                    @csrf
                                    <h3 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Register</h3>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInputUsername"
                                            placeholder="ansori123" name="name" required>
                                        <label for="floatingInputUsername">Nama</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInputUsername"
                                            placeholder="ansori123" name="email" required>
                                        <label for="floatingInputUsername">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="Password" name="password" required>
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example" name="role" required>
                                            <option value="user" selected>Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="superadmin">Super Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <label for="floatingSelect">Role Akun</label>
                                    </div>


                                    <div class="pt-1 mb-3">
                                        <button data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-primary btn-block" type="submit">Register</button>
                                    </div>
                                    <p>Already Register <a href="/login" class="link-info">Login here</a></p>

                                </form>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('storage/js/app.js') }}"></script>
    <script src="{{ asset('storage/js/bootstrap.min.js') }}"></script>
</body>

</html>
