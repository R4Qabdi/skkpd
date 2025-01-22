<?php
if (isset($_POST['submit'])){
     
    $id = $_POST['id'];
    $user = $_POST['user'];
    $nis = $_POST['nis'];
    $pass = $_POST['pass'];

    $result = mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES ('$id','$user','$nis')");

    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-pengguna'; alert('data berhasil masuk')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-pengguna'; alert('data gagal masuk')</script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID Pengguna</label>
                    <input type="text" class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" name="user" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <datalist></datalist>
                <div class="mb-3">
                    <label for="" class="form-label">NIS</label>
                    <input type="text" class="form-control" name="nis" id="" aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" id="" aria-describedby="helpId"
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