<?php
$key = $_GET['kode'];
if (isset($_POST['submit'])){
    echo $id = $_POST['id'];
    echo $jenis = $_POST['jenis'];
    echo $kredit = $_POST['kredit'];
    echo $id_kategori = $_POST['kategori'];
    
    $result = mysqli_query($koneksi, "UPDATE tb_kegiatan SET id_kegiatan = '$id', jenis_kegiatan = '$jenis', angka_kredit = '$kredit', id_kategori = '$id_kategori' WHERE id_kegiatan = '$key'");

    if ($result){
        echo "<script>alert('data berhasil masuk'); window.location.href = 'dashboard.php?page=re-kategori-kegiatan'; </script>";
    }else{
        echo "<script>alert('data gagal masuk');window.location.href = 'dashboard.php?page=re-kategori-kegiatan'; </script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="" method="post">
                <?php
                $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kegiatan INNER JOIN tb_kategori USING(id_kategori) where id_kegiatan = '$key'"));
                ?>
                <div class="mb-3">
                    <label for="" class="form-label">ID Kegiatan</label>
                    <input value="<?=$data['id_kegiatan']?>" type="text" class="form-control" name="id" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Kegiatan</label>
                    <input value="<?=$data['jenis_kegiatan']?>" type="text" class="form-control" name="jenis" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Angka Kredit</label>
                    <input value="<?=$data['angka_kredit']?>" type="number" class="form-control" name="kredit" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">ID Kategori</label>
                    <select class="form-select form-select-lg" name="kategori" id="">
                        <?php
                        $data_kategori = mysqli_query($koneksi, "SELECT id_kategori,kategori FROM tb_kategori");
                        while($datak=mysqli_fetch_assoc($data_kategori)){
                        ?>
                        <option value="<?=$datak['id_kategori']?>" <?php
                        if($data['id_kategori'] == $datak['id_kategori']){
                            echo "selected";
                        }
                        ?>><?=$datak['kategori']?></option>
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