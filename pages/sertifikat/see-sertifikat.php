<?php
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
if (!$pdfFile){
    echo "File PDF tidak ditemukan!";
    exit;
} 

// Ambil data siswa dan sertifikat
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT nama_siswa, nis, jurusan, kelas, telp, email, angkatan, kategori, sub_kategori, jenis_kegiatan, status, catatan FROM tb_sertifikat INNER JOIN tb_kegiatan USING(id_kegiatan) INNER JOIN tb_kategori USING(id_kategori) INNER JOIN tb_siswa USING(nis) INNER JOIN tb_jurusan USING(id_jurusan) WHERE id_sertifikat = '$id'"));

$tgl = date("Y-m-d");

// Proses update status sertifikat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tombol_submit'])) {
    $status = $_POST['status'];
    $catatan = isset($_POST['catatan']) ? mysqli_real_escape_string($koneksi, $_POST['catatan']) : NULL;

    $updateQuery = "UPDATE tb_sertifikat SET 
                    catatan = " . ($status === 'tidak valid' ? "'$catatan'" : "NULL") . ", 
                    status = '$status', 
                    tanggal_status_berubah = '$tgl' 
                    WHERE id_sertifikat='$id'";

    $hasil = mysqli_query($koneksi, $updateQuery);
    if (!$hasil) {
        echo "<script>alert('Gagal update data');window.location.href='dashboard.php?page=cek_sertifikat&id=$id&file=$pdfFile'</script>";
    } else {
        echo "<script>alert('Berhasil update data');window.location.href='dashboard.php?page=re-sertifikat'</script>";
    }
}
?>
<style>
.pdf-container {
    /* Make the pdf-container wider */
    height: 100%;
    overflow-y: auto;
    border-right: 2px solid #ddd;
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
            <div class="siswa-container p-3 bg-light">
                <h3>Detail Siswa</h3><br>
                <p><strong>Nama:</strong> <?= htmlspecialchars($data["nama_siswa"]) ?></p>
                <p><strong>NIS:</strong> <?= htmlspecialchars($data["nis"]) ?></p>
                <p><strong>Kelas:</strong> <?= htmlspecialchars($data["jurusan"] . " " . $data["kelas"]) ?></p>
                <p><strong>Telepon:</strong> <?= htmlspecialchars($data["telp"]) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($data["email"]) ?></p>
                <p><strong>Angkatan:</strong> <?= htmlspecialchars($data["angkatan"]) ?></p>
                <br><br>

                <h3>Kategori Kegiatan</h3><br>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($data["kategori"]) ?></p>
                <p><strong>Sub Kategori:</strong> <?= htmlspecialchars($data["sub_kategori"]) ?></p>
                <p><strong>Kegiatan:</strong> <?= htmlspecialchars($data["jenis_kegiatan"]) ?></p><br><br>

                <?php if ($data["status"] == "menunggu validasi"){ ?>

                <button id="btn-tidak-valid" type="button" class="btn btn-danger" onclick="toggleInvalid()">Tidak
                    Valid</button>
                <button id="btn-batal" type="button" class="btn btn-secondary" style="display: none;"
                    onclick="cancelInvalid()">Batal</button>
                <form action="" method="POST" class="mt-3">
                    <input type="hidden" name="status" value="valid">
                    <button type="submit" id="btn-valid" class="btn btn-success" name="tombol_submit">Valid</button>
                </form>

                <form action="" method="POST" class="mt-3">
                    <div id="catatan-container" style="display: none;">
                        <textarea name="catatan" class="form-control" placeholder="Tulis catatan di sini..."
                            rows="4"></textarea>
                    </div>
                    <input type="hidden" name="status" value="tidak valid">
                    <button type="submit" name="tombol_submit" id="btn-submit" class="btn btn-primary mt-3"
                        style="display: none;">Submit</button>
                </form>

                <?php }elseif ($data["status"] == "tidak valid"){ ?>
                <div id="catatan-container">
                    <textarea readonly name="catatan" class="form-control" placeholder="Tulis catatan di sini..."
                        rows="4"><?= htmlspecialchars($data["catatan"]) ?></textarea>
                </div>
                <?php } ?>
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