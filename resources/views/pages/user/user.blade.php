@extends('layouts/master')

@section('title', 'User')

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
    <section>
        <div class="row m-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="card-body all-icons">
                        <div class="row">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Handphone</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-right" style="text-align-last: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table">



                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <a href="{{ url('/tambahuser') }}"><button class="btn btn-primary btn-simple m-3"
                                    style="float: right;">
                                    Tambah User
                                </button></a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ url('/tambahrole') }}"><button class="btn btn-primary btn-simple m-3"
                                    style="float: right;">
                                    Tambah Role
                                </button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="staticBackdropLabel">Akses Menu User</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>User</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Create</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Read</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Update</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Delete</label>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const tabel = document.getElementById("table");
        const url = "http://localhost:8000/api/user"
        let output = '';
        let no = 1;
        // document.addEventListener('DOMContentLoaded', function() {
        //     const authToken = localStorage.getItem('authToken');
        //     // console.log(authToken);
        //     if (!authToken) {
        //         // Token tidak tersedia, arahkan ke halaman login
        //         window.location.href = "/login";
        //     }
        //     // Lanjutkan dengan kode untuk halaman dashboard
        // });
        fetch(url)
            .then((res) => res.json())
            .then((data) => {
                data.data.forEach(user => {
                    // console.log(databarang);
                    output +=
                        `
                        <tr class="tr">
                            <td class="text-center">${no++}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.no_hp}</td>
                            <td>${user.user_role.role}</td>
                            <td>${user.status.status}</td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" id="edit-button">
                                    <i class="bi bi-clipboard-check fs-2"></i>
                                </a>
                                <a href="" id="edit-button">
                                    <i class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" id="delete-button">
                                    <i class="bi bi-file-x fs-2"></i>
                                </a>
                            </td>
                        </tr>

                    `;
                });
                tabel.innerHTML = output;
            })
    </script>
@endsection
