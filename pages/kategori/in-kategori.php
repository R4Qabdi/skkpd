<?php
if (isset($_POST['submit'])){
     
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $sub = $_POST['sub'];

    $result = mysqli_query($koneksi, "INSERT INTO tb_kategori VALUES ('$id','$kategori','$sub')");

    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-kategori'; alert('data berhasil masuk')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-kategori'; alert('data gagal masuk')</script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID Kategori</label>
                    <input type="text" class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" />
                </div>
                <!-- jadikan option -->

                <div class="mb-3">
                    <label for="" class="form-label">kategori</label>
                    <select class="form-select form-select-lg" name="kategori" id="">
                        <option selected>Pilih Kategori</option>
                        <option value="wajib">Wajib</option>
                        <option value="opsional">Opsional</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sub Kategori</label>
                    <input type="text" class="form-control" name="sub" id="" aria-describedby="helpId" placeholder="" />
                </div>
                <button name="submit" type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>