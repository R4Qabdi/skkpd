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
                <table class="table table-striped table-hover table-borderless table-light align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Kegiatan</th>
                            <th>Angka Kredit</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_kegiatan = mysqli_query($koneksi, "SELECT * FROM tb_kategori INNER JOIN tb_kegiatan ON tb_kategori.id_kategori = tb_kegiatan.id_kegiatan ORDER BY tb_kategori.sub_kategori");

                        $tempid = null;
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($data_kegiatan)){
                            echo"alot";
                            if($tempid !== $data['id_kategori']){
                                echo "kegs";
                                if($tempid !== null){
                                    echo "<tr><td colspan='7'>&nbsp;</td></tr>";
                                    echo "rawr";
                                }
                                echo "
                                <tr class='table-active text-center'>
                                    <td colspan ='3' class=v'fw-bold text-start'><a class='btn btn-light'>".$data['kategori']."</a>".$data['sub_kategori']."</td>
                                    <td><a href='dashboard.php?page=up-kategori-kegiatan&kode=".htmlspecialchars($data['id_kategori'])."' class='btn btn-warning'>Edit kategori</a></td>
                                    <td></td>
                                </tr>
                                ";
                                $no =1;

                            }
                        ?>
                        <tr class="text-center">
                            <td><?=$no++?></td>
                            <td align="left"><?=htmlspecialchars($data['jenis_kegiatan'])?></td>
                            <td>
                                <div class="btn btn-info text-white rounded circle">
                                    <?=htmlspecialchars($data['angka_kredit'])?></div>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-kategori-kegiatan&kode=<?=$data['id_kegiatan']?>"
                                    role="button">Edit</a>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-danger"
                                    href="dashboard.php?page=kategori-kegiatan&kode=<?=$data['id_kegiatan']?>"
                                    role="button" onclick="return confirm('yaking ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php
                        $tempid = $data['id_kategori'];
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