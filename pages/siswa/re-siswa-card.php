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
        <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-siswa" role="button">Tambah
            data</a>
        <?php
        $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa INNER JOIN tb_jurusan USING(id_jurusan)");
        while ($data = mysqli_fetch_assoc($data_siswa)){
        ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?=$data['nama_siswa']?></h5>
                <p class="card-text">
                    nis = <?=$data['nis']?><br>
                    absen = <?=$data['absen']?><br>
                    telp = <?=$data['telp']?><br>
                    email = <?=$data['email']?><br>
                    kelas = <?=$data['kelas']?><br>
                    angkatan = <?=$data['angkatan']?><br>
                    jurusan = <?=$data['jurusan']?>
                </p>
                <?php
                $ceknis = $data['nis'];
                $resultsertif = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_sertifikat USING(nis) where nis = '$ceknis'");
                $resultuser = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_pengguna USING(nis) where nis = '$ceknis'");
                if(mysqli_num_rows($resultuser)>0 && mysqli_num_rows($resultsertif)>0){
                ?>
                <a name="" id="" class="btn btn-danger" href="" role="button"
                    onclick="return alert('hapus data sertifikat dan data pengguna terlebih dahulu')">delete</a>
                <?php
                }else if(mysqli_num_rows($resultsertif)>0){
                ?>
                <a name="" id="" class="btn btn-danger" href="" role="button"
                    onclick="return alert('hapus data sertifikat terlebih dahulu')">delete</a>
                <?php
                }else if(mysqli_num_rows($resultuser)>0){
                ?>
                <a name="hapus" id="" class="btn btn-danger" href="dashboard.php?page=re-siswa&&nis=<?=$data['nis']?>"
                    role="button"
                    onclick="return confirm('apakah anda yakin untuk menghapus data beserta pengguna ini?')">delete</a>
                <?php
                }else{
                ?>
                <a name="hapus" id="" class="btn btn-danger" href="dashboard.php?page=re-siswa&&nis=<?=$data['nis']?>"
                    role="button" onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">delete</a>
                <?php
                }
                ?>
                <a id="" class="btn btn-warning" href="dashboard.php?page=up-siswa&&nis=<?=$data['nis']?>"
                    role="button">Update</a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>