<?php
if(!@$_COOKIE['level_user']) {
    echo "<script>alert('belum login');window.location.href='../login.php'</script>";
}elseif($_COOKIE['level_user']=='operator') {
    echo "<script>alert('anda operator, silahkan kembali');window.location.href='dashboard.php?page=sertifikat'</script>";
}
$nis = $_COOKIE['nis'];

if(isset($_POST['tombol_upload']) && isset($_FILES["sertifikat"])){
    $tgl_Upload = date("Y-m-d");
    $sertifikat = $_FILES["sertifikat"]['name'];
    $kegiatan = htmlspecialchars($_POST['jenis_kegiatan']);
    $id_kegiatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_kegiatan FROM tb_kegiatan WHERE jenis_kegiatan = '$kegiatan'"))['id_kegiatan'];
    $file = $_FILES["sertifikat"];
    $folder = "sertifikat/";
    $ekstensi = strtolower(pathinfo($_FILES["sertifikat"]['name'], PATHINFO_EXTENSION));
    $ukuran = $file["size"];

    // Validasi file atau cek file
    if ($ekstensi !== "pdf") {
        echo "Hanya file .pdf yang diperbolehkan!";
    } elseif ($ukuran > 2097152) { // 2MB dalam byte
        echo "Ukuran file terlalu besar! Maksimal 2MB.";
    } else {
        // Generate nama file baru dengan format NIS + 5 random karakter
        do {
            $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 5);
            $newFileName = $nis . $randomString . ".pdf";
            $targetFile = $folder . $newFileName;
        } while (file_exists($targetFile)); // Cek apakah file sudah ada, jika ada buat ulang
        
        // Proses upload
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            $hasil = mysqli_query($koneksi, "INSERT INTO tb_sertifikat VALUES(NULL, '$tgl_Upload', NULL, '$newFileName', 'menunggu validasi', NULL, '$nis', '$id_kegiatan')");

            $id = mysqli_fetch_row(mysqli_query($koneksi, "SELECT LAST_INSERT_ID()"))[0];
            
            // Insert notification
            $message = "Siswa dengan NIS $nis telah mengunggah sertifikat baru.";
            $id_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_pengguna FROM tb_pengguna WHERE nis = '$nis'"))['id_pengguna'];
            mysqli_query($koneksi, "INSERT INTO tb_notifikasi VALUES (null, NOW(), 'unread', '$message', '$id_pengguna')");

            if ($hasil) {
                echo "<script>alert('Berhasil Mengunggah Sertifikat');window.location.href='dashboard.php?page=cek_sertifikat_siswa&id=".$id."&file=".$newFileName."'</script>";
            } else {
                echo "Gagal Mengunggah File: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Upload Sertifikat</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="kategori">Pilih Kategori</label>
                            <select name="kategori" class="form-control" onchange="pilihKategori(this.value)">
                                <option value="">Pilih Kategori</option>
                                <?php
                                $list_kategori = mysqli_query($koneksi, "SELECT kategori FROM tb_kategori GROUP BY kategori");
                                while($data_kategori = mysqli_fetch_assoc($list_kategori)){
                                ?>
                                <option value="<?=$data_kategori['kategori']?>"
                                    <?php if(@$_GET['kategori']==$data_kategori['kategori']){ echo "selected";}?>>
                                    <?=$data_kategori['kategori']?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <?php
                        if(@$_GET['kategori']){
                            $kategori = htmlspecialchars($_GET['kategori']);                
                        ?>
                        <div class="form-group mt-3">
                            <label for="sub_kategori">Pilih Sub Kategori</label>
                            <select name="sub_kategori" class="form-control" onchange="pilihSubKategori(this.value)">
                                <option value="">Pilih Sub Kategori</option>
                                <?php
                                $list_kategori = mysqli_query($koneksi, "SELECT sub_kategori FROM tb_kategori WHERE kategori='$kategori'");
                                while($sub_kategori = mysqli_fetch_assoc($list_kategori)){
                                ?>
                                <option value="<?=$sub_kategori['sub_kategori']?>"
                                    <?php if(@$_GET['sub_kategori']==$sub_kategori['sub_kategori']){ echo "selected";}?>>
                                    <?=$sub_kategori['sub_kategori']?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        }
                        ?>

                        <?php
                        if(@$_GET['sub_kategori']){
                            $kategori = htmlspecialchars($_GET['kategori']);
                            $sub_kategori = htmlspecialchars($_GET['sub_kategori']);   
                            @$Id_Kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_kategori FROM tb_kategori WHERE sub_kategori = '$sub_kategori'"))['id_kategori'];         
                        ?>
                        <div class="form-group mt-3">
                            <label for="jenis_kegiatan">Pilih Jenis Kegiatan</label>
                            <select name="jenis_kegiatan" class="form-control" onchange="pilihJenisKegiatan(this.value)"
                                required>
                                <option value="">Pilih Jenis Kegiatan</option>
                                <?php
                                // Ambil daftar kegiatan berdasarkan kategori
                                $list_kategori = mysqli_query($koneksi, "SELECT jenis_kegiatan FROM tb_kegiatan WHERE id_kategori='$Id_Kategori'");
                                
                                // Ambil daftar kegiatan yang sudah diikuti oleh siswa (untuk disable option)
                                $list_kegiatan = mysqli_query($koneksi, "SELECT jenis_kegiatan FROM tb_kegiatan INNER JOIN tb_sertifikat USING(id_kegiatan) INNER JOIN tb_kategori USING(id_kategori) WHERE nis='$nis' AND kategori='wajib' GROUP BY jenis_kegiatan");
                                
                                // Buat array untuk menyimpan kegiatan yang sudah diikuti
                                $kegiatan_terdaftar = [];
                                while ($row = mysqli_fetch_assoc($list_kegiatan)) {
                                    $kegiatan_terdaftar[] = $row['jenis_kegiatan'];
                                }

                                // Loop daftar kegiatan dan tampilkan dalam <option>
                                while ($jenis_kegiatan = mysqli_fetch_assoc($list_kategori)) {
                                    $nama_kegiatan = $jenis_kegiatan['jenis_kegiatan'];
                                    $isDisabled = in_array($nama_kegiatan, $kegiatan_terdaftar) ? "disabled" : "";
                                    $isSelected = (isset($_GET['jenis_kegiatan']) && $_GET['jenis_kegiatan'] === $nama_kegiatan) ? "selected" : "";
                                ?>
                                <option value="<?= htmlspecialchars($nama_kegiatan) ?>" <?= $isDisabled ?>
                                    <?= $isSelected ?>>
                                    <?= htmlspecialchars($nama_kegiatan) ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        }
                        ?>

                        <?php
                        if(@$_GET['jenis_kegiatan']){
                            $kategori = htmlspecialchars($_GET['kategori']);
                            $sub_kategori = htmlspecialchars($_GET['sub_kategori']);
                            $jenis_kegiatan = htmlspecialchars($_GET['jenis_kegiatan']);   
                        ?>
                        <div class="form-group mt-3">
                            <label class="form-label" for="sertifikat">Upload Sertifikat (PDF)</label>
                            <input type="file" class="form-control" accept=".pdf" name="sertifikat" required>
                        </div>
                        <input type="hidden" name="jenis_kegiatan" value="<?=$jenis_kegiatan?>">
                        <div class="text-center mt-4">
                            <input type="submit" name="tombol_upload" value="Upload" class="btn btn-primary">
                        </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function pilihKategori(value) {
    window.location.href = 'dashboard.php?page=upload-sertifikat&kategori=' + value;
}

function pilihSubKategori(value) {
    const urlParams = new URLSearchParams(window.location.search);
    const kategori = urlParams.get('kategori');
    window.location.href = `dashboard.php?page=upload-sertifikat&kategori=${kategori}&sub_kategori=${value}`;
}

function pilihJenisKegiatan(value) {
    const urlParams = new URLSearchParams(window.location.search);
    const kategori = urlParams.get('kategori');
    const sub_kategori = urlParams.get('sub_kategori');
    window.location.href =
        `dashboard.php?page=upload-sertifikat&kategori=${kategori}&sub_kategori=${sub_kategori}&jenis_kegiatan=${value}`;
}
</script>
<div class="m-5"></div>