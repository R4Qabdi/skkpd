<?php
if(isset($_GET['act'])){
    @$idsert=$_GET['id'];
    @$namasert=$_GET['sert'];

    if ($_GET['act']=="lihat"){
        echo "<script>window.location.href='dashboard.php?page=see-sertifikat&id=".$idsert."&file=".$namasert."';</script>";
    }else if ($_GET['act']=="verif"){
        $tgl = date("Y-m-d");
        $result = mysqli_query($koneksi,"UPDATE tb_sertifikat SET status = 'valid', tanggal_status_berubah = '$tgl' WHERE id_sertifikat = '$idsert'");
        if($result){
            echo"<script>alert('berhasil'); window.location.href='dashboard.php?page=re-sertifikat';</script>";
        }
    }else if ($_GET['act']=="noverif"){
        $tgl = date("Y-m-d");
        $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
        $result = mysqli_query($koneksi,"UPDATE tb_sertifikat SET status = 'tidak valid', catatan = '$catatan', tanggal_status_berubah = '$tgl' WHERE id_sertifikat = '$idsert'");
        if($result){
            echo"<script>alert('berhasil'); window.location.href='dashboard.php?page=re-sertifikat';</script>";
        }
    }else if ($_GET['act']=="del"){
        $result = mysqli_query($koneksi,"DELETE FROM tb_sertifikat WHERE id_sertifikat = '$idsert'");
        if($result){
            echo"<script>alert('berhasil dihapus'); window.location.href='dashboard.php?page=re-sertifikat';</script>";
        }
    }
}

if(@$_POST['tombol_cetak_laporan']){
    setcookie('angkatan', $_POST['angkatan'], time() + (60 * 60 * 24 * 7), '/');
    setcookie('status', $_POST['status'], time() + (60 * 60 * 24 * 7), '/');
    echo "<script>window.location.href='cetak/laporan/laporan.php';</script>";
}

$angkatan = isset($_COOKIE['angkatan']) ? $_COOKIE['angkatan'] : '';
$kegiatan = isset($_POST['kegiatan']) ? $_POST['kegiatan'] : '';

function getSertifikat($koneksi, $status = '', $kegiatan = '', $angkatan = '') {
    $whereClause = "WHERE 1"; // Default kondisi WHERE
    
    if ($status && $status != 'semua') {
        $whereClause .= " AND status='" . mysqli_real_escape_string($koneksi, $status) . "'";
    }
    if ($kegiatan && $kegiatan != 'semua') {
        $whereClause .= " AND jenis_kegiatan LIKE '%" . mysqli_real_escape_string($koneksi, $kegiatan) . "%'";
    }
    if ($angkatan && $angkatan != 'semua') {
        $whereClause .= " AND angkatan='" . mysqli_real_escape_string($koneksi, $angkatan) . "'";
    }

    $query = "SELECT * FROM tb_sertifikat 
              INNER JOIN tb_kegiatan USING(id_kegiatan) 
              INNER JOIN tb_kategori USING(id_kategori) 
              INNER JOIN tb_siswa USING(nis) 
              $whereClause ORDER BY status, sub_kategori, tanggal_upload ASC";

    $result = mysqli_query($koneksi, $query);
    
    return $result;
}
?>

