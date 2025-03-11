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
                <div class="card-header">
                    <h3 class="card-title">Data Pengunjung</h3>
                </div>
                <div class="container container-search mb-3">
                    <div class="search-container">
                        <input class="input" type="text" id="search-bar"
                            placeholder="Search Berdasarkan Nama Pengunjung, username, email dan no handphone"
                            onkeypress="if(event.keyCode === 13) searchPengunjung()">
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
                                    <th>No HandPhone</th>
                                    <th>Email</th>
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
            </div>
        </div>
    </div>
    <script>
        const url = 'http://localhost:8000/api/pengunjung/pagination';
        const tabel = document.getElementById('table');
        let currentPage = 1;
        let no = 1;



        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const pageInfo = document.getElementById('page-info');

        function fetchData(page) {
            fetch(`${url}?page=${page}`)
                .then((res) => res.json())
                .then((data) => {
                    let output = '';
                    no = (currentPage - 1) * data.meta.pagination.per_page + 1;
                    data.data.forEach(pengunjung => {

                        output += `
                        <tr>
                            <td class="text-center">${no++}</td>
                            <td>${pengunjung.name}</td>
                            <td>${pengunjung.username}</td>
                            <td>${pengunjung.no_hp}</td>
                            <td>${pengunjung.email}</td>
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

        // fungsi search
        function searchPengunjung() {
            let no = 1;
            var query = document.getElementById('search-bar').value;
            fetch('/api/pengunjung/search', {
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
                    data.data.forEach((pengunjung, index) => {
                        var row = `
                        <tr>
                            <td class="text-center">${no++}</td>
                            <td>${pengunjung.name}</td>
                            <td>${pengunjung.username}</td>
                            <td>${pengunjung.no_hp}</td>
                            <td>${pengunjung.email}</td>
                        </tr>
                        `;
                        document.getElementById('table').innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error('There was an error!', error);
                });
        }
    </script>
@endsection
