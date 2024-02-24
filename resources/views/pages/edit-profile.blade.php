@extends('layouts/master')

@section('title', 'Edit Profile')

@section('vendor-style')
@endsection

@section('vendor-script')
    <!-- Required vendors -->

    <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
@endsection

@section('page-script')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="clearfix">
                <div class="card card-bx profile-card author-profile m-b30">
                    <div class="card-body">
                        <div class="p-5">
                            <div class="author-profile">
                                <div class="author-media">
                                    <img src="{{ asset('assets') }}/images/user.jpg" alt="">
                                </div>
                                <div class="author-info">
                                    <h6 class="title" id="namaUsers"></h6>
                                    <span id="roleUser"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card profile-card card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Edit Data</h6>
                </div>
                <form class="profile-form" id="profileForm" action="{{ url('/edit-profile') }}" method="POST"
                    enctype="multipart/form-data" onsubmit="updateProfile(event)">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" id="nama" class="form-control">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">No HandPhone</label>
                                <input type="text" name="NoHandPhone" class="form-control" id="NoHandPhone" ndPhone">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" aria-describedby="passwordHelp">
                                <div id="passwordHelp" name="password" class="form-text">minimal panjang password 6 dan
                                    wajib diisi!!</div>
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <input type="hidden" class="form-control" name="inputrole" id="inputrole">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <input type="hidden" class="form-control" name="status" id="status">
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        fetch('/get-profile')
            .then(response => response.json())
            .then(data => {
                document.getElementById('namaUsers').innerText = data.name;
                document.getElementById('roleUser').innerText = data.role;

                document.getElementById('nama').value = data.name;
                document.getElementById('username').value = data.username;
                document.getElementById('NoHandPhone').value = data.no_hp;
                document.getElementById('email').value = data.email;
                document.getElementById('inputrole').value = data.role;
                document.getElementById('status').value = data.status;
            })
            .catch(error => console.error('Error:', error));

        // Fungsi untuk mengirim permintaan PUT ke endpoint edit-profile
        // document.getElementById('profileForm').addEventListener('submit', function(event) {
        //     // Mencegah pengiriman formulir secara default
        //     event.preventDefault();

        //     // Memanggil fungsi updateProfile untuk mengirim permintaan Fetch
        //     updateProfile(event);
        // });

        // Fungsi untuk mengirim permintaan PUT ke endpoint edit-profile
        function updateProfile(event) {
            event.preventDefault();

            // Mengambil nilai input dari form
            const nama = document.getElementById('nama').value;
            const username = document.getElementById('username').value;
            const noHandPhone = document.getElementById('NoHandPhone').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirm_password = document.getElementById('confirm_password').value;
            const status = document.getElementById('status').value;
            const role = document.getElementById('inputrole').value;

            // console.log(status);
            // console.log(role);
            // console.log(nama);
            // console.log(username);
            // console.log(noHandPhone);
            // console.log(email);
            // console.log(password);
            // console.log(confirm_password);
            // Mengirim permintaan POST menggunakan fetch
            fetch('/edit-profile', {
                    method: 'PUT',
                    body: JSON.stringify({
                        status: status,
                        role: role,
                        name: nama,
                        username: username,
                        no_hp: noHandPhone,
                        email: email,
                        password: password,
                        confirm_password: confirm_password,
                    }),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        "Accept": "application/json",
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        console.error('Response not successful:', response);
                        throw new Error('An error occurred while receiving data.');
                    }
                    return response.json();
                })
                .then(data => {
                    alert("update data berhasil")
                    location.reload();
                    console.log('Profile updated:', data);
                    // Tambahkan kode lain sesuai kebutuhan, misalnya, tampilkan pesan sukses, dll.
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('gagal update data, periksa data anda')
                });
        }
    </script>
@endsection
