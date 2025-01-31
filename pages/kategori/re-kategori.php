<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_kategori where id_kategori = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-kategori'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-kategori'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-kategori" role="button">Tambah
                data</a>
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-borderless table-dark align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID kategori</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_kategori = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                        while ($data = mysqli_fetch_assoc($data_kategori)){
                        ?>
                        <tr class="table-primary">
                            <td scope="row"><?=$data['id_kategori']?></td>
                            <td><?=$data['kategori']?></td>
                            <td><?=$data['sub_kategori']?></td>
                            <td>
                                <?php
                                $cekkey = $data['id_kategori'];
                                $result = mysqli_query($koneksi, "SELECT id_kategori FROM tb_kategori INNER JOIN tb_kegiatan USING(id_kategori) where id_kategori = '$cekkey'");
                                if(!mysqli_num_rows($result)>0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-kategori&&kode=<?=$data['id_kategori']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('hapus data kategori terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kategori&&kode=<?=$data['id_kategori']?>"
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