<?php
if (isset($_POST['submit'])){
    
    $random = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 3);
    $kode = $random;
    $nama = substr($_POST['nama'], 0, 64);
    $user = substr($_POST['user'], 0, 32);
    $pass = substr($_POST['pass'], 0, 64);
    $kpass = substr($_POST['kpass'], 0, 64);
    if ($pass == $kpass){
        $hashedpass = password_hash($pass , PASSWORD_DEFAULT);
    }

    $resulto = mysqli_query($koneksi, "INSERT INTO tb_operator VALUES ('$kode','$nama','$user')");
    $resultp = mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES (null,'$user',null,'$hashedpass')");
    if ($resulto * $resultp){
        echo "<script>alert('data berhasil masuk');window.location.href = 'dashboard.php?page=home'; </script>";
    }else{
        echo "<script>alert('data gagal masuk');window.location.href = 'dashboard.php?page=home'; </script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Input Data Operator</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" maxlength="64"
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Username</label>
                            <input type="text" class="form-control" name="user" id="user" maxlength="32"
                                placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" id="pass" maxlength="64"
                                placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="kpass" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="kpass" id="kpass" maxlength="64"
                                placeholder="Konfirmasi Password" required>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>