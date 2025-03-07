<?php
if(isset($_POST['tombol_tambah'])){
    $kategori       = htmlspecialchars($_GET['kategori']);
    $sub_kategori   = htmlspecialchars($_GET['sub_kategori']);
    $kegiatan       = htmlspecialchars($_POST['kegiatan']);
    $cek_kegiatan   = mysqli_query($koneksi, "SELECT jenis_kegiatan FROM tb_kegiatan WHERE jenis_kegiatan = '$kegiatan'");
    if(mysqli_num_rows($cek_kegiatan) > 0){
        echo "<script>alert('Data Sudah ada di database, silahkan masukkan jenis kegiatan baru');window.location.href='dashboard.php?page=in-kategori-kegiatan&kategori=".$kategori."&sub_kategori=".$sub_kategori."'</script>";
    }else{
        $kategori       = htmlspecialchars($_POST['kategori']);
        $sub_kategori   = htmlspecialchars($_POST['sub_kategori']);
        $id_kategori    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_kategori FROM tb_kategori WHERE sub_kategori = '$sub_kategori'"))['id_kategori'];
        $point          = htmlspecialchars($_POST['point']);
        
        $hasil = mysqli_query($koneksi, "INSERT INTO tb_kegiatan VALUES(NULL, '$kegiatan', '$point', '$id_kategori')");    
    
        if(!$hasil){
            echo "<script>alert('gagal memasukkan data');window.location.href='dashboard.php?page=in-kategori-kegiatan'</script>";
        }else{
            echo "<script>alert('Berhasil Menambahkan Data');window.location.href='dashboard.php?page=re-kategori-kegiatan'</script>";
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center">Tambah Kategori Kegiatan</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Pilih Kategori</label>
                            <select class="form-select" name="kategori" id="kategori"
                                onchange="pilihKategori(this.value)">
                                <option selected>Pilih Kategori</option>
                                <?php
                                $list_kategori = mysqli_query($koneksi, "SELECT kategori FROM tb_kategori GROUP BY kategori");
                                while ($data_kategori = mysqli_fetch_assoc($list_kategori)) {
                                ?>
                                <option value="<?= $data_kategori['kategori'] ?>"
                                    <?php if (@$_GET['kategori'] == $data_kategori['kategori']) { echo "selected"; } ?>>
                                    <?= $data_kategori['kategori'] ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <script>
                        function pilihKategori(value) {
                            window.location.href = 'dashboard.php?page=in-kategori-kegiatan&kategori=' + value;
                        }
                        </script>

                        <?php
                        if (@$_GET['kategori']) {
                            $kategori = htmlspecialchars($_GET['kategori']);
                        ?>
                        <div class="mb-3">
                            <label for="sub_kategori" class="form-label">Pilih Sub-Kategori</label>
                            <select class="form-select" name="sub_kategori" id="sub_kategori"
                                onchange="pilihSubKategori(this.value)">
                                <option selected>Pilih Sub Kategori</option>
                                <?php
                                $list_kategori = mysqli_query($koneksi, "SELECT sub_kategori FROM tb_kategori WHERE kategori='$kategori'");
                                while ($sub_kategori = mysqli_fetch_assoc($list_kategori)) {
                                ?>
                                <option value="<?= $sub_kategori['sub_kategori'] ?>"
                                    <?php if (@$_GET['sub_kategori'] == $sub_kategori['sub_kategori']) { echo "selected"; } ?>>
                                    <?= $sub_kategori['sub_kategori'] ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <script>
                        function pilihSubKategori(value) {
                            const urlParams = new URLSearchParams(window.location.search);
                            const kategori = urlParams.get('kategori');
                            window.location.href =
                                `dashboard.php?page=in-kategori-kegiatan&kategori=${kategori}&sub_kategori=${value}`;
                        }
                        </script>
                        <?php
                        }
                        ?>

                        <?php
                        if (@$_GET['sub_kategori']) {
                            $kategori = htmlspecialchars($_GET['kategori']);
                            $sub_kategori = htmlspecialchars($_GET['sub_kategori']);
                        ?>
                        <input type="hidden" name="kategori" value="<?= $kategori ?>">
                        <input type="hidden" name="sub_kategori" value="<?= $sub_kategori ?>">

                        <datalist id="kegiatan">
                            <?php
                            $list_kategori = mysqli_query($koneksi, "SELECT sub_kategori, jenis_kegiatan FROM tb_kegiatan INNER JOIN tb_kategori USING(id_kategori) WHERE sub_kategori='$sub_kategori'");
                            while ($data_kegiatan = mysqli_fetch_assoc($list_kategori)) {
                            ?>
                            <option value="<?= $data_kegiatan['jenis_kegiatan'] ?>">
                            </option>
                            <?php
                            }
                            ?>
                        </datalist>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" name="kegiatan" list="kegiatan" id="kegiatan"
                                placeholder="Masukkan Nama Kegiatan" required />
                        </div>
                        <div class="mb-3">
                            <label for="point" class="form-label">Angka Kredit / Point</label>
                            <input type="number" class="form-control" name="point" id="point"
                                placeholder="Masukkan Angka Kredit / Point" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100" value="Simpan" name="tombol_tambah">
                            Submit
                        </button>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-5 p-5"></div>