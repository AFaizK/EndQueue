@extends('layouts/master')

@section('title', 'Tambah User')

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
                <div class="card-header mb-5">
                    <h3 class="card-title">Tambah User</h3>
                </div>
                <form action="" method="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">Nama User</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="judul" id="judul" value=""
                                    placeholder="Nama User" required autofocus>

                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-7">
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option selected>Pilih Status User</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-7">
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option selected>Pilih Role User</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Super Admin</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="judul" id="judul" value=""
                                    placeholder="Username" required autofocus>

                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control " name="judul" id="judul" value=""
                                    placeholder="Email" required autofocus>

                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">No HandPhone</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="judul" id="judul" value=""
                                    placeholder="No HandPhone" required autofocus>

                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="judul" id="judul" value=""
                                    placeholder="Password" required autofocus>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-2" style=" float: right;">Tambah</button>

                </form>
                <a href="{{ url('/pengunjung') }}"> <button class="btn btn-warning btn-simple m-2" style=" float: left;">
                        Kembali
                    </button></a>
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
