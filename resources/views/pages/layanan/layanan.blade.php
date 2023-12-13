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
                    <div class="card-body all-icons">
                        <div class="row">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Layanan</th>
                                        <th>Nama Instansi</th>
                                        <th>Kode Layanan</th>
                                        <th class="text-right" style="text-align-last: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table">


                                </tbody>
                            </table>
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
                        <h3 class="card-title">Tambah Layanan</h3>
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
                                        <option></option>
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


                        <button type="submit" class="btn btn-primary m-2" style=" float: right;">Tambah</button>

                    </form>
                    <a href="{{ url('/layanan') }}"> <button class="btn btn-warning btn-simple m-2" style=" float: left;">
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
        const NamaBarang = document.getElementById("inputnama");
        const FormTambah = document.querySelector(".btn-formtambah");
        const Kirimdata = document.querySelector(".form")


        const showSection = document.getElementById('showSection');
        const formSection = document.getElementById('formSection');
        const InstansiDropdown = document.getElementById('inputinstansi');
        // Fungsi untuk menyembunyikan bagian Edit dan menampilkan bagian Data Barang

        function showData() {
            showSection.style.display = 'block';
            formSection.style.display = 'none';
        }

        // Fungsi untuk menyembunyikan bagian Data Barang dan menampilkan bagian Edit
        function showForm() {
            showSection.style.display = 'none';
            formSection.style.display = 'block';
        }

        fetch(url)
            .then((res) => res.json())
            .then((data) => {
                data.data.forEach(layanan => {
                    // console.log(databarang);
                    output +=
                        `
                        <tr class="tr">
                            <td class="text-center">${no++}</td>
                            <td>${layanan.nama_layanan}</td>
                            <td>${layanan.instansi.nama_instansi}</td>
                            <td>${layanan.kode_layanan}</td>
                            <td class="td-actions text-right" style="text-align-last: center;">
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
                });
        });

        // Fetch kategori barang dari API dan isi dropdown
        fetch('http://localhost:8000/api/instansi')
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
            // console.log(editButton);
            if (deleteButton) {
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
            if (editButton) {
                showForm();
                const parent = event.target.closest('.tr');
                console.log(parent);

                // Assuming you have a select element with the ID 'inputsupplier'


                // Assuming 'isikategoribarang' is a comma-separated string of kategoribarang names
                let isikategoribarang = parent.querySelector('.kategori').textContent;

                // Split 'isikategoribarang' into an array of kategoribarang names
                let kategoribarangArray = isikategoribarang.split(',');

                // // Assuming 'isisupplier' is a comma-separated string of supplier names
                let isisupplier = parent.querySelector('.supplier').textContent;

                // // Split 'isisupplier' into an array of supplier names
                let supplierArray = isisupplier.split(',');


                // console.log("ID Supplier: ", supplierDropdown.value);
                let isinama = parent.querySelector('.nama').textContent;
                let isijumlah = parent.querySelector('.jumlah').textContent;
                NamaBarang.value = isinama;
                Jumlah.value = isijumlah;
                let editButtonElement = document.getElementById('btn-simpan');


                console.log(id);

                editButtonElement.addEventListener('click', (e) => {

                    e.preventDefault();
                    const selectedKategori = InstansiDropdown.value;
                    const selectedSupplier = supplierDropdown.value;

                    // Memastikan kategori barang dan supplier terpilih
                    if (!selectedKategori || !selectedSupplier) {
                        alert("Silakan pilih kategori barang dan supplier.");
                        return;
                    }
                    console.log(NamaBarang.value);
                    console.log(selectedKategori);
                    console.log(selectedSupplier);
                    console.log(Jumlah.value);
                    fetch(`${url}/${id}`, {
                            method: 'PUT',
                            body: JSON.stringify({
                                nama_barang: NamaBarang.value,
                                id_kategori_barang: selectedKategori,
                                id_supplier: selectedSupplier,
                                jumlah_barang: Jumlah.value,
                            }),
                            headers: {
                                "Content-type": "application/json; charset=UTF-8"
                            }
                        })
                        .then(res =>
                            res.json()
                        )
                        .then(responseData => {
                            alert("Data berhasil diedit");
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                        });
                });

            }


        })
    </script>
@endsection
