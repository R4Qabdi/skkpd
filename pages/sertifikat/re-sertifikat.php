<?php
if(isset($_GET['act'])){
    $idsert=$_GET['id'];

    if ($_GET['act']=="lihat"){
        echo "akan muncul pdf disini duarrrrr";
    }else if ($_GET['act']=="verif"){
        $result = mysqli_query($koneksi,"UPDATE tb_sertifikat SET status = 'valid' WHERE id_sertifikat = '$idsert'");
        if($result){
            echo"<script>alert('berhasil'); window.location.href='dashboard.php?page=re-sertifikat';</script>";
        }
    }else if ($_GET['act']=="noverif"){
        $result = mysqli_query($koneksi,"UPDATE tb_sertifikat SET status = 'tidak valid' WHERE id_sertifikat = '$idsert'");
        if($result){
            echo"<script>alert('berhasil'); window.location.href='dashboard.php?page=re-sertifikat';</script>";
        }
    }else if ($_GET['act']=="del"){
        $result = mysqli_query($koneksi,"DELETE FROM tb_sertifikat WHERE id_sertifikat = '$idsert'");
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
        <?php
            $data_sertif = mysqli_query($koneksi, "SELECT id_sertifikat, tanggal_upload, catatan, sertifikat, status, tanggal_status_berubah, nis, id_kegiatan, jenis_kegiatan, nama_siswa FROM tb_sertifikat JOIN tb_kegiatan USING(id_kegiatan) JOIN tb_siswa USING(nis)");
            // id_sertifikat 	tanggal_upload 	catatan 	sertifikat 	status 	tanggal_status_berubah 	nis 	id_kegiatan 	ISI
            
            while ($data = mysqli_fetch_assoc($data_sertif)){
                if ($data['status']=="menunggu validasi"){
                ?>
        <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="tab1">
            <!-- ++==++INI TAB UNTUK MENUNGGU VALIDASI++==++ -->
            <div class="card border-primary">
                <div class="card-body">
                    <h4 class="card-title"><?=$data['id_sertifikat']?>. <?=$data['sertifikat']?></h4>
                    <p class="card-text"><?=$data['nis']?>, <?=$data['nama_siswa']?></p>
                    <p class="card-text"></p>
                    <p class="card-text"><?=$data['jenis_kegiatan']?></p>
                    <a name="" id="" class="btn btn-primary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=lihat" role="button">
                        Lihat Sertifikat</a>
                    <a name="" id="" class="btn btn-success"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=verif" role="button">
                        Valid</a>
                    <a name="" id="" class="btn btn-secondary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=noverif"
                        role="button">
                        Tidak Valid</a>
                    <a name="" id="" class="btn btn-warning"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=edit" role="button">
                        Edit Sertifikat</a>
                    <a name="" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=del" role="button">
                        Delete Sertifikat</a>
                </div>
            </div>
        </div>
        <?php
                }else if($data['status']=="tidak valid"){
        ?>
        <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="tab2">
            <!-- ++==++INI TAB UNTUK TIDAK VALID++==++ -->
            <div class="card border-primary">
                <div class="card-body">
                    <h4 class="card-title"><?=$data['id_sertifikat']?>. <?=$data['sertifikat']?></h4>
                    <p class="card-text"><?=$data['nis']?>, <?=$data['nama_siswa']?></p>
                    <p class="card-text"></p>
                    <p class="card-text"><?=$data['jenis_kegiatan']?></p>
                    <a name="" id="" class="btn btn-primary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=lihat" role="button">
                        Lihat Sertifikat</a>
                    <a name="" id="" class="btn btn-success"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=verif" role="button">
                        Valid</a>
                    <a name="" id="" class="btn btn-secondary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=noverif"
                        role="button">
                        Tidak Valid</a>
                    <a name="" id="" class="btn btn-warning"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=edit" role="button">
                        Edit Sertifikat</a>
                    <a name="" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=del" role="button">
                        Delete Sertifikat</a>
                </div>
            </div>
        </div>
        <?php
                }else if($data['status']=="valid"){
        ?>
        <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="tab3">
            <!-- ++==++INI TAB UNTUK VALID BANGET SIH ++==++ -->
            <div class="card border-primary">
                <div class="card-body">
                    <h4 class="card-title"><?=$data['id_sertifikat']?>. <?=$data['sertifikat']?></h4>
                    <p class="card-text"><?=$data['nis']?>, <?=$data['nama_siswa']?></p>
                    <p class="card-text"></p>
                    <p class="card-text"><?=$data['jenis_kegiatan']?></p>
                    <a name="" id="" class="btn btn-primary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=lihat" role="button">
                        Lihat Sertifikat</a>
                    <a name="" id="" class="btn btn-success"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=verif" role="button">
                        Valid</a>
                    <a name="" id="" class="btn btn-secondary"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=noverif"
                        role="button">
                        Tidak Valid</a>
                    <a name="" id="" class="btn btn-warning"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=edit" role="button">
                        Edit Sertifikat</a>
                    <a name="" id="" class="btn btn-danger"
                        href="dashboard.php?page=re-sertifikat&id=<?=$data['id_sertifikat']?>&act=del" role="button">
                        Delete Sertifikat</a>
                </div>
            </div>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>