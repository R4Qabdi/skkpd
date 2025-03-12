<?php
if(!@$_COOKIE['level_user']) {
    echo "<script>alert('belum login');window.location.href='../login.php'</script>";
}elseif($_COOKIE['level_user']=='operator') {
    echo "<script>alert('anda operator, silahkan kembali');window.location.href='halaman_utama.php?page=sertifikat'</script>";
}

// Mengambil parameter dari URL
if(isset($_GET['file'])){
    $pdfFile = $_GET['file'];
}else{
    $pdfFile = '';
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = '';
}

// Validasi input
if (!$pdfFile) {
    echo "File PDF tidak ditemukan!";
    exit;
} 

// Ambil data siswa dan sertifikat
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT kategori, sub_kategori, jenis_kegiatan, status, catatan, sertifikat FROM tb_sertifikat INNER JOIN tb_kegiatan USING(id_kegiatan) INNER JOIN tb_kategori USING(id_kategori) WHERE id_sertifikat = '$id'"));

if(isset($_POST['tombol_upload']) && isset($_FILES["sertifikat"])){
    $tgl            = date("Y-m-d");
    $sertifikat     = $_FILES["sertifikat"]['name'];
    $file           = $_FILES["sertifikat"];
    $folder         = "../sertifikat/";
    $ekstensi       = strtolower(pathinfo($_FILES["sertifikat"]['name'], PATHINFO_EXTENSION));
    $ukuran         = $file["size"];
    $nis            = $_COOKIE['nis'];

    // Validasi file atau cek file
    if($ekstensi !== "pdf"){
        echo "Hanya file .pdf yang diperbolehkan!";
    }elseif($ukuran > 2097152){ // 2MB dalam byte
        echo "Ukuran file terlalu besar! Maksimal 2MB.";
    }else{
        // Generate nama file baru dengan format NIS + 5 random karakter
        do {
            $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 5);
            $newFileName = $nis . $randomString . ".pdf";
            $targetFile = $folder . $newFileName;
        } while (file_exists($targetFile)); // Cek apakah file sudah ada, jika ada buat ulang

        // Hapus file lama jika ada
        $file_path = "../sertifikat/" . $data['sertifikat'];
        if (!empty($data['sertifikat']) && file_exists($file_path)) {
            unlink($file_path);
        }

        // Upload file dengan nama baru
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Update database dengan nama file baru
            $update = mysqli_query($koneksi, "UPDATE tb_sertifikat 
                      SET sertifikat='$newFileName', status='Menunggu Validasi', tanggal_status_berubah='$tgl' 
                      WHERE id_sertifikat='$id'");

            if ($update) {
                echo "<script>alert('Berhasil Mengunggah Ulang Sertifikat');window.location.href='halaman_utama.php?page=cek_sertifikat_siswa&id=".$id."&file=".$newFileName."'</script>";
            } else {
                echo "Gagal mengupdate database: " . mysqli_error($koneksi);
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    }
}
?>
<style>
.pdf-container {
    height: 100%;
    overflow-y: auto;
    border-right: 2px solid #ddd;
}

.siswa-container {
    background-color: #f8f9fa;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.siswa-container h3 {
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.siswa-container p {
    margin-bottom: 10px;
}

.siswa-container .btn {
    margin-top: 10px;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="pdf-container">
                <embed src="sertifikat/<?= htmlspecialchars($pdfFile) ?>" type="application/pdf" width="100%"
                    height="100%">
            </div>
        </div>
        <div class="col-md-4">
            <div class="siswa-container">
                <h3 class="text-warning"><?= htmlspecialchars($data["status"]) ?></h3>
                <br><br>

                <h3>Kategori Kegiatan</h3><br>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($data["kategori"]) ?></p>
                <p><strong>Sub Kategori:</strong> <?= htmlspecialchars($data["sub_kategori"]) ?></p>
                <p><strong>Kegiatan:</strong> <?= htmlspecialchars($data["jenis_kegiatan"]) ?></p><br><br>

                <?php if ($data["status"] == "tidak valid"){ ?>
                <div id="catatan-container">
                    <h3>Catatan</h3>
                    <textarea readonly name="catatan" class="form-control"
                        style="height: 150px"><?= htmlspecialchars($data["catatan"]) ?></textarea>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                    <div class="form-group">
                        <label for="sertifikat">Upload Ulang Sertifikat (PDF)</label>
                        <input type="file" class="form-control-file" accept=".pdf" name="sertifikat" required>
                    </div>
                    <button type="submit" name="tombol_upload" class="btn btn-primary mt-3">Upload Ulang</button>
                </form>
                <?php }else{ ?>
                <div class="mb-5 mt-5 pb-5 pt-5"></div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<script>
function toggleInvalid() {
    document.getElementById('btn-tidak-valid').style.display = 'none';
    document.getElementById('btn-valid').style.display = 'none';
    document.getElementById('btn-batal').style.display = 'inline-block';
    document.getElementById('btn-submit').style.display = 'inline-block';
    document.getElementById('catatan-container').style.display = 'block';
}

function cancelInvalid() {
    document.getElementById('btn-tidak-valid').style.display = 'inline-block';
    document.getElementById('btn-valid').style.display = 'inline-block';
    document.getElementById('btn-batal').style.display = 'none';
    document.getElementById('btn-submit').style.display = 'none';
    document.getElementById('catatan-container').style.display = 'none';
}
</script>