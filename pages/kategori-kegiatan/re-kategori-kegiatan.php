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
                <table class="table table-striped table-borderless table-dark align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><b>No</b></th>
                            <th><b>Jenis Kegiatan</b></th>
                            <th><b>Angka Kredit</b></th>
                            <th colspan="2"><b>aksi</b></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_kateg = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                        while ($data = mysqli_fetch_assoc($data_kateg)){
                        ?>
                        <tr class="table-secondary">
                            <td scope="row"><?=$data['id_kategori']?></td>
                            <td>
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-primary" disabled>
                                        <?=$data['kategori']?>
                                    </button>
                                </div>
                            </td>
                            <td><?=$data['sub_kategori']?></td>
                            <td colspan="2">
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kategori&&kode=<?=$data['id_kategori']?>"
                                    role="button">Update</a>
                            </td>
                        </tr>
                        <?php
                        $no = 1;
                        $idkeg = $data['id_kategori'];
                        $data_keg = mysqli_query($koneksi, "SELECT * FROM tb_kegiatan WHERE id_kategori = '$idkeg'");
                        while($datag = mysqli_fetch_assoc($data_keg)){
                        ?>
                        <tr class="table-light">
                            <td scope="row"><?=$no++?></td>
                            <td><?=$datag['jenis_kegiatan']?></td>
                            <td>
                                <button type="button" name="" id="" class="btn btn-primary" disabled>
                                    <?=$datag['angka_kredit']?>
                                </button>
                            </td>
                            <td>
                                <?php
                                $cekkey = $datag['id_kegiatan'];
                                $result = mysqli_query($koneksi, "SELECT id_kegiatan FROM tb_kegiatan INNER JOIN tb_sertifikat USING(id_kegiatan) where id_kegiatan = '$cekkey'");
                                if(!mysqli_num_rows($result)>0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-kegiatan&&kode=<?=$datag['id_kegiatan']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('hapus data sertifikat terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kegiatan&&kode=<?=$datag['id_kegiatan']?>"
                                    role="button">Update</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <?php
                        $no=0;
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