<?php
if (isset($_POST['submit'])){
     
    $id = $_POST['id'];
    $jurusan = $_POST['jurusan'];

    $result = mysqli_query($koneksi, "INSERT INTO tb_jurusan VALUES ('$id','$jurusan')");

    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data berhasil masuk')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data gagal masuk')</script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID Jurusan</label>
                    <input type="text" class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" id="" aria-describedby="helpId"
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