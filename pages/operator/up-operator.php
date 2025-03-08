<?php
if (isset($_POST['submit'])){
    $getkode = $_GET['kode'];
    $userawal = $_GET['user'];
    
    $nama = substr($_POST['nama'], 0, 64);
    $user = substr($_POST['user'], 0, 32);
    $pass = substr($_POST['pass'], 0, 64);
    $konpass = substr($_POST['kpass'], 0, 64);
    
    $resultp=1;
    if ($pass != '' || $konpass != '' ){
        if($pass == $konpass){
            $hashed = password_hash($pass , PASSWORD_DEFAULT);
            $resultp = mysqli_query($koneksi, "UPDATE tb_pengguna SET password = '$hashed', username='$user' WHERE username = '$user'");
        }else{
            $result = 0;
            echo"<script>alert('Password dan Konfirmasi password harus sama');</script>";
        }
    }

    // Execute ALTER TABLE statements separately
    $alterDrop = mysqli_query($koneksi, "ALTER TABLE tb_pengguna DROP CONSTRAINT operator");
    $updateOperator = mysqli_query($koneksi, "UPDATE tb_operator SET nama_lengkap='$nama', username='$user' WHERE kode_operator = '$getkode'");
    $updatePengguna = mysqli_query($koneksi, "UPDATE tb_pengguna SET username='$user' WHERE username = '$userawal'");
    $alterAdd = mysqli_query($koneksi, "ALTER TABLE tb_pengguna ADD CONSTRAINT operator FOREIGN KEY (username) REFERENCES tb_operator(username)");

    if ($resultp && $alterDrop && $updateOperator && $updatePengguna && $alterAdd){
        if ($userawal !== $user){
            //logout
            setcookie('nis', '', time(), '/');
            setcookie('nama_lengkap', '', time(), '/');
            setcookie('level_user', 'siswa', time() , '/');
            setcookie('username', '', time(), '/');
            
            $user_operator = $user;
            $nama_operator = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_lengkap, username FROM tb_operator WHERE username = '$user_operator'"));
            setcookie('username', $nama_operator['username'], time() + (60 * 60 * 24 * 7), '/');
            setcookie('nama_lengkap', $nama_operator['nama_lengkap'], time() + (60 * 60 * 24 * 7), '/');
            setcookie('level_user', 'operator', time() + (60 * 60 * 24 * 7), '/');
            echo "<script>alert('berhasil');window.location.href='dashboard.php?page=home';</script>";
        }
        echo "<script>alert('data berhasil masuk');window.location.href = 'dashboard.php?page=re-operator'; </script>";
    }else{
        echo "<script> alert('data gagal masuk');window.location.href = 'dashboard.php?page=re-operator';</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Update Data Operator</h3>
                    <form action="" method="post">
                        <?php
                        $getkode = $_GET['kode'];
                        $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_operator WHERE kode_operator = '$getkode'"));
                        ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" maxlength="64"
                                placeholder="Nama Lengkap" value="<?= htmlspecialchars($data['nama_lengkap']) ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Username</label>
                            <input type="text" class="form-control" name="user" id="user" maxlength="32"
                                placeholder="Username" value="<?= htmlspecialchars($data['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" id="pass" maxlength="64"
                                placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label for="kpass" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="kpass" id="kpass" maxlength="64"
                                placeholder="Konfirmasi Password">
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>