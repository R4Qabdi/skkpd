<?php
$kode = $_GET['kode'];
if (isset($_POST['submit'])){
    $jurusan = substr($_POST['jurusan'], 0, 5);

    $result = mysqli_query($koneksi, "UPDATE tb_jurusan SET jurusan = '$jurusan' WHERE id_jurusan = '$kode'");

    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data berhasil diupdate')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data gagal diupdate')</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Update Data Jurusan</h3>
                    <form action="" method="post">
                        <?php
                        $data = mysqli_fetch_assoc(mysqli_query($koneksi , "SELECT * FROM tb_jurusan WHERE id_jurusan = '$kode'"));
                        ?>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input value="<?= htmlspecialchars($data['jurusan']) ?>" type="text" class="form-control"
                                name="jurusan" id="jurusan" maxlength="5" placeholder="Jurusan" required />
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-5 p-5"></div>