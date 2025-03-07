<?php
if (isset($_GET['nis'])){
    
    $ceknis = $_GET['nis'];
    $result = mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE nis='$ceknis'");
    $resultp = mysqli_query($koneksi, "DELETE FROM tb_pengguna where nis='$ceknis'");
    if($result * $resultp){
        echo "<script>alert('data berhasil dihapus!'); window.location.href = 'dashboard.php?page=re-siswa';</script>";
    }else{
        echo "<script>alert('data gagal dihapus!'); window.location.href = 'dashboard.php?page=re-siswa';</script>";
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-12 text-center mb-4">
            <a name="" id="" class="btn btn-success" href="dashboard.php?page=in-siswa" role="button">Tambah data</a>
        </div>
        <?php
        $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa INNER JOIN tb_jurusan USING(id_jurusan)");
        while ($data = mysqli_fetch_assoc($data_siswa)){
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?= htmlspecialchars($data['nama_siswa']) ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <strong>NIS:</strong> <?= htmlspecialchars($data['nis']) ?><br>
                        <strong>Absen:</strong> <?= htmlspecialchars($data['absen']) ?><br>
                        <strong>Telp:</strong> <?= htmlspecialchars($data['telp']) ?><br>
                        <strong>Email:</strong> <?= htmlspecialchars($data['email']) ?><br>
                        <strong>Kelas:</strong> <?= htmlspecialchars($data['kelas']) ?><br>
                        <strong>Angkatan:</strong> <?= htmlspecialchars($data['angkatan']) ?><br>
                        <strong>Jurusan:</strong> <?= htmlspecialchars($data['jurusan']) ?>
                    </p>
                    <?php
                    $ceknis = $data['nis'];
                    $resultsertif = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_sertifikat USING(nis) where nis = '$ceknis'");
                    $resultuser = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_pengguna USING(nis) where nis = '$ceknis'");
                    if(mysqli_num_rows($resultuser)>0 && mysqli_num_rows($resultsertif)>0){
                    ?>
                    <a name="" id="" class="btn btn-danger" href="" role="button"
                        onclick="return alert('hapus data sertifikat dan data pengguna terlebih dahulu')">Delete</a>
                    <?php
                    }else if(mysqli_num_rows($resultsertif)>0){
                    ?>
                    <a name="" id="" class="btn btn-danger" href="" role="button"
                        onclick="return alert('hapus data sertifikat terlebih dahulu')">Delete</a>
                    <?php
                    }else if(mysqli_num_rows($resultuser)>0){
                    ?>
                    <a name="hapus" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-siswa&&nis=<?= htmlspecialchars($data['nis']) ?>" role="button"
                        onclick="return confirm('apakah anda yakin untuk menghapus data beserta pengguna ini?')">Delete</a>
                    <?php
                    }else{
                    ?>
                    <a name="hapus" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-siswa&&nis=<?= htmlspecialchars($data['nis']) ?>" role="button"
                        onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                    <?php
                    }
                    ?>
                    <a id="" class="btn btn-warning"
                        href="dashboard.php?page=up-siswa&&nis=<?= htmlspecialchars($data['nis']) ?>"
                        role="button">Update</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="mb-5"></div>