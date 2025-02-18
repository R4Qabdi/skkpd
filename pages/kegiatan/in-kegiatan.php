<?php
if (isset($_POST['submit'])){
    echo $id = $_POST['id'];
    echo $jenis = $_POST['jenis'];
    echo $kredit = $_POST['kredit'];
    echo $id_kategori = $_POST['kategori'];
    
    $result = mysqli_query($koneksi, "INSERT INTO tb_kegiatan VALUES ('$id','$jenis','$kredit','$id_kategori')");

    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-kegiatan'; alert('data berhasil masuk')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-kegiatan'; alert('data gagal masuk')</script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID Kegiatan</label>
                    <input type="text" class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Kegiatan</label>
                    <input type="text" class="form-control" name="jenis" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Angka Kredit</label>
                    <input type="number" class="form-control" name="kredit" id="" aria-describedby="helpId"
                        placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">ID Kategori</label>
                    <select class="form-select form-select-lg" name="kategori" id="">
                        <option selected>pilih id kategori</option>
                        <?php
                        $data_kategori = mysqli_query($koneksi, "SELECT kategori,id_kategori FROM tb_kategori");
                        while($data =mysqli_fetch_assoc($data_kategori)){
                        ?>
                        <option value="<?=$data['id_kategori']?>"><?=$data['kategori']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>