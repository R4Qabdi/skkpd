<?php
if (isset($_GET['nis'])){
    echo"hapuuuuuuuusss";
    $ceknis = $_GET['nis'];
    $result = mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE nis='$ceknis'");
    if($result){
        echo "<script>alert('data berhasil dihapus!')</script>";
    }else{
        echo "<script>alert('data gagal dihapus!')</script>";
    }
}
?>

<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="table">
                <?php
                ?>
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">NIS</th>
                            <th scope="col">No. Absen</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Email</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col" colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa INNER JOIN tb_jurusan USING(id_jurusan)");
                            while ($data = mysqli_fetch_assoc($data_siswa)){
                        ?>
                        <tr class="">
                            <td scope="row"><?=$data['nis']?></td>
                            <td><?=$data['absen']?></td>
                            <td><?=$data['nama_siswa']?></td>
                            <td><?=$data['telp']?></td>
                            <td><?=$data['email']?></td>
                            <td><?=$data['kelas']?></td>
                            <td><?=$data['angkatan']?></td>
                            <td><?=$data['jurusan']?></td>
                            <td>
                                <?php
                                $ceknis = $data['nis'];
                                $result = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_sertifikat USING(nis) where nis = '$ceknis'");
                                if(!mysqli_num_rows($result)>0){
                                ?>
                                <a name="hapus" id="" class="btn btn-danger"
                                    href="dashboard.php?page=re-siswa&&nis=<?=$data['nis']?>" role="button"
                                    onclick="return confirm('apakah anda yakin untuk menghapus data ini?')">delete</a>
                                <?php
                                }else{
                                ?>
                                <a name="" id="" class="btn btn-danger" href="" role="button"
                                    onclick="return alert('hapus data sertifikat terlebih dahulu')">delete</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a id="" class="btn btn-warning"
                                    href="dashboard.php?page=up-siswa&&nis=<?=$data['nis']?>" role="button">Update</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

</div>