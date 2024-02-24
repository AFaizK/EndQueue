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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@endsection
@section('content')


    <div class="row m-3" id="cardContainer">
    </div>

    <div class="m-4 row">
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card line ">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="user-harian-tab" data-toggle="tab" href="#user-harian"
                                role="tab" aria-controls="user-harian" aria-selected="true">user register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="user-bulanan-tab" data-toggle="tab" href="#user-bulanan" role="tab"
                                aria-controls="user-bulanan" aria-selected="false">Chart Bulanan</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body" style="width: 100%">
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="user-harian" role="tabpanel" aria-labelledby="user-harian-tab">
                            <canvas class="rounded-3" id="pengunjung-chart-harian"></canvas>
                        </div>
                        <div class="tab-pane" id="user-bulanan" role="tabpanel" aria-labelledby="user-bulanan-tab">
                            <canvas class="rounded-3" id="pengunjung-chart-bulanan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card line ">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="antrian-harian-tab" data-toggle="tab" href="#antrian-harian"
                                role="tab" aria-controls="antrian-harian" aria-selected="true">Jumlah Antrian Harian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="antrian-bulanan-tab" data-toggle="tab" href="#antrian-bulanan"
                                role="tab" aria-controls="antrian-bulanan" aria-selected="false">Jumlah Antrian
                                Bulanan</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="antrian-harian" role="tabpanel"
                            aria-labelledby="antrian-harian-tab">
                            <canvas class="rounded-3" id="antrian-chart-harian"></canvas>
                        </div>
                        <div class="tab-pane" id="antrian-bulanan" role="tabpanel" aria-labelledby="antrian-bulanan-tab">
                            <canvas class="rounded-3" id="antrian-chart-bulanan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 offset-2 col-lg-8 mb-4">
        <div class="card line ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="layanan-harian-tab" data-toggle="tab" href="#layanan-harian"
                            role="tab" aria-controls="layanan-harian" aria-selected="true">Layanan Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="layanan-bulanan-tab" data-toggle="tab" href="#layanan-bulanan"
                            role="tab" aria-controls="layanan-bulanan" aria-selected="false">Layanan Bulanan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="width: 100%">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="layanan-harian" role="tabpanel"
                        aria-labelledby="layanan-harian-tab">
                        <canvas class="rounded-3" id="layanan-chart-harian"></canvas>
                    </div>
                    <div class="tab-pane" id="layanan-bulanan" role="tabpanel" aria-labelledby="layanan-bulanan-tab">
                        <canvas class="rounded-3" id="layanan-chart-bulanan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom JavaScript -->
    <script src="{{ asset('js/chart-script.js') }}"></script>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const authToken = localStorage.getItem('authToken');
        //     console.log(authToken);
        //     // if (!authToken) {
        //     //     // Token tidak tersedia, arahkan ke halaman login
        //     //     window.location.href = "/login";
        //     // }
        //     // // Lanjutkan dengan kode untuk halaman dashboard
        // });
        // public/js/chart-script.js

        fetch('api/pengunjung-harian')
            .then(response => response.json())
            .then(data => {
                // Siapkan data untuk chart
                const labels = data.labels;
                const JumlahPengunjung = data.data;

                // Buat chart menggunakan Chart.js
                var ctx = document.getElementById('pengunjung-chart-harian').getContext('2d');
                var chartPerHari = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pengunjung yang Register',
                            data: JumlahPengunjung,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        fetch('api/pengunjung-bulanan')
            .then(response => response.json())
            .then(data => {
                // Siapkan data untuk chart
                const labels = data.labels;
                const JumlahPengunjung = data.data;

                // Buat chart menggunakan Chart.js
                var ctx = document.getElementById('pengunjung-chart-bulanan').getContext('2d');
                var chartPerHari = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pengunjung yang Register',
                            data: JumlahPengunjung,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        fetch('api/antrian-harian')
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const datasets = data.datasets;

                // Buat chart menggunakan Chart.js
                var ctx = document.getElementById('antrian-chart-harian').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Mulai sumbu y dari 0
                            }
                        }
                    }
                });
            });


        fetch('api/antrian-bulanan')
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const datasets = data.datasets;

                // Buat chart menggunakan Chart.js
                var ctx = document.getElementById('antrian-chart-bulanan').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Mulai sumbu y dari 0
                            }
                        }
                    }
                });
            });

        fetch('api/layanan-bulanan')
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const datasets = data.datasets;

                // Buat chart menggunakan Chart.js
                var ctx = document.getElementById('layanan-chart-bulanan').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Mulai sumbu y dari 0
                            }
                        }
                    }
                });
            });

        fetch('api/layanan-harian')
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const datasets = data.datasets;

                // Buat chart menggunakan Chart.js
                var ctx = document.getElementById('layanan-chart-harian').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Mulai sumbu y dari 0
                            }
                        }
                    }
                });
            });

        fetch('api/antrian-card-harian')
            .then(response => response.json())
            .then(data => {
                // Mengisi card dengan data yang diterima
                const cardContainer = document.getElementById('cardContainer');
                data.forEach(item => {

                    // Membuat elemen card
                    const card = document.createElement('div');
                    card.className = 'col-lg-4 col-md-6 col-sm-6 mb-4';

                    // Mengisi konten card
                    card.innerHTML = `
                    <div class="card  shadow-lg rounded-3" style="height: 200px;">
                        <div class="card-header">
                            <p class="card-title">${item.instansi} - ${item.layanan}</p>
                        </div>
                        <div class="card-body card-body-dashboard row ">
                            <p class="card-text text-center">${item.jumlah_antrian}</p>
                        </div>
                    </div>
                `;

                    // Menambahkan card ke dalam container
                    cardContainer.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>

@endsection
