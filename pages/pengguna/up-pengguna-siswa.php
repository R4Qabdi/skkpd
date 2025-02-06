<?php
$id=$_GET['kode'];
if (isset($_POST['submit-sis'])){
     
    $id = $_POST['id'];
    $nis = $_POST['nis'];
    $pass = $_POST['pass'];

    $result = mysqli_query($koneksi, "UPDATE tb_pengguna SET id_pengguna='$id', nis='$nis', password='pass' WHERE nis='$nis' ");

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
                    <datalist id="nis">
                        <?php
                        $data_nis = mysqli_query($koneksi, "SELECT nis FROM tb_siswa");
                        while($data = mysqli_fetch_assoc($data_nis)){
                        ?>
                        <option value="<?=$data['nis']?>"></option>
                        <?php
                        }
                        ?>
                    </datalist>
                    <label for="" class="form-label">NIS</label>
                    <input value="<?=$dataf['nis']?>" type="text" class="form-control" name="nis" id="nis" list="nis"
                        aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input value="<?=$dataf['password']?>" type="text" class="form-control" name="pass" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <button name="submit-op" type="submit" class="btn btn-primary">
                    Submit operator
                </button>
                <button name="submit-sis" type="submit" class="btn btn-primary">
                    Submit siswa
                </button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>