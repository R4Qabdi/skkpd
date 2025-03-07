<?php
    if(isset($_POST['submit'])){
        $nis = $_COOKIE['nis'];
        $pass = $_POST['pass'];
        $konpass = $_POST['konpass'];
        if($pass == $konpass){
            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            $query = mysqli_query($koneksi, "UPDATE tb_pengguna SET password='$hashed' WHERE nis='$nis'");
            if($query){
                echo "<script>alert('Password berhasil diubah');window.location.href='dashboard.php?page=home';</script>";
            }else{
                echo "<script>alert('Password gagal diubah');window.location.href='dashboard.php?page=pass';</script>";
            }
        }else{
            echo "<script>alert('Password tidak sama')</script>";
        }
    }

?>

<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Password Baru</label>
                    <input type="text" class="form-control" name="pass" id="" aria-describedby="emailHelpId" required />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Konfirmasi Password</label>
                    <input type="text" class="form-control" name="konpass" id="" aria-describedby="emailHelpId"
                        required />
                </div>
                <button type="submit" class="btn btn-primary" name="submit">
                    Submit
                </button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<div class="m-5 p-5"></div>