<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/logo.png') }}">
    <link href="{{ asset('storage/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-start">
        <!-- Background image -->
        <div
            class="bg-image"style=" background-color:#40a9ab; height: 400px; background-size: 1600px 1400px;overflow: hidden;">
        </div>
        <!-- Background image -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded"
                    style="margin-top: -300px; backdrop-filter: blur(30px);">
                    <div class="card-body">

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

                        <form method="POST" action="{{ route('loginAuth') }}">
                            @csrf
                            <div class="border-bottom bg-light d-flex d-flex align-items-baseline ">
                                <div>
                                    <img src="{{ asset('storage/img/picalogo.svg') }}" alt=""
                                        width="100"height="100">
                                </div>
                            </div>
                            <hr>
                            <h3 class="align-items-center ms-2">LogIn</h3>

                            <div class=" mb-3">
                                <label for="floatingInputUsername" class="form-label">Email</label>
                                <input type="text" class="form-control"
                                    id="floatingInputUsername"placeholder="ansori123" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="floatingPassword" class="form-label">Password</label>
                                <input type="password" class="form-control"id="floatingPassword" placeholder="Password"
                                    name="password" required>
                            </div>

                            <div class="pt-1 mt-3">
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-block"type="submit">Login</button>
                            </div>

                            <p class="small mb-5 pb-lg-2">Forgot
                                password?<a class="text-muted" href="#!">Contact Super
                                    Admin</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('storage/js/app.js') }}"></script>
    <script src="{{ asset('storage/js/bootstrap.min.js') }}"></script>
</body>

</html>
