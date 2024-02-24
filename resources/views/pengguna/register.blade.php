<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/stylepengunjung.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <section id="card-section-register">
        <div class="card card-register">
            <div class="card-header" style="width: 100%; text-align:center; font-weight:bold">
                Silahkan Daftarkan Diri Anda!!
            </div>
            <div class="card-body">
                <form class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="input-custom form-control" placeholder="nama" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control input-custom" placeholder="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HandPhone</label>
                        <input type="text" class="form-control input-custom" placeholder="No HandPhone"
                            id="no_hp">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label ">Email address</label>
                        <input type="email" class="form-control input-custom" placeholder="Email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control input-custom" id="password"
                            aria-describedby="passwordHelp">
                        <div id="passwordHelp" class="form-text">minimal panjang password 6</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control input-custom mb-2" id="confirm_password"
                            aria-describedby="passwordHelp">
                        <span>Sudah punya akun ? <a href="/loginpengunjung">Login</a></span>
                    </div>
                    <div class="d-grid gap-2"">
                        <button type="submit" class="btn button1">register</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Z18FFKDO0YsPCr6OcrYxuV1LdYJcDAIsD3E+BDPlDkiGvN9FjXqsG9QhdFcg9fb8" crossorigin="anonymous">
    </script>
    <script>
        const Kirimdata = document.querySelector('.form');
        const url = 'http://localhost:8000/api/registerpengunjung';
        Kirimdata.addEventListener('submit', function(event) {
            event.preventDefault();

            const Nama = document.getElementById('nama').value;
            const Email = document.getElementById('email').value;
            const Password = document.getElementById('password').value;
            const ConfirmPassword = document.getElementById('confirm_password').value;
            const Username = document.getElementById('username').value;
            const NoHp = document.getElementById('no_hp').value;

            const formData = new FormData();
            formData.append('name', Nama);
            formData.append('username', Username);
            formData.append('email', Email);
            formData.append('no_hp', NoHp);
            formData.append('password', Password);
            formData.append('confirm_password', ConfirmPassword);


            console.log("Data yang akan dikirim:", {
                Nama,
                Email,
                Password,
                Username,
                NoHp,
                ConfirmPassword,
            });

            // kan pengiriman data ke server
            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        // Perbarui pengaturan header untuk menyertakan token CSRF
                        // "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
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
                    window.location.href = "/loginpengunjung";
                    // location.reload();
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    alert("data wajib diisi semua, periksa kembali!!");
                });
        });
    </script>
</body>

</html>
