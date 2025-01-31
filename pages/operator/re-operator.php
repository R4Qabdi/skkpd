<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_operator where kode_operator = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-operator'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-operator'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-operator" role="button">Tambah
                data</a>
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-borderless table-dark align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kode operator</th>
                            <th>Nama panjang</th>
                            <th>Username</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_operator = mysqli_query($koneksi, "SELECT * FROM tb_operator");
                        while ($data = mysqli_fetch_assoc($data_operator)){
                        ?>
                        <tr class="table-primary">
                            <td scope="row"><?=$data['kode_operator']?></td>
                            <td><?=$data['nama_lengkap']?></td>
                            <td><?=$data['username']?></td>
                            <td>
                                <?php
                                $cekkey = $data['username'];
                                $result = mysqli_query($koneksi, "SELECT username FROM tb_operator INNER JOIN tb_pengguna USING(username) where username = '$cekkey'");
                                if(!mysqli_num_rows($result)>0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-operator&&kode=<?=$data['kode_operator']?>"
                                    role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('hapus data pengguna terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-operator&&kode=<?=$data['kode_operator']?>"
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