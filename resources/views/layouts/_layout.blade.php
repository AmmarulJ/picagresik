<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/logo.png') }}">
    {{-- my css --}}
    <link href="{{ asset('storage/css/mycss.css') }}" rel="stylesheet">
    {{-- bootstrap css --}}
    <link href="{{ asset('storage/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- cdn jquery, data table css ,data table js --}}
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/domainr-search-box/0.0.31/domainr-search-box.min.js"
        integrity="sha512-XKXtdiGxIOsWNl3ZwlpRLTG8ViA60ru2EbJZhbhgBlvP0qp1fOmWh3ocEIvmpbdNZvI9EJJGfpOjEnJOI6Q0ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Tautan CSS Select2 -->
    <script src="{{ asset('storage/js/jquery-searchbox.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- Tautan JavaScript Select2 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        A body {
            background-color: #F6F5F2;
        }
    </style>

</head>
<div class="d-flex" id="wrapper">
    {{-- sidebar --}}
    @include('layouts.sidebar')
    {{-- end of sidebar --}}
    <div id="page-content-wrapper">

        {{-- header --}}
        @include('layouts.header')
        {{-- end of header --}}
        <!-- Page content-->
        <div class="container-fluid">
            <!--Main layout-->
            @yield('content')
            <!--Main layout-->

            {{-- footer --}}
            @include('layouts.footer')
            {{-- end of footer --}}
        </div>
    </div>
</div>


<script src="{{ asset('storage/js/myjs.js') }}"></script>
<script src="{{ asset('storage/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('storage/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
