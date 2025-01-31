<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_kegiatan where id_kegiatan = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-kegiatan'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-kegiatan'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-kegiatan" role="button">Tambah
                data</a>
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-borderless table-dark align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID kegiatan</th>
                            <th>kegiatan</th>
                            <th>Sub kegiatan</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_kegiatan = mysqli_query($koneksi, "SELECT * FROM tb_kegiatan");
                        while ($data = mysqli_fetch_assoc($data_kegiatan)){
                        ?>
                        <tr class="table-primary">
                            <td scope="row"><?=$data['id_kegiatan']?></td>
                            <td><?=$data['kegiatan']?></td>
                            <td><?=$data['sub_kegiatan']?></td>
                            <td>
                                <?php
                                $cekkey = $data['id_kegiatan'];
                                $result = mysqli_query($koneksi, "SELECT id_kegiatan FROM tb_kegiatan INNER JOIN tb_sertifikat USING(id_kegiatan) where id_kegiatan = '$cekkey'");
                                if(!mysqli_num_rows($result)>0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-kegiatan&&kode=<?=$data['id_kegiatan']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('hapus data kegiatan terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kegiatan&&kode=<?=$data['id_kegiatan']?>"
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