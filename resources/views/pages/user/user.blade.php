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
    <section id="showSection">
        <div class="row m-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="container container-search mb-3">
                        <div class="search-container">
                            <input class="input" type="text" id="search-bar"
                                placeholder="Search Berdasarkan Nama User, Username, email, No Handphone, Status dan Role"
                                onkeypress="if(event.keyCode === 13) searchUser()">
                            <svg viewBox="0 0 24 24" class="search__icon">
                                <g>
                                    <path
                                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body all-icons">
                        <div class="row">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
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
                            <div id="pagination-container">
                                <button onclick="prevPage()" id="prev-button" disabled>Halaman Sebelumnya</button>
                                <span id="page-info">Halaman 1</span>
                                <button onclick="nextPage()" id="next-button">Halaman Berikutnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <button class="btn btn-primary me-md-2 btn-formtambah m-2" type="button">Tambah User</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        {{-- <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
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
        </div> --}}
    </section>
    <section id="formSection" style="display: none;">
        <div class="row m-2">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header mb-5">
                        <h3 class="card-title card-form" id="card-title">Tambah User</h3>
                    </div>
                    <form action="" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label for="nama_user" class="col-sm-3 col-form-label">Nama User</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nama_user" id="nama_user"
                                        value="" placeholder="Nama User" required autofocus>

                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-7">
                                    <select class="form-select form-select-lg mb-3" name="status"
                                        aria-label=".form-select-lg example">
                                        <option selected disabled>Pilih Status User</option>
                                        <option value="1" data-name="Aktif">Aktif</option>
                                        <option value="2" data-name="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-7">
                                    <select class="form-select form-select-lg mb-3" name="role"
                                        aria-label=".form-select-lg example">
                                        <option selected disabled>Pilih Role User</option>
                                        <option value="1" data-name="Admin">Admin</option>
                                        <option value="2" data-name="Super Admin">Super Admin</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="username" id="username" value=""
                                        placeholder="Username" required autofocus>

                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control " name="email" id="email" value=""
                                        placeholder="Email" required autofocus>

                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="no_hp" class="col-sm-3 col-form-label">No HandPhone</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="no_hp" id="no_hp"
                                        value="" placeholder="No HandPhone" required autofocus>

                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="" placeholder="Password" aria-describedby="passwordHelp" required
                                        autofocus>
                                    <div id="passwordHelp" class="form-text">minimal panjang password 6 dan wajib diisi
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" value="" placeholder="Password" required autofocus>

                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btn-simpan" class="btn btn-primary m-2"
                            style=" float: right;">Tambah</button>

                    </form>
                    <div class="col-md-2">
                        <a type="button" href="{{ url('/user') }}"
                            class="btn btn-warning btn-simple m-5 float-left d-inline-block">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        const tabel = document.getElementById("table");
        const url = "http://localhost:8000/api/user"
        const register = "http://localhost:8000/api/register"
        let output = '';
        let no = 1;
        const FormTambah = document.querySelector(".btn-formtambah");
        const Kirimdata = document.querySelector(".form")
        const btnSimpan = document.getElementById('btn-simpan');
        const cardTitle = document.getElementById('card-title');
        const showSection = document.getElementById('showSection');
        const formSection = document.getElementById('formSection');

        const NamaUser = document.getElementById('nama_user');
        const Email = document.getElementById('email');
        const Password = document.getElementById('password');
        const ConfirmPassword = document.getElementById('confirm_password');
        const Username = document.getElementById('username');
        const NoHp = document.getElementById('no_hp');
        const Status = document.querySelector('[name="status"]');
        const Role = document.querySelector('[name="role"]');

        const urlPagination = 'http://localhost:8000/api/user/pagination';


        let currentPage = 1;
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const pageInfo = document.getElementById('page-info');

        // document.addEventListener('DOMContentLoaded', function() {
        //     const authToken = localStorage.getItem('authToken');
        //     // console.log(authToken);
        //     if (!authToken) {
        //         // Token tidak tersedia, arahkan ke halaman login
        //         window.location.href = "/login";
        //     }
        //     // Lanjutkan dengan kode untuk halaman dashboard
        // });
        function showData() {
            showSection.style.display = 'block';
            formSection.style.display = 'none';
        }

        // Fungsi untuk menyembunyikan bagian Data  dan menampilkan bagian Edit
        function showForm() {
            showSection.style.display = 'none';
            formSection.style.display = 'block';
        }

        function fetchData(page) {
            fetch(`${urlPagination}?page=${page}`)
                .then((res) => res.json())
                .then((data) => {
                    let output = '';
                    no = (currentPage - 1) * data.meta.pagination.per_page + 1;
                    data.data.forEach(user => {
                        output += `
                        <tr class="tr">
                            <td class="text-center">${ no++ }</td>
                            <td class="name">${ user.name }</td>
                            <td class="username">${ user.username }</td>
                            <td class="email">${user.email}</td>
                            <td class="no_hp">${user.no_hp}</td>
                            <td class="role">${user.role}</td>
                            <td class="status">${user.status}</td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" data-id=${ user.id } >
                                    <i id="edit-button" class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" data-id=${ user.id } >
                                    <i id="delete-button" class="bi bi-file-x fs-2"></i>
                                </a>
                            </td>
                        </tr>
                `;
                    });

                    tabel.innerHTML = output;

                    // Update nomor halaman saat ini
                    currentPage = data.meta.pagination.current_page;

                    // Tampilkan informasi halaman
                    pageInfo.textContent = `Halaman ${currentPage} dari ${data.meta.pagination.total_pages}`;

                    // Aktifkan/tidak aktifkan tombol sebelumnya dan berikutnya
                    prevButton.disabled = currentPage === 1;
                    nextButton.disabled = currentPage === data.meta.pagination.total_pages;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Mendefinisikan fungsi untuk menangani klik tombol halaman berikutnya
        function nextPage() {
            currentPage++;
            fetchData(currentPage);
        }

        // Mendefinisikan fungsi untuk menangani klik tombol halaman sebelumnya
        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                fetchData(currentPage);
            }
        }

        // Memuat data untuk halaman pertama saat halaman dimuat
        fetchData(currentPage);


        function searchUser() {
            let no = 1;
            var query = document.getElementById('search-bar').value;
            fetch('/api/user/search', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Tambahkan CSRF token jika menggunakan Laravel
                    },
                    body: JSON.stringify({
                        query: query
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Menghapus semua elemen pada tbody
                    document.getElementById('table').innerHTML = '';

                    // Memasukkan data hasil pencarian ke dalam tabel
                    data.data.forEach((user, index) => {
                        var row = `
                        <tr class="tr">
                            <td class="text-center">${ no++ }</td>
                            <td class="name">${ user.name }</td>
                            <td class="username">${ user.username }</td>
                            <td class="email">${user.email}</td>
                            <td class="no_hp">${user.no_hp}</td>
                            <td class="role">${user.role}</td>
                            <td class="status">${user.status}</td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" data-id=${ user.id } >
                                    <i id="edit-button" class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" data-id=${ user.id } >
                                    <i id="delete-button" class="bi bi-file-x fs-2"></i>
                                </a>
                            </td>
                        </tr>
                        `;
                        document.getElementById('table').innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error('There was an error!', error);
                });
        }

        FormTambah.addEventListener('click', (e) => {
            e.preventDefault();
            showForm();
        });

        Kirimdata.addEventListener('submit', function(event) {
            event.preventDefault();

            const NamaUser = document.getElementById('nama_user').value;
            const Email = document.getElementById('email').value;
            const Password = document.getElementById('password').value;
            const ConfirmPassword = document.getElementById('confirm_password').value;
            const Username = document.getElementById('username').value;
            const NoHp = document.getElementById('no_hp').value;
            const statusSelect = document.querySelector('[name="status"]');
            const roleSelect = document.querySelector('[name="role"]');

            const selectedStatusValue = statusSelect.value;
            const selectedRoleValue = roleSelect.value;

            const selectedStatusName = statusSelect.options[statusSelect.selectedIndex].dataset.name;
            const selectedRoleName = roleSelect.options[roleSelect.selectedIndex].dataset.name;


            console.log("Selected Status Value:", selectedStatusValue);
            console.log("Selected Role Value:", selectedRoleValue);

            console.log("Selected Status Name:", selectedStatusName);
            console.log("Selected Role Name:", selectedRoleName);
            const formData = new FormData();
            formData.append('name', NamaUser);
            formData.append('status', selectedStatusName);
            formData.append('role', selectedRoleName);
            formData.append('username', Username);
            formData.append('email', Email);
            formData.append('no_hp', NoHp);
            formData.append('password', Password);
            formData.append('confirm_password', ConfirmPassword);


            console.log("Data yang akan dikirim:", {
                NamaUser,
                Email,
                Password,
                Username,
                NoHp,
                Status,
                Role,
                ConfirmPassword,
            });

            // kan pengiriman data ke server
            fetch(register, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        // Perbarui pengaturan header untuk menyertakan token CSRF
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        "Accept": "application/json",
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        console.error('Respons tidak berhasil:', response);
                        throw new Error('Terjadi kesalahan saat mengirim data.');
                    }
                    return response.json();
                })
                .then(data => {
                    alert("Data berhasil dikirim");
                    location.reload();
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    alert("gagal megirim data, periksa kembali data user!!")
                });
        });
        tabel.addEventListener('click', event => {
            // console.log(event.target.id);
            event.preventDefault();
            let editButton = event.target.id == 'edit-button';
            let deleteButton = event.target.id == 'delete-button';


            let id = event.target.parentElement.dataset.id;
            console.log(id);
            if (deleteButton) {
                if (confirm("Apakah Anda yakin ingin menghapusnya?")) {
                    fetch(`${url}/${id}`, {
                            method: 'DELETE',
                        })
                        .then(res => {
                            if (res.status === 204) {
                                location.reload();
                            } else {
                                return res.json();
                            }
                        })
                        .then(data => {
                            alert("Data berhasil didelete");
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                        });
                }
            }
            if (editButton) {
                showForm();
                const parent = event.target.closest('.tr');
                // console.log(parent);
                cardTitle.textContent = 'edit data user';
                btnSimpan.textContent = 'Simpan';
                let isiName = parent.querySelector('.name').textContent
                let isiStatus = parent.querySelector('.status').textContent;
                let isiRole = parent.querySelector('.role').textContent;
                let isiUsername = parent.querySelector('.username').textContent;
                let isiEmail = parent.querySelector('.email').textContent;
                let isiNoHP = parent.querySelector('.no_hp').textContent;
                // const Password = document.getElementById('password');
                const ConfirmPassword = document.getElementById('confirm_password');
                const statusSelect = document.querySelector('[name="status"]');
                const roleSelect = document.querySelector('[name="role"]');


                NamaUser.value = isiName;
                Username.value = isiUsername;
                Email.value = isiEmail;
                NoHp.value = isiNoHP;
                let editButtonElement = document.getElementById('btn-simpan');


                console.log(id);

                editButtonElement.addEventListener('click', (e) => {

                    e.preventDefault();
                    const selectedStatusValue = statusSelect.value;
                    const selectedRoleValue = roleSelect.value;

                    const selectedStatusName = statusSelect.options[statusSelect.selectedIndex].dataset
                        .name;
                    const selectedRoleName = roleSelect.options[roleSelect.selectedIndex].dataset.name;


                    console.log("Selected Status Value:", selectedStatusValue);
                    console.log("Selected Role Value:", selectedRoleValue);

                    console.log("Selected Status Name:", selectedStatusName);
                    console.log("Selected Role Name:", selectedRoleName);
                    let name = NamaUser.value;
                    let username = Username.value;
                    let no_hp = NoHp.value;
                    let email = Email.value;
                    let password = Password.value;
                    let confirm_password = ConfirmPassword.value;

                    fetch(`${url}/${id}`, {
                            method: 'PUT',
                            body: JSON.stringify({
                                status: selectedStatusName,
                                role: selectedRoleName,
                                name: name,
                                username: username,
                                no_hp: no_hp,
                                email: email,
                                password: password,
                                confirm_password: confirm_password,
                            }),
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                                "Accept": "application/json",
                                "Content-type": "application/json; charset=UTF-8",
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                console.error('Respons tidak berhasil:', response);
                                throw new Error('Terjadi kesalahan saat mengirim data.');
                            }
                            return response.json();
                        })
                        .then(responseData => {
                            alert("Data berhasil diedit");
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert("gagal mengedit data, periksa kembali data user!!")
                        });
                });

            }


        })
    </script>
@endsection
