<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_kegiatan WHERE id_kegiatan = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-kegiatan'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-kegiatan'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <a name="" id="" class="btn btn-success" href="dashboard.php?page=in-kategori-kegiatan" role="button">Tambah
                Data</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Jenis Kegiatan</th>
                            <th>Angka Kredit</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_kateg = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                        while ($data = mysqli_fetch_assoc($data_kateg)){
                        ?>
                        <tr class="table-secondary">
                            <td scope="row"><?= htmlspecialchars($data['id_kategori']) ?></td>
                            <td>
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-secondary" disabled>
                                        <?= htmlspecialchars($data['kategori']) ?>
                                    </button>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($data['sub_kategori']) ?></td>
                            <td colspan="2">
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kategori-kegiatan&kategori=<?= htmlspecialchars($data['id_kategori']) ?>"
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
                            <td scope="row"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($datag['jenis_kegiatan']) ?></td>
                            <td>
                                <button type="button" name="" id="" class="btn btn-primary" disabled>
                                    <?= htmlspecialchars($datag['angka_kredit']) ?>
                                </button>
                            </td>
                            <td>
                                <?php
                                $cekkey = $datag['id_kegiatan'];
                                $result = mysqli_query($koneksi, "SELECT id_kegiatan FROM tb_kegiatan INNER JOIN tb_sertifikat USING(id_kegiatan) WHERE id_kegiatan = '$cekkey'");
                                if(!mysqli_num_rows($result) > 0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-kegiatan&kode=<?= htmlspecialchars($datag['id_kegiatan']) ?>"
                                    role="button"
                                    onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('Hapus data sertifikat terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kategori-kegiatan&kegiatan=<?= htmlspecialchars($datag['id_kegiatan']) ?>"
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
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mb-5"></div>