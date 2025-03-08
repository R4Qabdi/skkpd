<?php
include "../koneksi.php";
if (isset($_POST['submit'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $result = mysqli_query($koneksi ,"SELECT * FROM tb_pengguna");

    $cek_operator = mysqli_query($koneksi, "SELECT username, password FROM tb_pengguna WHERE username='$user'");
    $data_operator = mysqli_fetch_assoc($cek_operator);
    
    $cek_siswa = mysqli_query($koneksi, "SELECT nis, password FROM tb_pengguna WHERE nis='$user'");
    $data_siswa = mysqli_fetch_assoc($cek_siswa);

    if(mysqli_num_rows($cek_operator) > 0){
        if(password_verify($pass, $data_operator['password'])){
            //logout
            setcookie('nis', '', time(), '/');
            setcookie('nama_lengkap', '', time(), '/');
            setcookie('level_user', 'siswa', time() , '/');
            setcookie('username', '', time(), '/');
            
            $user_operator = $user;
            $nama_operator = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_lengkap FROM tb_operator WHERE username = '$user_operator'"));
            setcookie('username', $data_operator['username'], time() + (60 * 60 * 24 * 7), '/');
            setcookie('nama_lengkap', $nama_operator['nama_lengkap'], time() + (60 * 60 * 24 * 7), '/');
            setcookie('level_user', 'operator', time() + (60 * 60 * 24 * 7), '/');
            echo "<script>alert('berhasil login sebagai operator');window.location.href='../dashboard.php?page=home';</script>";
        }
        else{
            echo "<script>alert('gagal login, cek password');window.location.href='../dashboard.php?page=home';</script>";
        }
    }
    if(mysqli_num_rows($cek_siswa) > 0){
        if(password_verify($pass, $data_siswa['password'])){
            //logout
            setcookie('nis', '', time(), '/');
            setcookie('nama_lengkap', '', time(), '/');
            setcookie('level_user', 'siswa', time() , '/');
            setcookie('username', '', time(), '/');
            
            $user_siswa = $user;
            $nama_siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_siswa FROM tb_siswa WHERE nis = '$user_siswa'"));
            setcookie('nis', $data_siswa['nis'], time() + (60 * 60 * 24 * 7), '/');
            setcookie('nama_lengkap', $nama_siswa['nama_siswa'], time() + (60 * 60 * 24 * 7), '/');
            setcookie('level_user', 'siswa', time() + (60 * 60 * 24 * 7), '/');
            echo "<script>alert('berhasil login sebagai siswa');window.location.href='../dashboard.php?page=home';</script>";
        }
        else{
            echo "<script>alert('gagal login, cek password, hubungi pegawai untuk mengubah password');window.location.href='login.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
    body {
        background-color: #f8f9fa;
    }

    .login-card {
        margin-top: 100px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card login-card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>