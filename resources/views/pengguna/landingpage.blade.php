<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ENDQUEUE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&family=Inter:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/stylelandingpage.css">
</head>

<body>
    <nav class="navbar navbar-custom navbar-expand-lg  fixed-top" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand " href="#home"><img src="../assets/images/logo.png" alt="" srcset=""
                    width="40" height="40" viewBox="0 0 32 30"><span style="color:#11BAED ">END</span><span
                    style="color: #035989">QUEUE</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav  ms-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#visimisi">Visi Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutUs">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#instansi">Instansi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="home" class="d-flex align-items-center">
        <div class="container position-relative mt-5">
            <div class="row">
                <div class="col-md-7 mb-4 mb-md-0">
                    <h3 class="mb-4 ">Teknologi Menjadi Kebutuhan Dalam Mengambil Keputusan Dengan Cepat dan Tepat</h3>
                    <p>Memudahkan melakukan booking tanpa harus datang terlebih dahulu di lokasi menggunakan website
                        ENDQEUE melalui browser komputer maupun handphone.</p>
                    <p>Login untuk lakukan booking sekarang !!</p>
                    <a href="/loginpengunjung" class="btn btn-lg btn-outline-primary">Login Sekarang</a>
                </div>
                <div class="col-md-5">
                    <img src="../assets/images/logo.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <section id="visimisi">
        <div class="container visimisi py-5">
            <div class="text-center mb-5 mt-5">
                <h2 class="title">Visi Misi</h2>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-3">Visi</h3>
                            <ul>
                                <li>Menjadi perusahaan yang bonafit dan dapat dipertanggungjawabkan untuk setiap produk
                                    yang
                                    dihasilkan.</li>
                                <li>Perusahaan mampu memberikan pelayanan dalam taraf nasional maupun multinasional.
                                </li>
                                <li>Menjadi perusahaan teknologi yang membawa nama Indonesia.</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-3">Misi</h3>
                            <ul>
                                <li>Menarik Sumber Daya Manusia berkualitas serta membuka lapangan pekerjaan para
                                    praktisi
                                    teknologi.</li>
                                <li>Memberikan pelayanan secara maksimal guna mendukung kebutuhan konsumen.</li>
                                <li>Memberikan support secara maksimal setelah pembelian.</li>
                                <li>Selalu mengikuti perkembangan teknologi dan melakukan inovasi-inovasi terbaru untuk
                                    memberikan produk yang berkualitas.</li>
                                <li>Mengikuti persaingan perusahaan teknologi untuk mendukung perkembangan teknologi
                                    nasional.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutUs">
        <div class="container aboutUs py-5">
            <div class="text-center mb-5 mt-5">
                <h1 class="title">About Us</h1>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <img src="../assets/images/logo.png" alt="" style="margin-top: -100px" class="img-fluid">
                </div>
                <div class="col-md-5">
                    <p>Nakula Sadewa, CV. Merupakan perusahaan yang bergerak di bidang Teknologi Informasi selama 5
                        tahun, dan disahkan sebagai badan usaha pada 19 Januari tahun 2015 di Malang, Jawa Timur.
                        Dikukuhkan dihadapan Notaris Benediktus Bosu, SH.<br><br>

                        Pengalaman yang didukung oleh tenaga muda profesional dari latar belakang, profesi dan disiplin
                        ilmu yang bervariasi ikut serta berpartisipasi secara elegan dan profesional dalam pelaksanaan
                        pembangunan nasional khususnya di bidang Teknologi Informasi.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="instansi" class="instansi">
        <div class="container py-5">
            <div class="text-center mb-5 mt-5">
                <h2 class="title mb-5">Instansi Yang Tersedia</h2>
            </div>
            <div class="carousel owl-carousel" id="card">
                <!-- Card instansi akan dimasukkan oleh JavaScript -->
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="row col-sm-6 offset-sm-3 offset-lg-0 offset-md-0 ">
                    <h3 class="text-center mb-3">Sosial Media Kami</h3>
                    <div class="col-sm-3 col-4 offset-sm-2 col-lg-2 offset-lg-3 offset-md-1">
                        <a href=""><img src="../assets/images/facebook-official.svg" alt=""
                                class="img-fluid square-img"></a>
                    </div>
                    <div class="col-sm-3 col-4 col-lg-2">
                        <a href=""><img src="../assets/images/instagram-icon.svg" alt=""
                                class="img-fluid square-img"></a>
                    </div>
                    <div class="col-sm-3 col-4 col-lg-2 mb-5">
                        <a href=""><img src="../assets/images/icons8-twitterx.svg" alt=""
                                class="img-fluid square-img"></a>
                    </div>
                </div>
                <div class="col-md-4 offset-md-1 ">
                    <h3 class="text-center mb-3">Office</h3>
                    <p>Ruko Waringin 1 Jl. Candi Waringin
                        Kel. Mojolangu, Kec. Lowokwaru
                        Malang – 65142
                        TLP: 0341 476789</p>
                </div>
            </div>
            <span class="text-center ">
                Created BY <a href="#home" style="text-decoration: none"><span
                        style="color:#11BAED ">END</span><span style="color: #035989">QUEUE</span></a> || ⓒ 2024
            </span>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
        const card = document.getElementById("card");
        const form = document.getElementById("form");
        const url = "http://localhost:8000/api/instansi"
        let output = '';
        $(document).ready(function() {
            $(window).scroll(function() {
                if (this.scrollY > 20) {
                    $('.navbar').addClass("sticky");
                } else {
                    $('.navbar').removeClass("sticky");
                }
            })
        });
        // Mengatur scroll pada saat mengklik pada navbar
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        $('#navbar .navbar-nav a').on('click', function() {
            $('#navbar .navbar-nav').find('li.active').removeClass('active');
            $(this).parent('li').addClass('active');
        });

        fetch(url)
            .then((res) => res.json())
            .then((data) => {
                data.data.forEach(instansi => {
                    output += `
                    <div class="kartu">
                        <div class="box">
                            <img src="${instansi.logo}" class="card-img-top" alt="project1">
                            <div style="font-size:30px" class="text">${instansi.nama_instansi}</div>
                            <p style="font-size:14px; margin-top: -10px" class="card-text ">${instansi.alamat}</p>
                        </div>
                    </div>
                    `;
                });

                card.innerHTML = output;

                // Inisialisasi carousel setelah data instansi selesai dimuat
                $('.carousel').owlCarousel({
                    margin: 20,
                    loop: true,
                    autoplayTimeOut: 2000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: false
                        },
                        600: {
                            items: 2,
                            nav: false
                        },
                        1000: {
                            items: 3,
                            nav: false
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>
</body>

</html>
