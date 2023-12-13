@extends('layouts/master')

@section('title', 'Dashboard ')

@section('vendor-style')

    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('vendor-script')
    <!-- Required vendors -->

    <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>
    <script src="{{ asset('assets/vendor/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
@endsection
@section('content')
    <div class="row m-3">
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4" id="">
            <div class="card shadow-lg rounded-3" style="height: 200px;">
                <div class="card-body row mt-2">
                    <p class="card-title"> <span class="float-end"></span></p>
                    <p class="card-text text-center" style="font-size: 40px"> </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6  mb-4 ">
            <div class="card shadow-lg rounded-3" style="height: 200px;">
                <div class="card-body row">
                    <p class="card-title"> <span class="float-end"></span></p>
                    <p class="card-text text-center" style="font-size: 40px"></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12  mb-4 ">
            <div class="card shadow-lg rounded-3" style="height: 200px;">
                <div class="card-body row">
                    <p class="card-title"> <span class="float-end"></span></p>
                    <p class="card-text text-center" style="font-size: 40px"></p>
                </div>
            </div>
        </div>
    </div>


    <div class="m-4 row">
        <div class="card  bar col-lg-4 mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#CO-harian" role="tab" aria-controls="CO-harian"
                            aria-selected="true">Chart Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#CO-bulanan" role="tab" aria-controls="CO-bulanan"
                            aria-selected="false">Chart Bulanan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="CO-harian" role="tabpanel">
                        <canvas class="rounded-3" id="CO-chart"></canvas>
                    </div>

                    <div class="tab-pane" id="CO-bulanan" role="tabpanel" aria-labelledby="CO-tab">
                        <canvas class="rounded-3" id="CO-chart-bulanan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card  bar col-lg-4 mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#NH3-harian" role="tab" aria-controls="NH3-harian"
                            aria-selected="true">Chart Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#NH3-bulanan" role="tab" aria-controls="NH3-bulanan"
                            aria-selected="false">Chart Bulanan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                {{-- <h4 class="card-title">Kadar</h4> --}}

                <div class="tab-content">
                    <div class="tab-pane active" id="NH3-harian" role="tabpanel">
                        <canvas class="rounded-3 " id="NH3-chart"></canvas>
                    </div>

                    <div class="tab-pane" id="NH3-bulanan" role="tabpanel" aria-labelledby="NH3-tab">
                        <canvas class="rounded-3 " id="NH3-chart-bulanan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bar col-lg-4 mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#CH4-harian" role="tab" aria-controls="CH4-harian"
                            aria-selected="true">Chart Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#CH4-bulanan" role="tab" aria-controls="CH4-bulanan"
                            aria-selected="false">Chart Bulanan</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">

                {{-- <h4 class="card-title">Kadar</h4> --}}

                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="CH4-harian" role="tabpanel">
                        <canvas class="rounded-3" id="CH4-chart"></canvas>
                    </div>

                    <div class="tab-pane" id="CH4-bulanan" role="tabpanel" aria-labelledby="CH4-tab">
                        <canvas class="rounded-3" id="CH4-chart-bulanan"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="chart3 mt-2 m-4">
        <div class="card bar ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#gabungan-harian" role="tab"
                            aria-controls="gabungan-harian" aria-selected="true">Chart Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gabungan-bulanan" role="tab" aria-controls="gabungan-bulanan"
                            aria-selected="false">Chart Bulanan</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                {{-- <h4 class="card-title">Kadar</h4> --}}
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="gabungan-harian" role="tabpanel">
                        <canvas class="rounded-3" id="gabungan-chart"></canvas>
                    </div>
                    <div class="tab-pane" id="gabungan-bulanan" role="tabpanel" aria-labelledby="bulanan-tab">
                        <canvas class="rounded-3" id="gabungan-chart-bulanan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const authToken = localStorage.getItem('authToken');
            console.log(authToken);
            // if (!authToken) {
            //     // Token tidak tersedia, arahkan ke halaman login
            //     window.location.href = "/login";
            // }
            // // Lanjutkan dengan kode untuk halaman dashboard
        });
    </script>

@endsection
