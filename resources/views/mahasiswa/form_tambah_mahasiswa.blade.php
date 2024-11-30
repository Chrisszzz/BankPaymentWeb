@extends('layouts.main2')
@section('title', 'Form Tambah Mahasiswa')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center"><strong>Tambah Data Mahasiswa/i</strong></h3>
        <form action="/pembayaran/store" method="POST">
            @csrf

            <!-- NIM Mahasiswa -->
            <div class="form-group">
                <label>NIM Mahasiswa</label>
                <input type="text" name="nim_mahasiswa" class="form-control" placeholder="Masukkan NIM Mahasiswa" required>
            </div>

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
            </div>

            <!-- Angkatan -->
            <div class="form-group">
                <label>Angkatan</label>
                <select name="angkatan" class="form-control" required>
                    <option value="">-- Pilih Angkatan --</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>

            <!-- Jurusan -->
            <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" class="form-control" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                </select>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="d-flex">
                    <div class="form-check me-4">
                        <input type="radio" name="jenis_kelamin"  value="Laki-Laki" class="form-check-input"
                            required>
                        <label class="form-check-label">Laki-Laki</label>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                            class="form-check-input">
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>

    {{-- <script>
        document.getElementById('id_dtl_tagihan').addEventListener('blur', function() {
            const idDtlTagihan = this.value;
            const sks = document.getElementById('sks').value;
            const ice = document.querySelector('input[name="ice"]:checked')?.value;
            const potonganPrestasi = document.querySelector('input[name="potongan_prestasi"]:checked')?.value;
            const denda = document.querySelector('input[name="denda"]:checked')?.value;

            if (idDtlTagihan) {
                fetch(`/get-detail-tagihan`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            id_dtl_tagihan: idDtlTagihan
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const biayaSks = data.data.biaya_sks * sks;
                            const biayaIce = ice === 'Mengambil' ? data.data.biaya_ICE : 0;
                            const potongan = potonganPrestasi === 'Iya' ? data.data.potongan_prestasi : 0;
                            const biayaDenda = denda === 'Iya' ? data.data.hrg_denda : 0;

                            const jumlahTagihan =
                                biayaSks +
                                biayaIce +
                                data.data.biaya_kesehatan +
                                data.data.biaya_gedung -
                                potongan +
                                biayaDenda;

                            document.getElementById('jmlh_tgh').value = jumlahTagihan;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    </script> --}}
@endsection
