<?php
if (isset($_POST['submit'])){
    $getkode = $_GET['kode'];
    
    $nama = $_POST['nama'];
    $user = $_POST['user'];

    $pass = $_POST['pass'];
    $konpass = $_POST['kpass'];

    if ($pass != '' || $konpass != '' ){
        if($pass==$konpass){
            $hashed = password_hash($pass , PASSWORD_DEFAULT);
            $resultp = mysqli_query($koneksi, "UPDATE tb_pengguna SET password = '$hashedpass',username='$user' WHERE username = '$user'");
        }else{
            $result = 0;
            echo"<script>alert('Password dan Konfirmasi password harus sama');</script>";
        }
    }
    
    $resulto = mysqli_query($koneksi, "UPDATE tb_operator SET nama_lengkap='$nama',username='$user' WHERE kode_operator = '$getkode'");
    if ($result*$resultp){
        echo "<script>window.location.href = 'dashboard.php?page=re-operator'; alert('data berhasil masuk')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-operator'; alert('data gagal masuk')</script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <?php
                $getkode = $_GET['kode'];
                $data=mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE kode_operator = '$getkode'"));
                ?>
                <div class="mb-3">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId" placeholder=""
                        value="<?=$data['nama_lengkap']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" name="user" id="" aria-describedby="helpId" placeholder=""
                        value="<?=$data['username']?>" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="text" class="form-control" name="pass" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Konfirmasi Password</label>
                    <input type="text" class="form-control" name="kpass" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <button name="submit" type="submit" class="btn btn-primary">
                    Submit
                </button>

            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>