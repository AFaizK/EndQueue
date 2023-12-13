@extends('layouts/master')

@section('title', 'Pengunjung')

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
                    <h3 class="card-title">Form Edit Deskripsi</h3>
                </div>
                <form action="" method="" enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label for="pre" class="col-sm-3 col-form-label">nama Pengunjung</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" id="judul" value="" placeholder="Nama Pengunjung" required
                                    autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-7">
                                <input id="deskripsi" placeholder="Editor content goes here" value=""
                                    class="@error('deskripsi') is-invalid @enderror" type="hidden" name="deskripsi">
                                <trix-editor input="deskripsi"></trix-editor>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary m-2" style=" float: right;">Simpan</button>

                </form>
                <a href="{{ url('/pengunjung') }}"> <button class="btn btn-warning btn-simple m-2" style=" float: left;">
                        Kembali
                    </button></a>
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
