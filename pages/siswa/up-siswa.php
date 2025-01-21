<?php
include "koneksi.php";
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

        $result = mysqli_query($koneksi, "UPDATE tb_siswa SET nis='$nis',absen='$absen',nama_siswa='$nama',telp='$telp',email='$email',kelas='$kelas',angkatan='$angkatan',id_jurusan='$jurusan' where nis='$nis'");
        if($result){
            echo"<script>window.location.href='dashboard.php?page=re-siswa';alert('data berhasil diupdate');</script>";
        }else{
            echo"<script>window.location.href='dashboard.php?page=up-siswa&&".$nis."';alert('data gagal diupdate');</script>";
        }
    }
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col">
            <form action="" method="post">
                <?php
                include "koneksi.php";
                $nis=$_GET['nis'];
                $placeholder = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM tb_siswa INNER JOIN tb_jurusan USING(id_jurusan) WHERE nis='$nis'"));

                ?>
                <div class="mb-3">
                    <label for="" class="form-label">NIS</label>
                    <input type="number" class="form-control" name="nis" id="" aria-describedby="helpId"
                        placeholder="NIS" value="<?=$placeholder['nis']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Absen</label>
                    <input type="number" class="form-control" name="absen" id="" aria-describedby="helpId"
                        placeholder="nomor absen" value="<?=$placeholder['absen']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nama siswa</label>
                    <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId" placeholder=""
                        value="<?=$placeholder['nama_siswa']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nomor Telepon </label>
                    <input type="text" class="form-control" name="telp" id="" aria-describedby="helpId"
                        placeholder="no. telp" value="<?=$placeholder['telp']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" aria-describedby="helpId"
                        placeholder="Email" value="<?=$placeholder['email']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="kelas" id="" aria-describedby="helpId"
                        placeholder="X DKV 1" value="<?=$placeholder['kelas']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Angkatan</label>
                    <input type="text" class="form-control" name="angkatan" id="" aria-describedby="helpId"
                        placeholder="2024/2025" value="<?=$placeholder['angkatan']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jurusan</label>
                    <select class="form-select form-select-lg" name="jurusan" id="">
                        <option>Pilih jurusan</option>
                        <?php
                        include "koneksi.php";
                        
                        $data_jurusan = mysqli_query($koneksi, "SELECT * from tb_jurusan");
                        
                        while($data = mysqli_fetch_assoc($data_jurusan)){
                        ?>
                        <option value="<?=$data['id_jurusan']?>" <?php
                        if($data['id_jurusan']==$placeholder['id_jurusan']){
                            echo"selected";
                        }
                        ?>><?=$data['jurusan']?></option>
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