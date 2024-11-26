@extends('layouts._layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Dashboard</h2>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard Perolehan Perhitungan</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <h2 class="mb-3">Quick Count</h2>
            <div class="col">
                <div id="quickCountChart" style="width: 100%; height: 400px;"></div>
                <hr>
                <div id="quickCountBarChart" style="width: 100%; height: 400px;"></div>

            </div>
            <div class="col">
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-success text-light fs-3">
                            Quick Count: Fandi Akhmad Yani - Asluchul Alif

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalQuickCountPaslon1 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-primary text-light fs-3">
                            Quick Count : Kotak Kosong


                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalQuickCountKotakKosong }}</p>
                        </div>
                    </div>
                </div>

                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-warning text-light fs-3">
                            Total Jumlah Suara Tidak Sah
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalQuickCountTidakSah }}</p>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-secondary text-light fs-3">
                            Total Jumlah Suara
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalQuickCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <h2 class="mb-3">Real Count</h2>
            <div class="col">
                <div id="realCountChart" style="width: 100%; height: 400px; margin-top: 50px;"></div>
                <hr>
                <div id="realCountBarChart" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="col">
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-primary text-light fs-3">
                            Real Count: Fandi Akhmad Yani - Asluchul Alif

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalRealCountPaslon1 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-success text-light fs-3">
                            Real Count: Kotak Kosong


                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalRealCountKosong }}</p>
                        </div>
                    </div>
                </div>


                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-warning text-light fs-3">
                            Total Jumlah Suara Tidak Sah
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalRealCountTidakSah }}</p>
                        </div>
                    </div>
                </div>
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header bg-secondary text-light fs-3">
                            Total Jumlah Suara
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $totalRealCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            document.title = "Dashboard - PICA";
            $("#dashboardsActive").addClass('active')
        });
    </script>
    <script>
        // Data untuk Quick Count
        var quickCountOptions = {
            series: [
                {{ $totalQuickCountPaslon1 }},
                {{ $totalQuickCountKotakKosong }},
                {{ $totalQuickCountTidakSah }}
            ],
            chart: {
                type: 'pie',
                height: 400
            },
            labels: [
                'Paslon 1',
                'Kotak Kosong',
                'Suara Tidak Sah'
            ],
            title: {
                text: 'Hasil Quick Count',
                align: 'center'
            },
            colors: ['#00E396', '#008FFB', '#FEB019'],
        };

        // Render Quick Count Chart
        var quickCountChart = new ApexCharts(document.querySelector("#quickCountChart"), quickCountOptions);
        quickCountChart.render();

        // Data untuk Real Count
        var realCountOptions = {
            series: [
                {{ $totalRealCountPaslon1 }},
                {{ $totalRealCountKosong }},
                {{ $totalRealCountTidakSah }}
            ],
            chart: {
                type: 'pie',
                height: 400
            },
            labels: [
                'Paslon 1',
                'Kotak Kosong',
                'Suara Tidak Sah'
            ],
            title: {
                text: 'Hasil Real Count',
                align: 'center'
            },
            colors: ['#00E396', '#008FFB', '#FEB019'],
        };

        // Render Real Count Chart
        var realCountChart = new ApexCharts(document.querySelector("#realCountChart"), realCountOptions);
        realCountChart.render();
    </script>
    <script>
        // Data Kelurahan dan Total Suara
        var kelurahanLabels = @json($totalQuickCountPerTps->keys()); // Nama kelurahan
        var paslon1Data = @json($totalQuickCountPerTps->pluck('total_paslon1'));
        var paslon2Data = @json($totalQuickCountPerTps->pluck('kotak_kosong'));
        var paslon3Data = @json($totalQuickCountPerTps->pluck('suara_tidak_sah'));

        // Konfigurasi ApexCharts
        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            series: [{
                    name: 'Paslon 1',
                    data: paslon1Data
                },
                {
                    name: 'Kotak Kosong',
                    data: paslon2Data
                },
                {
                    name: 'Suara Tidak Sah',
                    data: paslon3Data
                }
            ],
            xaxis: {
                categories: kelurahanLabels
            },
            title: {
                text: 'Total Suara per Kelurahan (Quick Count)',
                align: 'center'
            },
            colors: ['#00E396', '#008FFB', '#FEB019'],
            legend: {
                position: 'top'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%'
                }
            }
        };

        // Render Chart
        var chart = new ApexCharts(document.querySelector("#quickCountBarChart"), options);
        chart.render();
    </script>
    <script>
        // Data Kelurahan dan Total Suara
        var kelurahanLabels = @json($totalRealCountPerTps->keys() ?? []); // Nama kelurahan
        var paslon1Data = @json($totalQuickCountPerTps->pluck('total_paslon1'));
        var paslon2Data = @json($totalQuickCountPerTps->pluck('kotak_kosong'));
        var paslon3Data = @json($totalQuickCountPerTps->pluck('suara_tidak_sah'));

        // Konfigurasi ApexCharts
        var options = {
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: true // Menampilkan toolbar untuk unduh grafik
                }
            },
            series: [{
                    name: 'Paslon 1',
                    data: paslon1Data
                },
                {
                    name: 'Kotak Kosong',
                    data: paslon2Data
                },
                {
                    name: 'Suara Tidak Sah',
                    data: paslon3Data
                }
            ],
            xaxis: {
                categories: kelurahanLabels,
                title: {
                    text: 'Kelurahan',
                    style: {
                        fontSize: '14px'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Jumlah Suara',
                    style: {
                        fontSize: '14px'
                    }
                }
            },
            title: {
                text: 'Total Suara per Kelurahan (Quick Count)',
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold'
                }
            },
            colors: ['#00E396', '#008FFB', '#FEB019'],
            legend: {
                position: 'top',
                horizontalAlign: 'center',
                offsetY: -10
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%'
                }
            },
            tooltip: {
                enabled: true,
                y: {
                    formatter: function(value) {
                        return value + ' Suara'; // Tambahkan label "Suara" pada tooltip
                    }
                }
            },
            grid: {
                borderColor: '#f1f1f1'
            }
        };

        // Render Chart
        var chart = new ApexCharts(document.querySelector("#realCountBarChart"), options);
        chart.render();
    </script>

@stop
{{-- "totalQuickCountPaslon1" => $totalQuickCountPaslon1,
"totalQuickCountKotakKosong" => $totalQuickCountKotakKosong,
"totalQuickCountTidakSah" => $totalQuickCountTidakSah,
"totalQuickCount" => $totalQuickCount,
"totalRealCountPaslon1" => $totalRealCountPaslon1,
"totalRealCountKosong" => $totalRealCountKosong,
"totalRealCountTidakSah" => $totalRealCountTidakSah,
"totalRealCount" => $totalRealCount,
"totalQuickCountPerTps" => $totalQuickCountPerTps,
"totalRealCountPerTps" => $totalRealCountPerTps, --}}
