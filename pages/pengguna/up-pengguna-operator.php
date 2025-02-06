<?php
$id=$_GET['kode'];

if (isset($_POST['submit-op'])){
     
    echo $id = $_POST['id'];
    echo $user = $_POST['user'];
    echo $pass = $_POST['pass'];

    $result = mysqli_query($koneksi, "UPDATE tb_pengguna SET id_pengguna='$id', username='$user', password='pass' WHERE id_pengguna = '$id' ");

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
                <?php
                $dataf = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_pengguna WHERE id_pengguna='$id'"));
                ?>
                <div class="mb-3">
                    <label for="" class="form-label">ID Pengguna</label>
                    <input value="<?=$dataf['id_pengguna']?>" type="text" class="form-control" name="id" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <datalist id="user">
                        <?php
                        $data_user = mysqli_query($koneksi, "SELECT username FROM tb_operator");
                        while($data = mysqli_fetch_assoc($data_user)){
                        ?>
                        <option value="<?=$data['username']?>"></option>
                        <?php
                        }
                        ?>
                    </datalist>
                    <label for="" class="form-label">Username</label>
                    <input value="<?=$dataf['username']?>" type="text" list="user" class="form-control" name="user"
                        id="" aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input value="<?=$dataf['password']?>" type="text" class="form-control" name="pass" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <button name="submit-op" type="submit" class="btn btn-primary">
                    Submit operator
                </button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>