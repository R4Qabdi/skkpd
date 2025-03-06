<?php
$nis = $_COOKIE['nis'];
// Fungsi untuk mendapatkan data sertifikat berdasarkan status dan kegiatan
function getSertifikat($koneksi, $status = '', $kegiatan = '') {
    $whereClause = "WHERE 1"; // Default kondisi WHERE
    
    if (!empty($status)) {
        $whereClause .= " AND Status='" . mysqli_real_escape_string($koneksi, $status) . "'";
    }
    if (!empty($kegiatan)) {
        $whereClause .= " AND jenis_kegiatan LIKE '%" . mysqli_real_escape_string($koneksi, $kegiatan) . "%'";
    }

    $nis = $_COOKIE['nis'];
    $query = "SELECT * FROM tb_sertifikat 
              INNER JOIN tb_kegiatan USING(id_kegiatan) 
              INNER JOIN tb_kategori USING(id_kategori) 
              INNER JOIN tb_siswa USING(nis) 
              $whereClause AND nis='$nis' ORDER BY status, sub_Kategori, tanggal_upload ASC";

    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<center><table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Jenis Kegiatan</th>
                <th>Nama Siswa</th>
                <th>Angkatan</th>
                <th>Status</th>
                <th>Lihat Sertifikat</th>
              </tr>";
        
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$data['kategori']}</td>
                    <td>{$data['sub_kategori']}</td>
                    <td>{$data['jenis_kegiatan']}</td>
                    <td>{$data['nama_siswa']}</td>
                    <td>{$data['angkatan']}</td>
                    <td>{$data['status']}</td>
                    <td><a href='dashboard.php?page=cek_sertifikat_siswa&id={$data['Id_Sertifikat']}&file={$data['Sertifikat']}' target='_blank'>Lihat File</a></td>
                  </tr>";
        }
        echo "</table></center>";
    } else {
        echo "<p>Tidak ada data</p>";
    }
}
?>
<center>



    <table border="1">
        <tr>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Point Terkumpul</td>
            <td>
                <?php
            $total_point = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(angka_kredit) FROM tb_sertifikat INNER JOIN tb_kegiatan USING(id_kegiatan) WHERE Status='valid' AND nis='$nis'"))[0];
            
            echo intval($total_point) . "/30 Point";
            
            if ($total_point >= 30) {
                echo "<br><a href='../cetak/sertifikat_skkpd/generate_sertifikat.php'>Cetak Sertifikat SKKPd</a>";
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
    </table><br><br>



    <button onclick="window.location.href='halaman_utama.php?page=upload_sertifikat';">+ Upload
        Sertifikat</button> <br><br>
    <form method="POST" action="">
        <label for="status">Pilih Status:</label>
        <select name="status">
            <option value="">Semua</option>
            <option value="Menunggu Validasi">Menunggu Validasi</option>
            <option value="Tidak Valid">Tidak Valid</option>
            <option value="Valid">Sudah Tervalidasi</option>
        </select>

        <label for="kegiatan">Pilih Kegiatan:</label>
        <select name="kegiatan">
            <option value="">Semua</option>
            <?php
        $list_kegiatan = mysqli_query($koneksi, "SELECT DISTINCT jenis_kegiatan FROM tb_kegiatan");
        while ($data_kegiatan = mysqli_fetch_assoc($list_kegiatan)) {
            echo "<option value='{$data_kegiatan['jenis_kegiatan']}'>{$data_kegiatan['jenis_kegiatan']}</option>";
        }
        ?>
        </select>

        <input type="submit" value="Cari">
    </form>
</center>
<br><br>

<?php
// Ambil nilai filter dari form
$status = isset($_POST['status']) ? $_POST['status'] : '';
$kegiatan = isset($_POST['kegiatan']) ? $_POST['kegiatan'] : '';

// Tampilkan hasil pencarian
getSertifikat($koneksi, $status, $kegiatan);
?>