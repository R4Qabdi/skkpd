<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_jurusan WHERE id_jurusan = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <a name="" id="" class="btn btn-success" href="dashboard.php?page=in-jurusan" role="button">Tambah Data</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Jurusan</th>
                            <th>Jurusan</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_jurusan = mysqli_query($koneksi, "SELECT * FROM tb_jurusan");
                        while ($data = mysqli_fetch_assoc($data_jurusan)){
                        ?>
                        <tr class="table-light">
                            <td scope="row"><?= htmlspecialchars($data['id_jurusan']) ?></td>
                            <td><?= htmlspecialchars($data['jurusan']) ?></td>
                            <td>
                                <?php
                                $cekkey = $data['id_jurusan'];
                                $result = mysqli_query($koneksi, "SELECT id_jurusan FROM tb_jurusan INNER JOIN tb_siswa USING(id_jurusan) WHERE id_jurusan = '$cekkey'");
                                if(!mysqli_num_rows($result) > 0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-jurusan&kode=<?= htmlspecialchars($data['id_jurusan']) ?>"
                                    role="button"
                                    onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('Hapus data siswa terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-jurusan&kode=<?= htmlspecialchars($data['id_jurusan']) ?>"
                                    role="button">Update</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mb-5"></div>