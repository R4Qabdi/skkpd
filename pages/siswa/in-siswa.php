<?php
if(isset($_POST['submit'])){
    $nis = substr($_POST['nis'], 0, 5);
    $absen = substr($_POST['absen'], 0, 2);
    $nama = substr($_POST['nama'], 0, 100);
    $telp = substr($_POST['telp'], 0, 20);
    $email = substr($_POST['email'], 0, 36);
    $kelas = substr($_POST['kelas'], 0, 5);
    $angkatan = $_POST['angkatan'];
    $jurusan = $_POST['jurusan'];

    if ($lancar = true){
        $resultsiswa = mysqli_query($koneksi, "INSERT INTO tb_siswa VALUES('$nis','$absen','$nama','$telp','$email','$kelas','$angkatan','$jurusan');");
        $pass_siswa = "siswa".$nis;
        $hashedpass = password_hash($pass_siswa , PASSWORD_DEFAULT);
        $resultuser = mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES(null,null,'$nis','$hashedpass')");
    }
    if ($resultsiswa == $resultuser){
        $result = true;
    }else{
        $result = false;
    }

    if ($result){
        echo"<script>alert('data berhasil masuk'); window.location.href = 'dashboard.php?page=re-siswa'</script>";
    }else{
        echo"<script>alert('data gagal masuk'); window.location.href = 'dashboard.php?page=in-siswa'</script>";
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Input Data Siswa</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="number" class="form-control" name="nis" id="nis" maxlength="5"
                                placeholder="NIS" required>
                        </div>
                        <div class="mb-3">
                            <label for="absen" class="form-label">Absen</label>
                            <input type="number" class="form-control" name="absen" id="absen" maxlength="2"
                                placeholder="Nomor Absen" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama" id="nama" maxlength="100"
                                placeholder="Nama Siswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" name="telp" id="telp" maxlength="20"
                                placeholder="Nomor Telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="36"
                                placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas" id="kelas" required>
                                <option value="" selected disabled>Pilih Kelas</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <select class="form-select" name="angkatan" id="angkatan" required>
                                <option value="" selected disabled>Pilih Angkatan</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" name="jurusan" id="jurusan" required>
                                <option value="" selected disabled>Pilih Jurusan</option>
                                <?php
                                $data_jurusan = mysqli_query($koneksi, "SELECT * from tb_jurusan");
                                while($data = mysqli_fetch_assoc($data_jurusan)){
                                ?>
                                <option value="<?= htmlspecialchars($data['id_jurusan']) ?>">
                                    <?= htmlspecialchars($data['jurusan']) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>