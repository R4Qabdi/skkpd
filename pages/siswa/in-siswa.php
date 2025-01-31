<?php
 
if(isset($_POST['submit'])){
    $nis = $_POST['nis'];
    if (strlen($nis)>4){
        //ignore
    }
    $absen = $_POST['absen'];
    if (strlen($absen)>4){
        //ignore
    }
    $nama = $_POST['nama'];
    if (strlen($absen)>4){
        //ignore
    }
    $telp = $_POST['telp'];
    if (strlen($absen)>4){
        //ignore
    }
    $email = $_POST['email'];
    if (strlen($absen)>4){
        //ignore
    }
    $kelas = $_POST['kelas'];
    if (strlen($absen)>4){
        //ignore
    }
    $angkatan = $_POST['angkatan'];
    if (strlen($absen)>4){
        //ignore
    }
    $jurusan = $_POST['jurusan'];

    // $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nis FROM tb_siswa"));
    // if($cek.has)
    if ($lancar = true){
        $resultsiswa = mysqli_query($koneksi, "INSERT INTO tb_siswa VALUES('$nis','$absen','$nama','$telp','$email','$kelas','$angkatan','$jurusan');");
        $pass_siswa = "siswa".$nis;
        $resultuser = mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES(null,null,'$nis','$pass_siswa')");
    }
    if ($resultsiswa == $resultuser){
        $result = true;
    }else{
        $result = false;
    }


    if ($result){
        echo"<script>window.location.href = 'dashboard.php?page=re-siswa'</script>";
    }else{
        echo"<script>alert('data gagal masuk'); window.location.href = 'dashboard.php?page=in-siswa'</script>";
        // if (false) {echo"gaguna";}
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">NIS</label>
                    <input type="number" class="form-control" name="nis" id="" aria-describedby="helpId"
                        placeholder="NIS" />
                    <?php
                        function nisp($msg,$con){
                        if ($con){
                    ?>
                    <small id="helpId" class="form-text text-muted"><?=$msg?></small>
                    <?php
                        }}
                    ?>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Absen</label>
                    <input type="number" class="form-control" name="absen" id="" aria-describedby="helpId"
                        placeholder="nomor absen" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nama siswa</label>
                    <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nomor Telepon </label>
                    <input type="text" class="form-control" name="telp" id="" aria-describedby="helpId"
                        placeholder="no. telp" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" aria-describedby="helpId"
                        placeholder="Email" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="kelas" id="" aria-describedby="helpId"
                        placeholder="X DKV 1" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Angkatan</label>
                    <input type="text" class="form-control" name="angkatan" id="" aria-describedby="helpId"
                        placeholder="2024/2025" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jurusan</label>
                    <select class="form-select form-select-lg" name="jurusan" id="">
                        <option selected>Pilih jurusan</option>
                        <?php
                         
                        
                        $data_jurusan = mysqli_query($koneksi, "SELECT * from tb_jurusan");
                        
                        while($data = mysqli_fetch_assoc($data_jurusan)){
                        ?>
                        <option value="<?=$data['id_jurusan']?>"><?=$data['jurusan']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>