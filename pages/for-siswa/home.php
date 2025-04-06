<?php
// Get the counts
$siswaCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_siswa"))['count'];
$jurusanCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_jurusan"))['count'];
$kegiatanCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_kegiatan INNER JOIN tb_kategori USING(id_kategori)"))['count'];
$sertifikatCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_sertifikat WHERE status='menunggu validasi'"))['count'];
$kategoriCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_kategori"))['count'];
?>

<div class="container-lg mt-5">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col text-center">
            <h1>
                Selamat Datang
                <?=@$_COOKIE['username']?>
                <?php
                if(@$_COOKIE['nis']){
                    $nama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_siswa FROM tb_siswa WHERE nis='$_COOKIE[nis]'"))['nama_siswa'];
                    echo $nama;
                }
                ?>
            </h1>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php
if (@$_COOKIE['nis']) {
    $nis = $_COOKIE['nis'];
    $totalSertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_sertifikat WHERE nis='$nis'"))['count'];
    $validSertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_sertifikat WHERE nis='$nis' AND status='valid'"))['count'];
    $tidakValidSertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_sertifikat WHERE nis='$nis' AND status='tidak valid'"))['count'];
    $menungguValidasiSertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_sertifikat WHERE nis='$nis' AND status='menunggu validasi'"))['count'];
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Sertifikat</div>
                <div class="card-body">
                    <p class="card-text">Jumlah total sertifikat yang Anda miliki.</p>
                    <p class="card-text"><?= $totalSertifikat ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Sertifikat Valid</div>
                <div class="card-body">
                    <p class="card-text">Jumlah sertifikat Anda yang telah divalidasi.</p>
                    <p class="card-text"><?= $validSertifikat ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Sertifikat Tidak Valid</div>
                <div class="card-body">
                    <p class="card-text">Jumlah sertifikat Anda yang tidak valid.</p>
                    <p class="card-text"><?= $tidakValidSertifikat ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Menunggu Validasi</div>
                <div class="card-body">
                    <p class="card-text">Jumlah sertifikat Anda yang sedang menunggu validasi.</p>
                    <p class="card-text"><?= $menungguValidasiSertifikat ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-5"></div>