@extends('layouts/master')

@section('title', 'Layanan')

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
                        <h3 class="card-title">Data Layanan</h3>
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
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Logo</th>
                                        <th class="text-center">Nama Instansi</th>
                                        <th class="text-center">Nama Layanan</th>
                                        <th class="text-center">Kode Layanan</th>
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
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2 btn-formtambah" type="button">Tambah Layanan</button>
                            {{-- <button class="btn btn-primary" type="button">Button</button> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="formSection" style="display: none;">
        <div class="row m-2">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header mb-5">
                        <h3 class="card-title" id="card-title">Tambah Layanan</h3>
                    </div>
                    <form action="" method="" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label for="pre" class="col-sm-3 col-form-label">Nama Layanan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nama" id="nama_layanan"
                                        value="" placeholder="Nama Layanan" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="pre" class="col-sm-3 col-form-label">Nama Instansi</label>
                                <div class="col-sm-7">
                                    <select class="form-select" id="inputinstansi" aria-label="Default select example">
                                        <option data-id="1" value="" class=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="pre" class="col-sm-3 col-form-label">Kode Layanan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control " name="kode_layanan" id="kode_layanan"
                                        value="" placeholder="Kode Layanan" required autofocus>
                                </div>
                            </div>

                        </div>


                        <button type="submit" id="btn-simpan" class="btn btn-primary m-2"
                            style=" float: right;">Tambah</button>

                    </form>
                    <a href="{{ url('/layanan') }}"> <button class="btn btn-primary btn-simple m-2" style=" float: left;">
                            Kembali
                        </button></a>
                </div>
            </div>
        </div>
    </section>
    <script>
        const tabel = document.getElementById("table");
        const form = document.getElementById("form");
        const url = "http://localhost:8000/api/layanan"
        let output = '';
        let no = 1;
        const FormTambah = document.querySelector(".btn-formtambah");
        const Kirimdata = document.querySelector(".form")
        const cardTitle = document.getElementById('card-title');
        const btnSimpan = document.getElementById('btn-simpan');
        const showSection = document.getElementById('showSection');
        const formSection = document.getElementById('formSection');
        const InstansiDropdown = document.getElementById('inputinstansi');
        // Fungsi untuk menyembunyikan bagian Edit dan menampilkan bagian Data Barang
        const urlPagination = "http://localhost:8000/api/layanan/pagination"
        let currentPage = 1;
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const pageInfo = document.getElementById('page-info');

        function fetchData(page) {
            fetch(`${urlPagination}?page=${page}`)
                .then((res) => res.json())
                .then((data) => {
                    let output = '';
                    no = (currentPage - 1) * data.meta.pagination.per_page + 1;
                    data.data.forEach(layanan => {
                        output += `
                        <tr class="tr">
                            <td class="text-center">${no++}</td>
                            <td class="logo">
                                <div class="img-container" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <img class="img" src="${layanan.instansi.logo}" style="max-width: 100px; max-height: 100px;" alt="Logo Instansi">
                                </div>
                            </td>
                            <td class="nama_instansi text-center ">${layanan.instansi.nama_instansi}</td>
                            <td class="nama_layanan text-center">${layanan.nama_layanan}</td>
                            <td class="kode_layanan text-center">${layanan.kode_layanan}</td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" data-id=${ layanan.id } >
                                    <i id="edit-button" class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" data-id=${ layanan.id } >
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


        function searchLayanan() {
            let no = 1;
            var query = document.getElementById('search-bar').value;
            fetch('/api/layanan/search', {
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
                    data.data.forEach((layanan, index) => {
                        var row = `
                        <tr class="tr">
                            <td class="text-center">${no++}</td>
                            <td class="logo"><img class="img" src="${layanan.instansi.logo}" alt="Logo Instansi" style="max-width: 100px; max-height: 100px;"></td>
                            <td class="nama_instansi">${layanan.instansi.nama_instansi}</td>
                            <td class="nama_layanan">${layanan.nama_layanan}</td>
                            <td class="kode_layanan">${layanan.kode_layanan}</td>
                            <td class="td-actions text-right" style="text-align-last: center;">
                                <a href="" data-id=${ layanan.id } >
                                    <i id="edit-button" class="bi bi-pencil-square fs-2"></i>
                                </a>
                                <a href="" data-id=${ layanan.id } >
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

        function showData() {
            showSection.style.display = 'block';
            formSection.style.display = 'none';
        }

        // Fungsi untuk menyembunyikan bagian Data Barang dan menampilkan bagian Edit
        function showForm() {
            showSection.style.display = 'none';
            formSection.style.display = 'block';
        }



        FormTambah.addEventListener('click', (e) => {
            e.preventDefault();
            showForm();
        });

        Kirimdata.addEventListener('submit', function(event) {
            event.preventDefault();

            const selectedInstansi = InstansiDropdown.value;



            if (!selectedInstansi) {
                alert("Silakan pilih kategori barang ");
                return;
            }
            const NamaLayanan = document.getElementById("nama_layanan").value;
            const KodeLayanan = document.getElementById("kode_layanan").value;
            const formData = new FormData();
            formData.append('id_instansi', selectedInstansi);
            formData.append('nama_layanan', NamaLayanan);
            formData.append('kode_layanan', KodeLayanan);

            // const nama_layanan = NamaLayanan.value;
            // const kode_layanan = KodeLayanan.value;
            console.log("Data yang akan dikirim:", {
                selectedInstansi,
                NamaLayanan,
                KodeLayanan
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
                    console.log('Data respons dari server:', data);
                    alert("Data berhasil dikirim");
                    location.reload();
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    alert("gagal mengirim data, periksa kembali data layanan!!")
                });
        });

        // Fetch kategori barang dari API dan isi dropdown
        fetch('http://localhost:8000/api/getall-instansi')
            .then(response => response.json())
            .then(data => {
                InstansiDropdown.innerHTML = ''; // Membersihkan opsi yang ada
                data.data.forEach(instansi => {
                    let option = document.createElement('option');
                    option.value = instansi.id;
                    option.text = instansi.nama_instansi;
                    InstansiDropdown.add(option);
                });
            })
            .catch(error => {
                console.error('Error fetching kategoribarangs:', error);
            });


        tabel.addEventListener('click', event => {
            // console.log(event.target.id);
            event.preventDefault();
            let editButton = event.target.id == 'edit-button';
            let deleteButton = event.target.id == 'delete-button';


            let id = event.target.parentElement.dataset.id;
            console.log(id);
            if (deleteButton) {
                if (confirm("apakah anda yakin ingin menghapusnya?")) {
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
                console.log(parent);

                let isiInstansi = parent.querySelector('.nama_instansi').textContent;

                let Instansi = isiInstansi.split(',');

                let isiNamalayanan = parent.querySelector('.nama_layanan').textContent;
                let isiKodelayanan = parent.querySelector('.kode_layanan').textContent;
                const NamaLayanan = document.getElementById("nama_layanan");
                const KodeLayanan = document.getElementById("kode_layanan");
                NamaLayanan.value = isiNamalayanan;
                KodeLayanan.value = isiKodelayanan;
                let editButtonElement = document.getElementById('btn-simpan');

                btnSimpan.textContent = 'simpan';
                cardTitle.textContent = 'edit data layanan';


                editButtonElement.addEventListener('click', (e) => {

                    e.preventDefault();
                    const selectedInstansi = InstansiDropdown.value;

                    // Memastikan Instansi barang dan supplier terpilih
                    if (!selectedInstansi) {
                        alert("Silakan pilih Instansi barang dan supplier.");
                        return;
                    }
                    // console.log(id);
                    // console.log(NamaLayanan.value);
                    // console.log(selectedInstansi);
                    // console.log(KodeLayanan.value);
                    fetch(`${url}/${id}`, {
                            method: 'PUT',
                            body: JSON.stringify({
                                id_instansi: selectedInstansi,
                                nama_layanan: NamaLayanan.value,
                                kode_layanan: KodeLayanan.value,
                            }),
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                                "Accept": "application/json",
                                "Content-type": "application/json; charset=UTF-8"
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
                            alert("Data berhasil diedit");
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert("gagal mengedit data, periksa kembali data layanan!!")
                        });
                });

            }


        })
    </script>
@endsection
