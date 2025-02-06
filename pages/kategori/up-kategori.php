<?php
$cekkey = $_GET['kode'];
if (isset($_POST['submit'])){
     
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $sub = $_POST['sub'];

    $result = mysqli_query($koneksi, "UPDATE tb_kategori SET id_kategori = '$id', kategori = '$kategori', sub_kategori = '$sub' WHERE id_kategori = '$cekkey'");
    
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
                <?php
                $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE id_kategori = '$cekkey'"));
                ?>
                <div class="mb-3">
                    <label for="" class="form-label">ID Kategori</label>
                    <input value="<?=$data['id_kategori']?>" type="text" class="form-control" name="id" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">kategori</label>
                    <select class="form-select form-select-lg" name="kategori" id="">
                        <option selected>Pilih Kategori</option>
                        <option value="wajib" <?php if ($data['kategori'] == "wajib"){echo "selected";} ?>>Wajib
                        </option>
                        <option value="opsional" <?php if ($data['kategori'] == "opsional"){echo "selected";} ?>>
                            Opsional</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sub Kategori</label>
                    <input value="<?=$data['sub_kategori']?>" type="text" class="form-control" name="sub" id=""
                        aria-describedby="helpId" placeholder="" />
                </div>
                <button name="submit" type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>