@extends('layouts.main2')
@section('title', 'Tambah Data Pembayaran')

@section('content')
<div class="container mt-5">
    <h3 class="text-center"><strong>Tambah Data Pembayaran</strong></h3>
    <form action="/pembayaran/store" method="POST">
        @csrf

        <!-- ID Instansi -->
        <div class="form-group">
            <label for="id_instansi">Kode Instansi</label>
            <input type="text" name="id_instansi" id="id_instansi" class="form-control" placeholder="Masukkan Kode Instansi" required>
        </div>

        <!-- ID Detail Tagihan -->
        <div class="form-group">
            <label for="id_dtl_tagihan">Detail Tagihan</label>
            <input type="text" name="id_dtl_tagihan" id="id_dtl_tagihan" class="form-control" placeholder="Masukkan ID Detail Tagihan" required>
        </div>

        <!-- ID Mahasiswa -->
        <div class="form-group">
            <label for="id_mahasiswa">NIM</label>
            <input type="text" name="id_mahasiswa" id="id_mahasiswa" class="form-control" placeholder="Masukkan NIM" required>
        </div>

        <!-- Periode -->
        <div class="form-group">
            <label for="periode">Periode</label>
            <select name="periode" id="periode" class="form-control" required>
                <option value="">-- Pilih Periode --</option>
                <option value="GASAL">GASAL</option>
                <option value="GENAP">GENAP</option>
            </select>
        </div>

        <!-- ICE -->
        <div class="form-group">
            <label>ICE</label>
            <div class="d-flex">
                <div class="form-check me-4">
                    <input type="radio" name="ice" id="ice_mengambil" value="Mengambil" class="form-check-input" required>
                    <label for="ice_mengambil" class="form-check-label">Mengambil</label>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-check">
                    <input type="radio" name="ice" id="ice_tidak_mengambil" value="Tidak Mengambil" class="form-check-input">
                    <label for="ice_tidak_mengambil" class="form-check-label">Tidak Mengambil</label>
                </div>
            </div>
        </div>

        <!-- SKS -->
        <div class="form-group">
            <label for="sks">SKS</label>
            <input type="number" name="sks" id="sks" class="form-control" placeholder="Masukkan Jumlah SKS" required>
        </div>

        <!-- Potongan Prestasi -->
<div class="form-group">
    <label>Potongan Prestasi (Akademik/Non Akademik)</label>
    <div class="d-flex">
        <div class="form-check me-4">
            <input type="radio" name="potongan_prestasi" id="potongan_ya" value="Iya" class="form-check-input" required>
            <label for="potongan_ya" class="form-check-label">Iya</label>
        </div>
        &nbsp;&nbsp;&nbsp;
        <div class="form-check">
            <input type="radio" name="potongan_prestasi" id="potongan_tidak" value="Tidak" class="form-check-input">
            <label for="potongan_tidak" class="form-check-label">Tidak</label>
        </div>
    </div>
</div>

<!-- Denda -->
<div class="form-group">
    <label>Denda</label>
    <div class="d-flex">
        <div class="form-check me-4">
            <input type="radio" name="denda" id="denda_ya" value="Iya" class="form-check-input" required>
            <label for="denda_ya" class="form-check-label">Iya</label>
        </div>
        &nbsp;&nbsp;&nbsp;
        <div class="form-check">
            <input type="radio" name="denda" id="denda_tidak" value="Tidak" class="form-check-input">
            <label for="denda_tidak" class="form-check-label">Tidak</label>
        </div>
    </div>
</div>

        <!-- Tanggal Jatuh Tempo -->
        <div class="form-group">
            <label for="tgl_jth_tempo">Tanggal Jatuh Tempo</label>
            <input type="date" name="tgl_jth_tempo" id="tgl_jth_tempo" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Belum Dibayar">Belum Dibayar</option>
                <option value="Dibayar">Dibayar</option>
            </select>
        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Masukkan Deskripsi"></textarea>
        </div>

        <!-- Jumlah Tagihan -->
        <div class="form-group">
            <label for="jmlh_tgh">Jumlah Tagihan</label>
            <input type="number" name="jmlh_tgh" id="jmlh_tgh" class="form-control" placeholder="Jumlah Tagihan Akan Dihitung Otomatis" readonly>
        </div>

        <button type="submit" class="btn btn-success mt-4">Simpan</button>
        <button type="reset" class="btn btn-danger mt-4">Reset</button>
    </form>
</div>

<script>
    document.getElementById('id_dtl_tagihan').addEventListener('blur', function () {
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
            body: JSON.stringify({ id_dtl_tagihan: idDtlTagihan }),
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
</script>
@endsection
