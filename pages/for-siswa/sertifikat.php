<?php
$nis = $_COOKIE['nis'];
// Fungsi untuk mendapatkan data sertifikat berdasarkan status dan kegiatan
function getSertifikat($koneksi, $status = '', $kegiatan = '') {
    $whereClause = "WHERE 1"; // Default kondisi WHERE
    
    if (!empty($status)) {
        $whereClause .= " AND status='" . mysqli_real_escape_string($koneksi, $status) . "'";
    }
    if (!empty($kegiatan)) {
        $whereClause .= " AND jenis_kegiatan LIKE '%" . mysqli_real_escape_string($koneksi, $kegiatan) . "%'";
    }

    $nis = $_COOKIE['nis'];
    $query = "SELECT * FROM tb_sertifikat 
              INNER JOIN tb_kegiatan USING(id_kegiatan) 
              INNER JOIN tb_kategori USING(id_kategori) 
              INNER JOIN tb_siswa USING(nis) 
              $whereClause AND nis='$nis' ORDER BY status, sub_kategori, tanggal_upload ASC";

    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive mt-3 mb-5'><table class='table table-bordered table-striped'>";
        echo "<thead class='thead-dark'>
                <tr>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Jenis Kegiatan</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                    <th>Lihat Sertifikat</th>
                </tr>
              </thead><tbody>";
        
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$data['kategori']}</td>
                    <td>{$data['sub_kategori']}</td>
                    <td>{$data['jenis_kegiatan']}</td>
                    <td>{$data['angkatan']}</td>
                    <td>{$data['status']}</td>
                    <td><a href='dashboard.php?page=cek_sertifikat_siswa&id={$data['id_sertifikat']}&file={$data['sertifikat']}' target='_blank' class='btn btn-primary btn-sm'>Lihat File</a></td>
                  </tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<p class='text-center mt-3 mb-5'>Tidak ada data</p>";
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Data Sertifikat</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Point Terkumpul</td>
                                <td>
                                    <?php
                                    $total_point = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(angka_kredit) FROM tb_sertifikat INNER JOIN tb_kegiatan USING(id_kegiatan) WHERE status='valid' AND nis='$nis'"))[0];
                                    
                                    echo intval($total_point) . "/30 Point";
                                    
                                    if ($total_point >= 30) {
                                        echo "<br><a href='../cetak/sertifikat_skkpd/generate_sertifikat.php' class='btn btn-success btn-sm mt-2'>Cetak Sertifikat SKKPd</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Menunggu Validasi</td>
                                <td>
                                    <?php
                                    $total_point = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_sertifikat WHERE status='menunggu validasi' AND nis='$nis'"))[0];
                                    echo $total_point . " Sertifikat";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tidak Valid</td>
                                <td>
                                    <?php
                                    $total_point = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_sertifikat WHERE status='tidak valid' AND nis='$nis'"))[0];
                                    echo $total_point . " Sertifikat";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Valid</td>
                                <td>
                                    <?php
                                    $total_point = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_sertifikat WHERE status='valid' AND nis='$nis'"))[0];
                                    echo $total_point . " Sertifikat";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-4">
                        <button onclick="window.location.href='dashboard.php?page=upload-sertifikat';"
                            class="btn btn-primary">+ Upload Sertifikat</button>
                    </div>
                    <form method="POST" action="" class="mt-4">
                        <div class="form-group">
                            <label for="status">Pilih Status:</label>
                            <select name="status" class="form-control">
                                <option value="">Semua</option>
                                <option value="Menunggu Validasi">Menunggu Validasi</option>
                                <option value="Tidak Valid">Tidak Valid</option>
                                <option value="Valid">Sudah Tervalidasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kegiatan">Pilih Kegiatan:</label>
                            <select name="kegiatan" class="form-control mb-3">
                                <option value="">Semua</option>
                                <?php
                                $list_kegiatan = mysqli_query($koneksi, "SELECT DISTINCT jenis_kegiatan FROM tb_kegiatan");
                                while ($data_kegiatan = mysqli_fetch_assoc($list_kegiatan)) {
                                    echo "<option value='{$data_kegiatan['jenis_kegiatan']}'>{$data_kegiatan['jenis_kegiatan']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Cari" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
            <?php
            // Ambil nilai filter dari form
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $kegiatan = isset($_POST['kegiatan']) ? $_POST['kegiatan'] : '';

            // Tampilkan hasil pencarian
            getSertifikat($koneksi, $status, $kegiatan);
            ?>
        </div>
    </div>
</div>