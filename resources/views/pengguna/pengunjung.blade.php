<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="assets/css/stylepengunjung.css">
</head>

<body>
    <nav class="navbar custom-navbar fixed-top">
        <div class="container-fluid">
            <a href="/booking" class="brand-logo row"
                style="text-decoration: none; margin-left: 0; display: flex; align-items: center;">
                <div class="col-3">
                    <img src="../assets/images/endqueue.png" alt="" srcset="" width="35" height="35"
                        viewBox="0 0 32 30">
                </div>

                <div class="brand-title col-9" style="font-size: 22px; display: flex; align-items: center;">
                    <span style="color: #13BBED">END</span><span style="color: #035989">QUEUE</span>
                </div>
            </a>

            {{-- <a class="navbar-brand" href="#">Offcanvas navbar</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-custom offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"> <span style="color: #13BBED">END</span><span
                            style="color: #035989">QUEUE</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item mt-1">
                            <!-- Button trigger modal -->
                            <a type="button" class="btn-custom" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                style="text-decoration: none; color:black">Cek Nomor Antrian Anda
                            </a>
                        </li>
                        <li class="nav-item dropdown mt-1">
                            <a id="namaUser" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                nama user
                            </a>
                            <ul class="dropdown-menu dropdown-custom">
                                <form id="logoutForm" action="{{ url('/logoutpengunjung') }}" method="POST">
                                    @csrf
                                    <li><a class="dropdown-item" href="#">Log Out</a></li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    {{--
    <div id="error-message" class="alert alert-danger d-none" role="alert">
        Tanggal booking tidak valid: Tanggal telah lewat
    </div> --}}


    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-custom">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" style="font-weight: bold" id="exampleModalLabel">Nomor Antrian</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div id="bookingInfo"></div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-danger hapus-modal" id="hapusAntrianButton">Hapus
                        Antrian</button> --}}
                </div>

            </div>
        </div>
    </div>
    <section id="card-section-booking" style="margin-top: 60px">
        <div id="tampilanInstansi">
            <h3>PILIH INSTANSI</h3>
            <div id="cardInstansi" class="card-container"></div>
        </div>
        <div id="tampilanLayanan" style="display: none;">
            <h3>PILIH LAYANAN</h3>
            <div id="cardLayanan" class="card-container"></div>
        </div>
        <div id="tampilanTanggal" style="display: none;">
            <h3>PILIH TANGGAL</h3>
            <div id="cardTanggal" class="card-container">
                @csrf
                <input type="date" id="tanggalInput" class="form-control">
                <button onclick="kirimBooking()" class="btn btn-primary mt-2">Kirim Booking</button>
            </div>
        </div>

    </section>
    <!-- HTML Structure -->




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        // JavaScript
        const cardInstansi = document.getElementById("cardInstansi");
        const cardLayanan = document.getElementById("cardLayanan");
        const cardTanggal = document.getElementById("cardTanggal");
        const tanggalInput = document.getElementById("tanggalInput");
        const tampilanInstansi = document.getElementById("tampilanInstansi");
        const tampilanLayanan = document.getElementById("tampilanLayanan");
        const tampilanTanggal = document.getElementById("tampilanTanggal");
        // const namaUserLink = document.getElementById("namaUser");
        const url = "http://localhost:8000/api/layanan";
        let outputInstansi = '';
        let outputLayanan = '';
        const layananByInstansi = {};
        let selectedLayanan = {};
        let selectedInstansi = {};
        let currentVisitor = "";
        let currentService = "";
        let currentInstitution = "";
        let bookingCounter = 1;
        let lastBookingDate = null; // Inisialisasi dengan null

        // Inside the script tag in booking.php
        // Ambil informasi pengguna dari localStorage
        const userName = localStorage.getItem('user_name');
        const userId = localStorage.getItem('user_id');

        // Set nama pengunjung
        // setUserName(userName);

        function setUserName(name) {
            const namaUserElement = document.getElementById('namaUser');
            if (namaUserElement) {
                namaUserElement.innerText = name || 'Admin';
            } else {
                console.error('Element with id "namaUser" not found.');
            }
        }
        setUserName(userName);

        fetch(url)
            .then((res) => res.json())
            .then((data) => {
                // Membuat objek untuk menyimpan data layanan berdasarkan nama instansi
                data.data.forEach(layanan => {
                    // Mengecek apakah nama instansi sudah ada di objek layananByInstansi
                    if (layananByInstansi.hasOwnProperty(layanan.instansi.nama_instansi)) {
                        // Jika sudah, tambahkan objek layanan baru ke array yang sudah ada
                        layananByInstansi[layanan.instansi.nama_instansi].layanan.push({
                            id: layanan.id,
                            nama: layanan.nama_layanan,
                            kode: layanan.kode_layanan
                        });
                    } else {
                        // Jika belum, buat objek baru dengan nama layanan dan logo
                        layananByInstansi[layanan.instansi.nama_instansi] = {
                            logo: layanan.instansi.logo,
                            alamat: layanan.instansi.alamat,
                            layanan: [{
                                id: layanan.id,
                                nama: layanan.nama_layanan,
                                kode: layanan.kode_layanan
                            }]
                        };
                    }
                });

                // Menampilkan data card instansi ke outputInstansi
                for (const [namaInstansi, dataInstansi] of Object.entries(layananByInstansi)) {
                    // Menambahkan data ke outputInstansi
                    outputInstansi +=
                        `
                        <div class="card card-pengunjung mb-4" style=" cursor: pointer;" onclick="showLayanan('${namaInstansi}')">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="${dataInstansi.logo}" style="height:100%" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body card-instansi">
                                        <h4 class="card-title-instansi">${namaInstansi}</h4>
                                        <p  class="card-body-instansi" >${dataInstansi.alamat}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                cardInstansi.innerHTML = outputInstansi;
            });

        // const cards = document.querySelectorAll(".card");

        // // Iterasi melalui setiap elemen card dan menambahkan event listener
        // cards.forEach(function(card) {
        //     card.addEventListener("mousedown", function() {
        //         this.style.transform = "scale(0.95)";
        //     });

        //     card.addEventListener("mouseup", function() {
        //         this.style.transform = "scale(1)";
        //     });
        // });
        // Deklarasikan variabel global untuk menyimpan informasi layanan yang dipilih


        // ...

        // Function untuk menampilkan card layanan sesuai dengan instansi yang dipilih
        function showLayanan(namaInstansi) {
            outputLayanan = ''; // Mengosongkan outputLayanan
            const layananInstansi = layananByInstansi[namaInstansi].layanan;

            // Menampilkan data card layanan ke outputLayanan
            layananInstansi.forEach(layanan => {
                outputLayanan +=
                    `
                    <div class="card card-pengunjung mb-3" style="max-width: 540px; cursor: pointer;" onclick="showTanggal('${layanan.nama}', '${layanan.kode}', '${layanan.id}')">
                        <div class="card-body">
                            <h6 class="card-layanan" data-nama="${layanan.nama}" data-id="${layanan.id}" data-kode="${layanan.kode}">${layanan.nama}</h6>
                        </div>
                    </div>
                `;
            });

            // Simpan informasi layanan yang dipilih
            // selectedInstansi[namaInstansi] = layananInstansi;
            selectedInstansi = namaInstansi;

            cardLayanan.innerHTML = outputLayanan;
            tampilanInstansi.style.display = "none";
            tampilanLayanan.style.display = "block";
        }

        // Function untuk menampilkan input tanggal setelah nama layanan diklik
        function showTanggal(namaLayanan, kodeLayanan, idLayanan) {
            selectedLayanan = {
                id: idLayanan,
                nama: namaLayanan,
                kode: kodeLayanan
            };
            tampilanLayanan.style.display = "none";
            tampilanTanggal.style.display = "block";
        }


        // Function untuk menangani pengiriman booking
        // Function untuk menangani pengiriman booking

        let yourExistingBookingDataByPengunjung = [];
        let yourExistingBookingData = [];
        // Function untuk mengambil kembali data antrian setelah berhasil mengirim data
        fetch('http://localhost:8000/api/antrian')
            .then(response => response.json())
            .then(data => {
                // Simpan data antrian ke variabel yourExistingBookingData
                yourExistingBookingData = data.data;
                // console.log('Data Antrian:', yourExistingBookingData);
            })
            .catch(error => {
                console.error('Gagal mengambil data antrian:', error);
            });

        function fetchAntrianData() {
            fetch('http://localhost:8000/api/antrian')
                .then(response => response.json())
                .then(data => {
                    // Simpan data antrian ke variabel yourExistingBookingData
                    yourExistingBookingData = data.data;
                    // console.log('Data Antrian:', yourExistingBookingData);
                })
                .catch(error => {
                    console.error('Gagal mengambil data antrian:', error);
                });
        }

        function kirimBooking() {
            const idUser = userId;
            const namaLayanan = selectedLayanan.nama;
            const kodeLayanan = selectedLayanan.kode;
            const idLayanan = selectedLayanan.id;
            const namaInstansi = selectedInstansi;
            const tanggalBooking = tanggalInput.value;

            const today = new Date();
            // console.log(today);
            const selectedDate = new Date(tanggalBooking);
            today.setUTCHours(0, 0, 0, 0);
            selectedDate.setUTCHours(0, 0, 0, 0);

            const dayOfWeek = selectedDate
                .getDay();

            // Cek apakah hari yang dipilih adalah Sabtu (6) atau Minggu (0)
            if (dayOfWeek === 6 || dayOfWeek === 0) {
                console.error('Tutup pada akhir pekan (Sabtu/Minggu)');
                alert('Maaf, pelayanan tutup pada akhir pekan (Sabtu/Minggu)');
                return;
            }

            if (selectedDate < today) {
                console.error('Tanggal booking tidak valid: Tanggal telah lewat');
                alert("tanggal sudah lewat");
                return;
            }
            // Validasi tanggal booking
            if (!tanggalBooking) {
                console.error('Tanggal booking belum diisi');
                alert('tanggal belum diisi')
                return;
            }

            // Cek nomor antrian yang sudah ada pada tanggal dan layanan tersebut
            const existingBookingOnDateAndService = yourExistingBookingData.filter(item =>
                item.tanggal_antrian == tanggalBooking && item.id_layanan == idLayanan
            );

            // Tentukan nomor antrian baru
            const nextBookingNumber = calculateNextBookingNumber(existingBookingOnDateAndService, tanggalBooking,
                idLayanan);

            // Kode Booking akan menjadi kombinasi dari kode layanan dan nomor antrian baru
            const kodeBooking = `${kodeLayanan}${nextBookingNumber}`;

            // Kirim data ke database
            fetch('http://localhost:8000/api/antrian', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-type': 'application/json; charset=UTF-8',
                    },
                    body: JSON.stringify({
                        id_pengunjung: idUser,
                        id_layanan: idLayanan,
                        nomor_antrian: kodeBooking,
                        tanggal_antrian: tanggalBooking,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // console.log('Berhasil mengirim data ke server:', data);
                    alert("berhasil melakukan booking, silahkan periksa antrian anda!!")
                    location.reload();

                })
                .catch(error => {
                    console.error('Gagal mengirim data ke server:', error);
                    alert('data harus diisi');
                });

            // Reset tampilan
            cardInstansi.style.display = 'block';
            cardLayanan.style.display = 'none';
            cardTanggal.style.display = 'none';

            // Reset nilai input tanggal
            tanggalInput.value = '';
        }




        function calculateNextBookingNumber(existingBookings, selectedDate, selectedServiceId) {
            // Filter hanya data antrian pada tanggal yang sama dengan tanggal yang dipilih
            const bookingsOnSelectedDate = existingBookings.filter(booking => booking.tanggal_antrian == selectedDate);

            // Filter hanya data antrian dengan layanan yang sama dengan layanan yang dipilih
            const bookingsWithSameService = bookingsOnSelectedDate.filter(booking => booking.id_layanan ==
                selectedServiceId);

            // Jika tidak ada data antrian untuk tanggal dan layanan yang dipilih, nomor antrian baru adalah 1
            if (bookingsWithSameService.length == 0) {
                return 1;
            }

            // Mengambil nomor antrian tertinggi yang sudah ada pada layanan yang dipilih
            const maxExistingBookingNumber = Math.max(...bookingsWithSameService.map(booking => getBookingNumberFromCode(
                booking.nomor_antrian)));

            // Mengambil nomor antrian terakhir yang sudah ada pada layanan yang dipilih
            const lastBookingNumber = bookingsWithSameService[bookingsWithSameService.length - 1];

            // Jika tanggal booking sama dengan tanggal booking sebelumnya, nomor antrian baru adalah nomor antrian sebelumnya + 1
            if (lastBookingNumber.tanggal_antrian == selectedDate) {
                return maxExistingBookingNumber + 1;
            }

            // Jika tanggal booking berbeda dengan tanggal booking sebelumnya, nomor antrian baru adalah 1
            return 1;
        }

        // Fungsi untuk mendapatkan nomor antrian dari kode antrian (misal: CS1)
        function getBookingNumberFromCode(bookingCode) {
            // Mengambil angka dari kode antrian
            const numberPart = bookingCode.replace(/\D/g, '');

            // Mengonversi string menjadi angka
            return parseInt(numberPart, 10);
        }

        // function fetchAntrianData() {
        fetch(`http://localhost:8000/api/antrian/${userId}`)
            .then(response => response.json())
            .then(data => {
                let currentBookings = []; // variabel untuk menyimpan hasil filtering

                // Periksa apakah data antrian adalah objek tunggal atau array
                if (Array.isArray(data.data)) {
                    // Filter data antrian yang tanggalnya belum lewat
                    currentBookings = data.data.filter(booking => {
                        const bookingDate = new Date(booking.tanggal_antrian);
                        const today = new Date();
                        today.setUTCHours(0, 0, 0, 0);
                        return bookingDate >= today;
                    });
                } else {
                    // Jika data antrian adalah objek tunggal, periksa apakah tanggalnya belum lewat
                    const bookingDate = new Date(data.data.tanggal_antrian);
                    const today = new Date();
                    today.setUTCHours(0, 0, 0, 0);
                    if (bookingDate >= today) {
                        currentBookings = [data.data];
                    }
                }

                // console.log('Data Antrian:', currentBookings);
                showAntrianDetails(currentBookings);
            })
            .catch(error => {
                console.error('Gagal mengambil data antrian:', error);
            });


        // function menampilkan modals antrian
        function showAntrianDetails(bookingData) {
            const modalBody = document.getElementById('bookingInfo');
            // Kosongkan konten modal sebelum menambahkan data baru
            modalBody.innerHTML = '';
            const today = new Date();
            today.setUTCHours(0, 0, 0, 0);
            // Periksa apakah ada data antrian yang ditemukan
            if (bookingData && bookingData.length > 0) {
                // Jika ada, tampilkan data antrian
                bookingData.forEach(booking => {
                    const bookingInfo = document.createElement('div');
                    const bookingDate = new Date(booking.tanggal_antrian);
                    const formattedDate = bookingDate.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    bookingInfo.innerHTML = `
                <h3>${booking.layanan.instansi.nama_instansi}</h3>
                <h5>${booking.layanan.nama_layanan}</h5>
                <p>${booking.nomor_antrian}</p>
                <h5>${formattedDate}</h5>
                <hr>
            `;
                    modalBody.appendChild(bookingInfo);
                });
            } else {
                modalBody.innerHTML = '<p style="font-size:20px; padding: 20px">Maaf, Anda tidak memiliki antrian.</p>';
            }

            // Tampilkan modal
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        }

        // function log out
        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('logoutForm');

            if (logoutButton) {
                logoutButton.addEventListener('click', function() {
                    // Mengambil token dari penyimpanan lokal
                    const authToken = localStorage.getItem('authToken');
                    console.log(authToken);
                    fetch('http://localhost:8000/api/logout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + authToken,
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Menghapus token dari penyimpanan lokal
                            localStorage.removeItem('authToken');
                            // Mengarahkan pengguna ke halaman login atau halaman lain yang sesuai
                            window.location.href = "/loginpengunjung";
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                            // Handle errors accordingly (e.g., display an error message to the user)
                        });
                });
            }
        });
    </script>

</body>

</html>
