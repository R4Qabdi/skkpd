<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <!-- <div class="col-4"></div>
        <div class="col-4">
            <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-siswa" role="button">Tambah
                data</a>
        </div>
        <div class="col-4"></div> -->
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
                $result = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_sertifikat USING(nis) where nis = '$ceknis'");
                if(!mysqli_num_rows($result)>0){
                ?>
                <a name="hapus" id="" class="btn btn-danger" href="dashboard.php?page=re-siswa&&nis=<?=$data['nis']?>"
                    role="button" onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">delete</a>
                <?php
                }else{
                ?>
                <a name="" id="" class="btn btn-danger" href="" role="button"
                    onclick="return alert('hapus data sertifikat terlebih dahulu')">delete</a>
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