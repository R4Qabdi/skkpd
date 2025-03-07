<?php
if(@$_GET['kegiatan']){
    $id_kegiatan = htmlspecialchars($_GET['kegiatan']);
    $data_update = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kategori INNER JOIN tb_kegiatan USING(id_kategori) WHERE id_kegiatan='$id_kegiatan'"));

    if(isset($_POST['tombol_update'])){
        $kegiatan       = htmlspecialchars($_POST['kegiatan']);
        $kategori       = htmlspecialchars($_POST['kategori']);
        $sub_kategori   = htmlspecialchars($_POST['sub_kategori']);
        $point          = htmlspecialchars($_POST['point']);
        
        $hasil = mysqli_query($koneksi, "UPDATE tb_kegiatan SET jenis_kegiatan='$kegiatan', angka_kredit='$point' WHERE id_kegiatan = '$id_kegiatan'");    

        if(!$hasil){
            echo "<script>alert('gagal memasukkan data');window.location.href='dashboard.php?page=up-kategori-kegiatan&id_kegiatan=".$id_kegiatan."'</script>";
        }else{
            echo "<script>alert('Berhasil Memperbarui Data');window.location.href='dashboard.php?page=re-kategori-kegiatan'</script>";
        }
    }  
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center">Update Kategori Kegiatan</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" readonly
                                value="<?= $data_update['kategori'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="sub_kategori" class="form-label">Sub Kategori</label>
                            <input type="text" class="form-control" name="sub_kategori" readonly
                                value="<?= $data_update['sub_kategori'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" name="kegiatan"
                                value="<?= $data_update['jenis_kegiatan'] ?>" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="point" class="form-label">Angka Kredit / Point</label>
                            <input type="number" class="form-control" name="point"
                                value="<?= $data_update['angka_kredit'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="tombol_update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}elseif(@$_GET['kategori']){
    $id_kategori = htmlspecialchars($_GET['kategori']);
    $data_update = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE id_kategori='$id_kategori'"));

    if(isset($_POST['tombol_update'])){
        $sub_kategori   = htmlspecialchars($_POST['sub_kategori']);
        
        $hasil = mysqli_query($koneksi, "UPDATE tb_kategori SET sub_kategori='$sub_kategori' WHERE id_kategori = '$id_kategori'");    

        if(!$hasil){
            echo "<script>alert('gagal memasukkan data');window.location.href='dashboard.php?page=up-kategori-kegiatan&id_kategori=".$id_kategori."'</script>";
        }else{
            echo "<script>alert('Berhasil Memperbarui Data');window.location.href='dashboard.php?page=re-kategori-kegiatan'</script>";
        }
    }  
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center">Update Sub Kategori</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" readonly
                                value="<?= $data_update['kategori'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="sub_kategori" class="form-label">Sub Kategori</label>
                            <input type="text" class="form-control" name="sub_kategori" autofocus
                                value="<?= $data_update['sub_kategori'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="tombol_update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-5"></div>
<?php
}
?>
<div class="mb-5"></div>