<style>
/* Set a fixed height and allow scrolling */
.tab-content {
    height: 300px;
    /* Adjust height as needed */
    overflow-y: auto;
    border: 1px solid #dee2e6;
    /* Optional: Adds border for visibility */
    padding: 15px;
}
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-header text-center font-weight-bold">Data Sertifikat</h2>
                    <div class="d-flex justify-content-between mb-4">
                        <button type="button" class="btn btn-secondary"
                            onclick="document.getElementById('exampleModal').showModal();">
                            Cetak Laporan
                        </button>
                        <form method="POST" action="" class="d-flex">
                            <div class="me-2">
                                <label for="kegiatan" class="form-label">Filter Kegiatan:</label>
                                <select name="kegiatan" class="form-select" onchange="this.form.submit()">
                                    <option value="semua">Semua</option>
                                    <?php
                                    $list_kegiatan = mysqli_query($koneksi, "SELECT DISTINCT jenis_kegiatan FROM tb_kegiatan");
                                    while ($data_kegiatan = mysqli_fetch_assoc($list_kegiatan)) {
                                        $selected = ($data_kegiatan['jenis_kegiatan'] == $kegiatan) ? 'selected' : '';
                                        echo "<option value='{$data_kegiatan['jenis_kegiatan']}' $selected>{$data_kegiatan['jenis_kegiatan']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
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

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1" data-bs-toggle="tab" data-bs-target="#panel1"
                                type="button" role="tab" aria-controls="panel1" aria-selected="true">
                                Menunggu Validasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#panel2"
                                type="button" role="tab" aria-controls="panel2" aria-selected="false">
                                Tidak Valid
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab3" data-bs-toggle="tab" data-bs-target="#panel3"
                                type="button" role="tab" aria-controls="panel3" aria-selected="false">
                                Valid
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content with Scroll -->
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="tab1">
                            <!-- ++==++INI TAB UNTUK MENUNGGU VALIDASI++==++ -->
                            <?php
                            $result = getSertifikat($koneksi, 'menunggu validasi', $kegiatan, $angkatan);
                            if (mysqli_num_rows($result) > 0) {
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "<div class='card mb-3'>
                                            <div class='card-header'>{$data['sertifikat']}</div>
                                            <div class='card-body'>
                                                <p class='card-text'>{$data['nama_siswa']}</p>
                                                <p class='card-text'>{$data['kategori']}</p>
                                                <p class='card-text'>{$data['sub_kategori']}</p>
                                                <p class='card-text'>{$data['jenis_kegiatan']}</p>
                                                <p class='card-text'>{$data['angkatan']}</p>
                                                <a href='dashboard.php?page=see-sertifikat&id={$data['id_sertifikat']}&file={$data['sertifikat']}' target='_blank' class='btn btn-primary'>Lihat Sertifikat</a>
                                                <a href='dashboard.php?page=re-sertifikat&act=del&id={$data['id_sertifikat']}' class='btn btn-danger'>Delete Sertifikat</a>
                                                <a href='dashboard.php?page=re-sertifikat&act=verif&id={$data['id_sertifikat']}' class='btn btn-success'>Valid</a>
                                                <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modalNoverif' data-id='{$data['id_sertifikat']}' data-sert='{$data['sertifikat']}'>Tidak Valid</button>
                                            </div>
                                          </div>";
                                }
                            } else {
                                echo "<p class='text-center'>Tidak ada data</p>";
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="tab2">
                            <!-- ++==++INI TAB UNTUK TIDAK VALID++==++ -->
                            <?php
                            $result = getSertifikat($koneksi, 'tidak valid', $kegiatan, $angkatan);
                            if (mysqli_num_rows($result) > 0) {
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "<div class='card mb-3'>
                                            <div class='card-header'>{$data['sertifikat']}</div>
                                            <div class='card-body'>
                                                <p class='card-text'>{$data['nama_siswa']}</p>
                                                <p class='card-text'>{$data['kategori']}</p>
                                                <p class='card-text'>{$data['sub_kategori']}</p>
                                                <p class='card-text'>{$data['jenis_kegiatan']}</p>
                                                <p class='card-text'>{$data['angkatan']}</p>
                                                <a href='dashboard.php?page=see-sertifikat&id={$data['id_sertifikat']}&file={$data['sertifikat']}' target='_blank' class='btn btn-primary'>Lihat Sertifikat</a>
                                                <a href='dashboard.php?page=re-sertifikat&act=del&id={$data['id_sertifikat']}' class='btn btn-danger'>Delete Sertifikat</a>
                                                <a href='dashboard.php?page=re-sertifikat&act=verif&id={$data['id_sertifikat']}' class='btn btn-success'>Valid</a>
                                                <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modalNoverif' data-id='{$data['id_sertifikat']}' data-sert='{$data['sertifikat']}'>Tidak Valid</button>
                                            </div>
                                          </div>";
                                }
                            } else {
                                echo "<p class='text-center'>Tidak ada data</p>";
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="tab3">
                            <!-- ++==++INI TAB UNTUK VALID++==++ -->
                            <?php
                            $result = getSertifikat($koneksi, 'valid', $kegiatan, $angkatan);
                            if (mysqli_num_rows($result) > 0) {
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "<div class='card mb-3'>
                                            <div class='card-header'>{$data['sertifikat']}</div>
                                            <div class='card-body'>
                                                <p class='card-text'>{$data['nama_siswa']}</p>
                                                <p class='card-text'>{$data['kategori']}</p>
                                                <p class='card-text'>{$data['sub_kategori']}</p>
                                                <p class='card-text'>{$data['jenis_kegiatan']}</p>
                                                <p class='card-text'>{$data['angkatan']}</p>
                                                <a href='dashboard.php?page=see-sertifikat&id={$data['id_sertifikat']}&file={$data['sertifikat']}' target='_blank' class='btn btn-primary'>Lihat Sertifikat</a>
                                                <a href='dashboard.php?page=re-sertifikat&act=del&id={$data['id_sertifikat']}' class='btn btn-danger'>Delete Sertifikat</a>
                                                <a href='dashboard.php?page=re-sertifikat&act=verif&id={$data['id_sertifikat']}' class='btn btn-success'>Valid</a>
                                                <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modalNoverif' data-id='{$data['id_sertifikat']}' data-sert='{$data['sertifikat']}'>Tidak Valid</button>
                                            </div>
                                          </div>";
                                }
                            } else {
                                echo "<p class='text-center'>Tidak ada data</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Tidak Valid -->
<div class="modal fade" id="modalNoverif" tabindex="-1" aria-labelledby="modalNoverifLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="modalNoverifForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNoverifLabel">Input Catatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_sertifikat" id="modal-id-sertifikat">
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modalNoverif = document.getElementById('modalNoverif');
    modalNoverif.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var idSertifikat = button.getAttribute('data-id');
        var sertifikat = button.getAttribute('data-sert');

        var modalIdSertifikat = modalNoverif.querySelector('#modal-id-sertifikat');
        modalIdSertifikat.value = idSertifikat;

        var modalForm = document.getElementById('modalNoverifForm');
        modalForm.action = 'dashboard.php?page=re-sertifikat&act=noverif&id=' + idSertifikat +
            '&sert=' + sertifikat;
    });
});
</script>
<div class="mb-5"></div>