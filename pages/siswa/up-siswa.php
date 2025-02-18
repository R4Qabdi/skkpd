<?php
    $ceknis = $_GET['nis'];
    if(isset($_POST['submit'])){

        $absen = $_POST['absen'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $kelas = $_POST['kelas'];
        $angkatan = $_POST['angkatan'];
        $jurusan = $_POST['jurusan'];

        $result = mysqli_query($koneksi, "UPDATE tb_siswa SET absen='$absen', nama_siswa='$nama', telp='$telp', email='$email', kelas='$kelas', angkatan='$angkatan', id_jurusan='$jurusan' where nis='$ceknis'");
        
        $pass = $_POST['pass'];
        $konpass = $_POST['konpass'];
        if ($pass != '' || $konpass != '' ){
            if($pass==$konpass){
                $hashed = password_hash($pass , PASSWORD_DEFAULT);
                $result = mysqli_query($koneksi, "UPDATE tb_pengguna SET password='$hashed' WHERE nis = '$ceknis'");
            }else{
                $result = 0;
                echo"<script>alert('Password dan Konfirmasi password harus sama');</script>";
            }
        }
        if($result){
            echo"<script>alert('data berhasil diupdate');window.location.href='dashboard.php?page=re-siswa';</script>";
        }else{
            echo"<script>alert('data gagal diupdate');window.location.href='dashboard.php?page=up-siswa&&".$nis."';</script>";
        }
    }
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col">
            <form action="" method="post">
                <?php
                $ceknis = $_GET['nis'];
                $data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM tb_siswa INNER JOIN tb_jurusan USING(id_jurusan) WHERE nis='$ceknis'"));
                ?>
                <div class="mb-3">
                    <label for="" class="form-label">NIS</label>
                    <input value="<?=$data['nis']?>" type="number" class="form-control" name="nis" id=""
                        aria-describedby="emailHelpId" placeholder="NIS" disabled />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Absen</label>
                    <input type="number" class="form-control" name="absen" id="" aria-describedby="helpId"
                        placeholder="nomor absen" value="<?=$data['absen']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nama siswa</label>
                    <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId" placeholder=""
                        value="<?=$data['nama_siswa']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nomor Telepon </label>
                    <input type="text" class="form-control" name="telp" id="" aria-describedby="helpId"
                        placeholder="no. telp" value="<?=$data['telp']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" aria-describedby="helpId"
                        placeholder="Email" value="<?=$data['email']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="kelas" id="" aria-describedby="helpId"
                        placeholder="X DKV 1" value="<?=$data['kelas']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Angkatan</label>
                    <input type="text" class="form-control" name="angkatan" id="" aria-describedby="helpId"
                        placeholder="2024/2025" value="<?=$data['angkatan']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jurusan</label>
                    <select class="form-select form-select-lg" name="jurusan" id="">
                        <option>Pilih jurusan</option>
                        <?php
                         
                        
                        $data_jurusan = mysqli_query($koneksi, "SELECT * from tb_jurusan");
                        
                        while($dataj = mysqli_fetch_assoc($data_jurusan)){
                        ?>
                        <option value="<?=$dataj['id_jurusan']?>" <?php
                        if($data['id_jurusan']==$dataj['id_jurusan']){
                            echo"selected";
                        }
                        ?>><?=$dataj['jurusan']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="text" class="form-control" name="pass" id="" aria-describedby="emailHelpId"
                        placeholder="Password" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Konfirmasi Password</label>
                    <input type="text" class="form-control" name="konpass" id="" aria-describedby="emailHelpId"
                        placeholder="Konfirmasi Password" />
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