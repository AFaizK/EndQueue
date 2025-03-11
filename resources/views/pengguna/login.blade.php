<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/stylepengunjung.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <section id="card-section-login">
        <div class="card card-login">
            <div class="card-header" style="width: 100%; text-align:center; font-weight:bold">
                Silahkan Login Terlebih Dahulu!!
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('/loginpengunjung') }}" enctype="multipart/form-data"
                    id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email " class="form-control input-custom" id="exampleInputEmail1" name="email"
                            placeholder="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control input-custom " id="exampleInputPassword1"
                            name="password" aria-describedby="passwordHelp" placeholder="password">
                        <div id="passwordHelp" class="form-text mb-2">minimal panjang password 6</div>
                        <span>belum punya akun ? <a href="/registerpengunjung">register</a></span>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn button1" onclick="submitLoginForm()">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </section>

    {{-- <a id="namaUser" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        User
    </a> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
        function submitLoginForm() {
            const formData = new FormData(document.getElementById('loginForm'));

            fetch('http://localhost:8000/loginpengunjung', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        console.error('Response not successful:', response);
                        throw new Error('An error occurred while receiving data.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Simpan informasi pengguna ke localStorage
                        localStorage.setItem('user_name', data.data.name);
                        localStorage.setItem('user_id', data.data.id);

                        // Redirect to the booking page
                        alert("logih berhasil")
                        window.location.href = data.redirect;
                    } else {

                        console.error('Login failed. Unexpected response structure:', data);
                    }
                })
                .catch(error => {
                    alert("login gagal, periksa data anda!!");
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>
