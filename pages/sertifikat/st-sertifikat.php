<?php

// Fungsi untuk mendapatkan data sertifikat berdasarkan status dan kegiatan
function getSertifikat($koneksi, $status = '', $kegiatan = '') {
    $whereClause = "WHERE 1"; // Default kondisi WHERE
    
    if (!empty($status)) {
        $whereClause .= " AND status='" . mysqli_real_escape_string($koneksi, $status) . "'";
    }
    if (!empty($kegiatan)) {
        $whereClause .= " AND jenis_kegiatan LIKE '%" . mysqli_real_escape_string($koneksi, $kegiatan) . "%'";
    }

    $query = "SELECT * FROM tb_sertifikat 
              INNER JOIN tb_kegiatan USING(id_kegiatan) 
              INNER JOIN tb_kategori USING(id_kategori) 
              INNER JOIN tb_siswa USING(nis) 
              $whereClause ORDER BY status, sub_kategori, tanggal_upload ASC";

    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'><table class='table table-bordered table-striped'>";
        echo "<thead class='table-primary'><tr>
                <th>NIS</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Jenis Kegiatan</th>
                <th>Nama Siswa</th>
                <th>Angkatan</th>
                <th>Status</th>
                <th>Lihat Sertifikat</th>
              </tr></thead><tbody>";
        
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$data['nis']}</td>
                    <td>{$data['kategori']}</td>
                    <td>{$data['sub_kategori']}</td>
                    <td>{$data['jenis_kegiatan']}</td>
                    <td>{$data['nama_siswa']}</td>
                    <td>{$data['angkatan']}</td>
                    <td>{$data['status']}</td>
                    <td><a href='halaman_utama.php?page=cek_sertifikat&id={$data['id_sertifikat']}&file={$data['sertifikat']}' target='_blank'>Lihat File</a></td>
                  </tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<p class='text-center'>Tidak ada data</p>";
    }
}

if(@$_POST['tombol_cetak_laporan']){
    setcookie('angkatan', $_POST['angkatan'], time() + (60 * 60 * 24 * 7), '/');
    setcookie('status', $_POST['status'], time() + (60 * 60 * 24 * 7), '/');
    echo "<script>window.location.href='../cetak/laporan/laporan.php';</script>";
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Filter Sertifikat</h3>
                    <form method="POST" action="" class="mb-4">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Pilih Status:</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="Menunggu Validasi">Menunggu Validasi</option>
                                    <option value="Tidak Valid">Tidak Valid</option>
                                    <option value="Valid">Sudah Tervalidasi</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kegiatan" class="form-label">Pilih Kegiatan:</label>
                                <select name="kegiatan" class="form-select">
                                    <option value="">Semua</option>
                                    <?php
                                    $list_kegiatan = mysqli_query($koneksi, "SELECT DISTINCT jenis_kegiatan FROM tb_kegiatan");
                                    while ($data_kegiatan = mysqli_fetch_assoc($list_kegiatan)) {
                                        echo "<option value='{$data_kegiatan['jenis_kegiatan']}'>{$data_kegiatan['jenis_kegiatan']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Cari" class="btn btn-primary">
                        </div>
                    </form>

                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-secondary"
                            onclick="document.getElementById('exampleModal').showModal();">
                            Cetak Laporan
                        </button>
                    </div>

                    <dialog id="exampleModal" class="modal-dialog">
                        <form method="post" class="modal-content p-4">
                            <h2 class="modal-title">Saring/Filter</h2>
                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Pilih Angkatan:</label>
                                <select name="angkatan" id="angkatan" class="form-select">
                                    <option hidden value="">Pilih Angkatan</option>
                                    <option value="semua">Semua</option>
                                    <?php
                                    $data_angkatan = mysqli_query($koneksi, "SELECT angkatan FROM tb_siswa GROUP BY angkatan");
                                    while($angkatan = mysqli_fetch_assoc($data_angkatan)){
                                    ?>
                                    <option value="<?=$angkatan['angkatan']?>"><?=$angkatan['angkatan']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Pilih Status:</label>
                                <select name="status" id="status" class="form-select">
                                    <option hidden value="">Pilih Status</option>
                                    <option value="semua">Semua</option>
                                    <?php
                                    $data_status = mysqli_query($koneksi, "SELECT status FROM tb_sertifikat GROUP BY status");
                                    while($status = mysqli_fetch_assoc($data_status)){
                                    ?>
                                    <option value="<?=$status['status']?>"><?=$status['status']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary"
                                    onclick="document.getElementById('exampleModal').close();">Batal</button>
                                <input type="submit" name="tombol_cetak_laporan" value="Cetak Laporan"
                                    class="btn btn-primary">
                            </div>
                        </form>
                    </dialog>

                    <?php
                    // Ambil nilai filter dari form
                    if (isset($_POST['status'])) {
                        $status = $_POST['status'];
                    } else {
                        $status = '';
                    }

                    if (isset($_POST['kegiatan'])) {
                        $kegiatan = $_POST['kegiatan'];
                    } else {
                        $kegiatan = '';
                    }

                    // Tampilkan hasil pencarian
                    getSertifikat($koneksi, $status, $kegiatan);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>