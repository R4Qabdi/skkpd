<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_jurusan where id_jurusan = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-jurusan" role="button">Tambah
                data</a>
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-borderless table-dark align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID Jurusan</th>
                            <th>Jurusan</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_jurusan = mysqli_query($koneksi, "SELECT * FROM tb_jurusan");
                        while ($data = mysqli_fetch_assoc($data_jurusan)){
                        ?>
                        <tr class="table-primary">
                            <td scope="row"><?=$data['id_jurusan']?></td>
                            <td><?=$data['jurusan']?></td>
                            <td>
                                <?php
                                $cekkey = $data['id_jurusan'];
                                $result = mysqli_query($koneksi, "SELECT id_jurusan FROM tb_jurusan INNER JOIN tb_siswa USING(id_jurusan) where id_jurusan = '$cekkey'");
                                if(!mysqli_num_rows($result)>0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-jurusan&&kode=<?=$data['id_jurusan']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('hapus data siswa terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-jurusan&&kode=<?=$data['id_jurusan']?>"
                                    role="button">Update</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>