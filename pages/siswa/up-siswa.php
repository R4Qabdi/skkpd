<?php
$ceknis = $_GET['nis'];
if(isset($_POST['submit'])){
    $absen = substr($_POST['absen'], 0, 2);
    $nama = substr($_POST['nama'], 0, 100);
    $telp = substr($_POST['telp'], 0, 20);
    $email = substr($_POST['email'], 0, 36);
    $kelas = substr($_POST['kelas'], 0, 5);
    $angkatan = $_POST['angkatan'];
    $jurusan = $_POST['jurusan'];

    $result = mysqli_query($koneksi, "UPDATE tb_siswa SET absen='$absen', nama_siswa='$nama', telp='$telp', email='$email', kelas='$kelas', angkatan='$angkatan', id_jurusan='$jurusan' WHERE nis='$ceknis'");
    
    $pass = substr($_POST['pass'], 0, 64);
    $konpass = substr($_POST['konpass'], 0, 64);
    $resultp = true; // Initialize $resultp to true
    if ($pass != '' || $konpass != '' ){
        if($pass == $konpass){
            $hashed = password_hash($pass , PASSWORD_DEFAULT);
            $resultp = mysqli_query($koneksi, "UPDATE tb_pengguna SET password='$hashed' WHERE nis = '$ceknis'");
        }else{
            $result = 0;
            echo"<script>alert('Password dan Konfirmasi password harus sama');</script>";
        }
    }

    if($result && $resultp){
        echo"<script>alert('data berhasil diupdate');window.location.href='dashboard.php?page=re-siswa';</script>";
    }else{
        echo"<script>alert('data gagal diupdate');window.location.href='dashboard.php?page=up-siswa&&nis=$ceknis';</script>";
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Update Data Siswa</h3>
                    <form action="" method="post">
                        <?php
                        $ceknis = $_GET['nis'];
                        $data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM tb_siswa INNER JOIN tb_jurusan USING(id_jurusan) WHERE nis='$ceknis'"));
                        ?>
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input value="<?= htmlspecialchars($data['nis']) ?>" type="number" class="form-control"
                                name="nis" id="nis" maxlength="5" placeholder="NIS" disabled />
                        </div>
                        <div class="mb-3">
                            <label for="absen" class="form-label">Absen</label>
                            <input type="number" class="form-control" name="absen" id="absen" maxlength="2"
                                placeholder="Nomor Absen" value="<?= htmlspecialchars($data['absen']) ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama" id="nama" maxlength="100"
                                placeholder="Nama Siswa" value="<?= htmlspecialchars($data['nama_siswa']) ?>"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" name="telp" id="telp" maxlength="20"
                                placeholder="Nomor Telepon" value="<?= htmlspecialchars($data['telp']) ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="36"
                                placeholder="Email" value="<?= htmlspecialchars($data['email']) ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" name="kelas" id="kelas" maxlength="5"
                                placeholder="Kelas" value="<?= htmlspecialchars($data['kelas']) ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <select class="form-select" name="angkatan" id="angkatan" required>
                                <option value="" selected disabled>Pilih Angkatan</option>
                                <option value="2023" <?= $data['angkatan'] == '2023' ? 'selected' : '' ?>>2023</option>
                                <option value="2024" <?= $data['angkatan'] == '2024' ? 'selected' : '' ?>>2024</option>
                                <option value="2025" <?= $data['angkatan'] == '2025' ? 'selected' : '' ?>>2025</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" name="jurusan" id="jurusan" required>
                                <option value="" selected disabled>Pilih Jurusan</option>
                                <?php
                                $data_jurusan = mysqli_query($koneksi, "SELECT * from tb_jurusan");
                                while($dataj = mysqli_fetch_assoc($data_jurusan)){
                                ?>
                                <option value="<?= htmlspecialchars($dataj['id_jurusan']) ?>"
                                    <?= $data['id_jurusan'] == $dataj['id_jurusan'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dataj['jurusan']) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" id="pass" maxlength="64"
                                placeholder="Password" />
                        </div>
                        <div class="mb-3">
                            <label for="konpass" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="konpass" id="konpass" maxlength="64"
                                placeholder="Konfirmasi Password" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>