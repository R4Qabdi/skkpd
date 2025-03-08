<?php
if (isset($_GET['kode'])){
    $id = $_GET['kode'];

    $result = mysqli_query($koneksi,"DELETE FROM tb_operator where kode_operator = '$id'");
    $resultp = mysqli_query($koneksi,"DELETE FROM tb_pengguna where kode_operator = '$id'");
    
    if ($result*$resultp){
        echo "<script>alert('data berhasil dihapus');window.location.href = 'dashboard.php?page=re-operator'; </script>";
    }else{
        echo "<script>alert('data gagal dihapus'); window.location.href = 'dashboard.php?page=re-operator'; </script>";
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <a name="" id="" class="btn btn-success" href="dashboard.php?page=in-operator" role="button">Tambah Data</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Kode Operator</th>
                            <th>Nama Panjang</th>
                            <th>Username</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_operator = mysqli_query($koneksi, "SELECT * FROM tb_operator");
                        while ($data = mysqli_fetch_assoc($data_operator)){
                        ?>
                        <tr class="table-light">
                            <td scope="row"><?= htmlspecialchars($data['kode_operator']) ?></td>
                            <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($data['username']) ?></td>
                            <td>
                                <?php
                                $cekkey = $data['username'];
                                $result = mysqli_query($koneksi, "SELECT username FROM tb_operator INNER JOIN tb_pengguna USING(username) WHERE username = '$cekkey'");
                                if(!mysqli_num_rows($result) > 0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-operator&kode=<?= htmlspecialchars($data['kode_operator']) ?>"
                                    role="button"
                                    onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">Delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('Hapus data pengguna terlebih dahulu')">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-operator&user=<?= htmlspecialchars($data['username']) ?>&kode=<?= htmlspecialchars($data['kode_operator']) ?>"
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
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-3"></div>