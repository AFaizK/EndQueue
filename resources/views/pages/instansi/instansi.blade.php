@extends('layouts/master')

@section('title', 'Instansi')

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
                        <h3 class="card-title">Data Pengunjung</h3>
                    </div>
                    <div class="container container-search mb-3">
                        <div class="search-container">
                            <input class="input" type="text" id="search-bar"
                                placeholder="Search Berdasarkan Nama Instansi, dan alamat"
                                onkeypress="if(event.keyCode === 13) searchInstansi()">
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Logo</th>
                                        <th class="text-right" style="text-align-last: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table">

                                </tbody>
                            </table>
                        </div>
                        <div id="pagination-container">
                            <button onclick="prevPage()" id="prev-button" disabled>Halaman Sebelumnya</button>
                            <span id="page-info">Halaman 1</span>
                            <button onclick="nextPage()" id="next-button">Halaman Berikutnya</button>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2 btn-formtambah" type="button">Tambah Instansi</button>
                            {{-- <button class="btn btn-primary" type="button">Button</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="fromSection" style="display: none;">
        <div class="row m-2">
            <div class="col-md-12">

                <div class="card container-card">
                    <div class="card-header mb-5">
                        <h3 class="card-title" id="card-title">Tambah Instansi</h3>
                    </div>
                    <form action="" class="form" method="" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Insntansi</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nama_instansi" id="nama_instansi"
                                        value="" placeholder="Nama Instansi" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="alamat" id="alamat" value=""
                                        placeholder="Alamat" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                                <img id="logo-image" style="max-width: 100px; max-height: 100px;">
                                <div class="col-sm-7">
                                    <input id="logo" class="form-control" type="file" accept="image/*">
                                </div>
                            </div>
                        </div>
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
                        <button type="submit" id="btn-simpan" class="btn btn-primary m-2"
                            style=" float: right;">Tambah</button>

                    </form>
                    <div class="col-md-2">
                        <a type="button" href="{{ url('/instansi') }}"
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
        const form = document.getElementById("form");
        const url = "http://localhost:8000/api/instansi";
        let output = '';
        let no = 1;

        const formtambah = document.querySelector(".btn-formtambah");
        const Kirimdata = document.querySelector(".form");

        const Telp = document.getElementById("telp");
        const btnSimpan = document.getElementById("btn-simpan");
        const cardTitle = document.getElementById("card-title");

        const showSection = document.getElementById('showSection');
        const fromSection = document.getElementById('fromSection');

        const logoInput = document.getElementById('logo');
        const logoImage = document.getElementById('logo-image');


        let currentPage = 1;
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const pageInfo = document.getElementById('page-info');

        function fetchData(page) {
            fetch(`${url}?page=${page}`)
                .then((res) => res.json())
                .then((data) => {
                    let output = '';
                    no = (currentPage - 1) * data.meta.pagination.per_page + 1;
                    data.data.forEach(instansi => {
                        output += `
                        <tr class="tr">
                            <td class="text-center">${no++}</td>
                            <td class="nama">${instansi.nama_instansi}</td>
                            <td class="alamat">${instansi.alamat}</td>
                            <td class="logo"><img class="img" src="${instansi.logo}" alt="Logo Instansi" style="max-width: 100px; max-height: 100px;"></td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" data-id=${ instansi.id }>
                                    <i id="edit-button" class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" data-id=${ instansi.id }>
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

        // fungsi search Instansi
        function searchInstansi() {
            let no = 1;
            var query = document.getElementById('search-bar').value;
            fetch('/api/instansi/search', {
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
                    data.data.forEach((instansi, index) => {
                        var row = `
                        <tr class="tr">
                            <td class="text-center">${no++}</td>
                            <td class="nama">${instansi.nama_instansi}</td>
                            <td class="alamat">${instansi.alamat}</td>
                            <td class="logo"><img class="img" src="${instansi.logo}" alt="Logo Instansi" style="max-width: 100px; max-height: 100px;"></td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" data-id=${ instansi.id }>
                                    <i id="edit-button" class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" data-id=${ instansi.id }>
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
        // Fungsi untuk menyembunyikan bagian Edit dan menampilkan bagian Data
        function showData() {
            showSection.style.display = 'block';
            fromSection.style.display = 'none';
        }

        // Fungsi untuk menyembunyikan bagian Data dan menampilkan bagian Edit
        function showForm() {
            showSection.style.display = 'none';
            fromSection.style.display = 'block';
        }





        formtambah.addEventListener('click', (e) => {
            e.preventDefault();
            showForm();
        });
        Kirimdata.addEventListener('submit', function(event) {
            event.preventDefault();
            const nama_instansi = document.getElementById('nama_instansi').value;
            const alamat = document.getElementById('alamat').value;
            const logoInput = document.getElementById('logo');

            // Buat objek FormData dan tambahkan data
            const formData = new FormData();
            formData.append('nama_instansi', nama_instansi);
            formData.append('alamat', alamat);
            formData.append('logo', logoInput.files[0]);
            console.log("Data yang akan dikirim:", {
                nama_instansi,
                alamat,
                logo: logoInput.files[0].name
            });

            // Melakukan pengiriman data ke server
            fetch(url, {
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
                    console.log(formData)
                    console.log('Data respons dari server:', data);
                    alert("Data berhasil dikirim");
                    location.reload();
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    alert("gagal mengirim data, periksa kembali data instansi!!")
                });
        });

        tabel.addEventListener('click', event => {

            event.preventDefault();
            let editButton = event.target.id == 'edit-button';
            let deleteButton = event.target.id == 'delete-button';

            // console.log(editButton);
            // console.log(deleteButton);

            let id = event.target.parentElement.dataset.id;
            // console.log(id);
            // console.log(editButton);
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
                let isinama = parent.querySelector('.nama').textContent;
                let isialamat = parent.querySelector('.alamat').textContent;
                let isilogo = parent.querySelector('.logo .img').getAttribute('src');
                let namaInstansi = document.getElementById('nama_instansi');
                let Alamat = document.getElementById('alamat');
                let logoInput = document.getElementById('logo'); // tambahkan deklarasi untuk elemen input logo

                btnSimpan.textContent = 'Simpan';
                cardTitle.textContent = 'Edit Data Instansi';
                namaInstansi.value = isinama;
                Alamat.value = isialamat;
                logoImage.src = isilogo;

                let editButtonElement = document.getElementById('btn-simpan');

                editButtonElement.addEventListener('click', (e) => {
                    const nama_instansi = namaInstansi.value;
                    const alamat = Alamat.value;

                    e.preventDefault();

                    // Buat objek FormData untuk menyimpan data form
                    const formData = new FormData();
                    formData.append('nama_instansi', nama_instansi);
                    formData.append('alamat', alamat);
                    formData.append('logo', logoInput.files[0]);
                    formData.append('_method', 'PUT');
                    console.log("Data yang akan dikirim:", {
                        nama_instansi,
                        alamat,
                        logo: logoInput.files[0]
                    });
                    fetch(`${url}/${id}`, {
                            method: 'POST',
                            body: formData, // kirim formData sebagai body request
                            headers: {
                                // "Content-type": "application/json; charset=UTF-8",
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                                "Accept": "application/json",
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                console.error('Respons tidak berhasil:', response);
                                throw new Error('Terjadi kesalahan saat mengirim data.');
                            }
                            return response.json();
                        })
                        .then(responseData => {
                            console.log('Data respons dari server:', responseData);
                            alert("Data berhasil diedit");
                            location.reload();

                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert("gagal mengedit data, periksa kembali data instansi!!");
                        });
                });
            }



        })

        // Tambahkan event listener untuk mengubah gambar saat pengguna memilih file baru
        logoInput.addEventListener('change', function() {
            const selectedFile = this.files[0];
            const objectURL = URL.createObjectURL(selectedFile);
            logoImage.src = objectURL;
        });
    </script>
@endsection
