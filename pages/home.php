<?php
// Get the counts
$siswaCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_siswa"))['count'];
$jurusanCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_jurusan"))['count'];
$kegiatanCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_kegiatan INNER JOIN tb_kategori USING(id_kategori)"))['count'];
$sertifikatCount = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_sertifikat WHERE status='menunggu validasi'"))['count'];
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
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Jumlah Siswa</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $siswaCount ?></h5>
                    <p class="card-text">Total siswa yang terdaftar.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Jumlah Jurusan</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $jurusanCount ?></h5>
                    <p class="card-text">Total jurusan yang tersedia.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Jumlah Kegiatan</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $kegiatanCount ?></h5>
                    <p class="card-text">Total kegiatan berdasarkan kategori.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Sertifikat Menunggu Validasi</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $sertifikatCount ?></h5>
                    <p class="card-text">Total sertifikat yang menunggu validasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-5 p-5"></div>