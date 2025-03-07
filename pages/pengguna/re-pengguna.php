<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_pengguna where id_pengguna = '$id'");
    
    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-pengguna'; alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-pengguna'; alert('data gagal dihapus')</script>";
    }
}
?>
<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-6">
            <a name="" id="" class="btn btn-success m-auto" href="dashboard.php?page=in-pengguna" role="button">Tambah
                data</a>
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-borderless table-dark align-middle">
                    <thead class="table-light">
                        <tr>
                            <th colspan="5" align="center">Tabel Pengguna Operator</th>
                        </tr>
                    </thead>
                    <thead class="table-light">
                        <tr>
                            <th>ID pengguna</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_pengguna = mysqli_query($koneksi, "SELECT id_pengguna, username, password FROM tb_pengguna WHERE username IS NOT NULL");
                        while ($data = mysqli_fetch_assoc($data_pengguna)){
                        ?>
                        <tr class="table-primary">
                            <td scope="row"><?=$data['id_pengguna']?></td>
                            <td><?=$data['username']?></td>
                            <td>*****</td>
                            <td>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-pengguna&&kode=<?=$data['id_pengguna']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-pengguna-op&&kode=<?=$data['id_pengguna']?>"
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
        <div class="col-6">
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-borderless table-dark align-middle">
                    <thead class="table-light">
                        <tr>
                            <th colspan="5" align="center">Tabel Pengguna Siswa</th>
                        </tr>
                    </thead>
                    <thead class="table-light">
                        <tr>
                            <th>ID pengguna</th>
                            <th>NIS</th>
                            <th>Password</th>
                            <th colspan="2">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                         
                        $data_pengguna = mysqli_query($koneksi, "SELECT id_pengguna, nis, password FROM tb_pengguna WHERE nis IS NOT NULL");
                        while ($data = mysqli_fetch_assoc($data_pengguna)){
                        ?>
                        <tr class="table-primary">
                            <td scope="row"><?=$data['id_pengguna']?></td>
                            <td><?=$data['nis']?></td>
                            <td>*****</td>
                            <td>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-pengguna&&kode=<?=$data['id_pengguna']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">Delete</a>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-pengguna-siswa&&kode=<?=$data['id_pengguna']?>"
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
    </div>
</div>