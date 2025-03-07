<?php
if (isset($_POST['submit'])){
    
    $random = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 3);
    $kode = $random;
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $kpass = $_POST['kpass'];
    if ($pass==$kpass){
        $hashedpass = password_hash($pass , PASSWORD_DEFAULT);
    }

    $resulto = mysqli_query($koneksi, "INSERT INTO tb_operator VALUES ('$kode','$nama','$user')");
    $resultp = mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES (null,'$user',null,'$hashedpass')");
    if ($resulto*$resultp){
        echo "<script>window.location.href = 'alert('data berhasil masuk');dashboard.php?page=re-operator'; </script>";
    }else{
        echo "<script>window.location.href = 'alert('data gagal masuk');dashboard.php?page=re-operator'; </script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" name="user" id="" aria-describedby="helpId"
                        placeholder="" />
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