@extends('layouts/master')

@section('title', 'Antrian')

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
    <div class="row m-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Antrian</h3>
                </div>
                <div class="card-body all-icons">
                    <div class="row">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Instansi</th>
                                    <th>Jenis Layanan</th>
                                    <th>Antrian</th>
                                    <th class="text-right" style="text-align-last: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="td-actions text-right" style="text-align-last: center;">
                                        <a href=""><button type="button" rel="tooltip"
                                                class="badge btn-danger btn-link btn-icon btn-sm m-2">
                                                <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/editpengunjung"><button type="button" rel="tooltip"
                                                class="badge btn-danger btn-link btn-icon btn-sm m-2">
                                                <i class="bi bi-pencil-square"></i>
                                        </a>
                                        </button>

                                        <form action="" method="post" class="d-inline">

                                            <button rel="tooltip" onclick="return confirm('apakah kamu yakin??')"
                                                class="badge btn-danger btn-link btn-icon btn-sm border-0">
                                                <i class="bi bi-file-x"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const authToken = localStorage.getItem('authToken');
    //     // console.log(authToken);
    //     if (!authToken) {
    //         // Token tidak tersedia, arahkan ke halaman login
    //         window.location.href = "/login";
    //     }
    //     // Lanjutkan dengan kode untuk halaman dashboard
    // });
</script>
