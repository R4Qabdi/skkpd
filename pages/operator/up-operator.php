<?php
if (isset($_POST['submit'])){
    $getkode = $_GET['kode'];
     
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $user = $_POST['user'];

    $result = mysqli_query($koneksi, "UPDATE tb_operator SET kode_operator='$getkode',nama_lengkap='$nama',username='$user' WHERE kode_operator = '$getkode'");

    if ($result){
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
                    <label for="" class="form-label">Kode Operator</label>
                    <input type="text" class="form-control" name="kode" id="" aria-describedby="helpId" placeholder=""
                        value="<?=$data['kode_operator']?>" disabled />
                </div>
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
                <button name="submit" type="submit" class="btn btn-primary">
                    Submit
                </button>

            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>