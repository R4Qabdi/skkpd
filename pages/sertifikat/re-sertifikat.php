<?php
if(isset($_GET['act'])){
    $idsert=$_GET['id'];
    $namasert=$_GET['sert'];

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
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab1" data-bs-toggle="tab" data-bs-target="#panel1" type="button"
                role="tab" aria-controls="panel1" aria-selected="true">
                Menunggu Validasi
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#panel2" type="button" role="tab"
                aria-controls="panel2" aria-selected="false">
                Tidak Valid
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab3" data-bs-toggle="tab" data-bs-target="#panel3" type="button" role="tab"
                aria-controls="panel3" aria-selected="false">
                Valid
            </button>
        </li>
    </ul>

    <!-- Tab Content with Scroll -->
    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="tab1">
            <!-- ++==++INI TAB UNTUK MENUNGGU VALIDASI++==++ -->
            <?php
            $data_sertif = mysqli_query($koneksi, "SELECT id_sertifikat, tanggal_upload, catatan, sertifikat, status, tanggal_status_berubah, nis, id_kegiatan, jenis_kegiatan, nama_siswa FROM tb_sertifikat JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_siswa USING(nis) WHERE status='menunggu validasi'");
            while ($data = mysqli_fetch_assoc($data_sertif)){
            ?>
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?=$data['id_sertifikat']?>. <?=$data['sertifikat']?></h4>
                    <p class="card-text"><?=$data['nis']?>, <?=$data['nama_siswa']?></p>
                    <p class="card-text"><?=$data['jenis_kegiatan']?></p>
                    <a name="" id="" class="btn btn-primary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&sert=<?=$data['sertifikat']?>&act=lihat"
                        role="button">
                        Lihat Sertifikat</a>
                    <a name="" id="" class="btn btn-success"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=verif" role="button">
                        Valid</a>
                    <button name="" id="" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalNoverif" data-id="<?=$data['id_sertifikat']?>"
                        data-sert="<?=$data['sertifikat']?>">
                        Tidak Valid
                    </button>
                    <a name="" id="" class="btn btn-warning"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=edit" role="button">
                        Edit Sertifikat</a>
                    <a name="" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=del" role="button">
                        Delete Sertifikat</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="tab2">
            <!-- ++==++INI TAB UNTUK TIDAK VALID++==++ -->
            <?php
            $data_sertif = mysqli_query($koneksi, "SELECT id_sertifikat, tanggal_upload, catatan, sertifikat, status, tanggal_status_berubah, nis, id_kegiatan, jenis_kegiatan, nama_siswa FROM tb_sertifikat JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_siswa USING(nis) WHERE status='tidak valid'");
            while ($data = mysqli_fetch_assoc($data_sertif)){
            ?>
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?=$data['id_sertifikat']?>. <?=$data['sertifikat']?></h4>
                    <p class="card-text"><?=$data['nis']?>, <?=$data['nama_siswa']?></p>
                    <p class="card-text"><?=$data['jenis_kegiatan']?></p>
                    <a name="" id="" class="btn btn-primary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&sert=<?=$data['sertifikat']?>&act=lihat"
                        role="button">
                        Lihat Sertifikat</a>
                    <a name="" id="" class="btn btn-success"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=verif" role="button">
                        Valid</a>
                    <button name="" id="" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalNoverif" data-id="<?=$data['id_sertifikat']?>"
                        data-sert="<?=$data['sertifikat']?>">
                        Tidak Valid
                    </button>
                    <a name="" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=del" role="button">
                        Delete Sertifikat</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="tab3">
            <!-- ++==++INI TAB UNTUK VALID++==++ -->
            <?php
            $data_sertif = mysqli_query($koneksi, "SELECT id_sertifikat, tanggal_upload, catatan, sertifikat, status, tanggal_status_berubah, nis, id_kegiatan, jenis_kegiatan, nama_siswa FROM tb_sertifikat JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_siswa USING(nis) WHERE status='valid'");
            while ($data = mysqli_fetch_assoc($data_sertif)){
            ?>
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?=$data['id_sertifikat']?>. <?=$data['sertifikat']?></h4>
                    <p class="card-text"><?=$data['nis']?>, <?=$data['nama_siswa']?></p>
                    <p class="card-text"><?=$data['jenis_kegiatan']?></p>
                    <a name="" id="" class="btn btn-primary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&sert=<?=$data['sertifikat']?>&act=lihat"
                        role="button">
                        Lihat Sertifikat</a>
                    <a name="" id="" class="btn btn-success"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=verif" role="button">
                        Valid</a>
                    <button name="" id="" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalNoverif" data-id="<?=$data['id_sertifikat']?>"
                        data-sert="<?=$data['sertifikat']?>">
                        Tidak Valid
                    </button>
                    <a name="" id="" class="btn btn-warning"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=edit" role="button">
                        Edit Sertifikat</a>
                    <a name="" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=del" role="button">
                        Delete Sertifikat</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal for Tidak Valid -->
<div class="modal fade" id="modalNoverif" tabindex="-1" aria-labelledby="modalNoverifLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="dashboard.php?page=re-sertifikat&act=noverif" method="POST">
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
    });
});
</script>
<div class="mb-5"></div>