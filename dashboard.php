<?php
if(!@$_COOKIE['level_user']){
    echo"<script>alert('mohon login terlebih dahulu');window.location.href = 'stl-page/login.php';</script>";
}
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="bootstrap/cdn/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <script src="bootstrap/cdn/bootstrap.js" crossorigin="anonymous"></script>
    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
        margin-to: 56px;
        /* Adjust based on the height of the navbar */
    }

    footer {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 10px 0;
        margin-top: auto;
    }
    </style>
</head>

<body>
    <?php
$level = $_COOKIE['level_user'];

if($level == 'operator'){
?>
    <!-- Dashboard for Operator -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php?page=home">
                <img src="gambar/logoti.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            </a>
            <a class="navbar-brand" href="dashboard.php?page=home">
                <b>
                    SKKPd
                </b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-siswa">Siswa</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-operator">Operator</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-jurusan">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-sertifikat">Sertifikat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-kategori-kegiatan">Kategori Kegiatan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i> Notifications
                            <?php
                            $notif_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tb_notifikasi WHERE status = 'unread'"))['count'];
                            if ($notif_count > 0) {
                                echo "<span class='badge bg-danger'>$notif_count</span>";
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                            <?php
                            $notifications = mysqli_query($koneksi, "SELECT * FROM tb_notifikasi WHERE status = 'unread' ORDER BY tanggal DESC LIMIT 5");
                            while ($notif = mysqli_fetch_assoc($notifications)) {
                                echo "<li><a class='dropdown-item' href='dashboard.php?page=re-sertifikat&notif_id={$notif['id_notifikasi']}'>{$notif['pesan']}</a></li>";
                            }
                            ?>
                            <li><a class="dropdown-item text-center" href="dashboard.php?page=all-notif">View All</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?=$_COOKIE['username']?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="dashboard.php?page=up-operator&user=<?=$_COOKIE['username']?>&kode=<?php 
                                    $username = $_COOKIE['username'];
                                    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT kode_operator FROM tb_operator WHERE username = '$username'"));
                                    echo $data['kode_operator'];
                                    ?>">Data Operator</a>
                            </li>
                            <li><a class="dropdown-item" href="stl-page/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="stl-page/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-3 mb-5 content"></div>
    <?php
    switch(@$_GET['page']){
        case "home":
            include "pages/home.php";
        break;
        default:
            include "pages/notfound.php";
        break;
        case "all-notif":
            include "pages/all-notifications.php";
        break;
        
        case "in-siswa":
            include "pages/siswa/in-siswa.php";
        break;
        case "og-re-siswa":
            include "pages/siswa/re-siswa.php";
        break;
        case "re-siswa":
            include "pages/siswa/re-siswa-card.php";
        break;
        case "up-siswa":
            include "pages/siswa/up-siswa.php";
        break;
        
        case "in-operator":
            include "pages/operator/in-operator.php";
        break;
        // case "re-operator":
        //     include "pages/operator/re-operator.php";
        // break;
        case "up-operator":
            include "pages/operator/up-operator.php";
        break;
        
        case "in-jurusan":
            include "pages/jurusan/in-jurusan.php";
        break;
        case "re-jurusan":
            include "pages/jurusan/re-jurusan.php";
        break;
        case "up-jurusan":
            include "pages/jurusan/up-jurusan.php";
        break;
        
        case "in-sertifikat":
            include "pages/sertifikat/in-sertifikat.php";
        break;
        case "re-sertifikat":
            include "pages/sertifikat/re-sertifikat.php";
        break;
        case "st-sertifikat":
            include "pages/sertifikat/st-sertifikat.php";
        break;
        case "see-sertifikat":
            include "pages/sertifikat/see-sertifikat.php";
        break;
        
        case "in-kategori-kegiatan":
            include "pages/kategori-kegiatan/in-kategori-kegiatan.php";
        break;
        case "re-kategori-kegiatan":
            include "pages/kategori-kegiatan/re-kategori-kegiatan.php";
        break;
        case "up-kategori-kegiatan":
            include "pages/kategori-kegiatan/up-kategori-kegiatan.php";
        break;
    }
    if (isset($_GET['notif_id'])) {
        $notif_id = $_GET['notif_id'];
        mysqli_query($koneksi, "UPDATE tb_notifikasi SET status = 'read' WHERE id_notifikasi = $notif_id");
    }
    ?>
    <?php
}else if ($level == 'siswa'){
?>
    <!-- Dashboard for Siswa -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php?page=home">
                <img src="gambar/logoti.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            </a>
            <a class="navbar-brand" href="dashboard.php?page=home">
                <b>
                    SKKPd
                </b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=sertif"> Sertifikat</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <?php
                            if(@$_COOKIE['nis']){
                                $nama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_siswa FROM tb_siswa WHERE nis='$_COOKIE[nis]'"))['nama_siswa'];
                                echo $nama;
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="dashboard.php?page=pass">Ganti Password</a>
                            </li>
                            <li><a class="dropdown-item" href="stl-page/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="stl-page/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-3 mb-5 content"></div>
    <?php
    switch(@$_GET['page']){
        case "home":
            include "pages/for-siswa/home.php";
        break;
        default:
            include "pages/notfound.php";
        break;
        
        case "sertif":
            include "pages/for-siswa/sertifikat.php";
        break;
        case "upload-sertifikat":
            include "pages/for-siswa/in-sertifikat.php";
        break;
        case "cek_sertifikat_siswa":
            include "pages/for-siswa/see-sertifikat.php";
        break;
        case "pass":
            include "pages/for-siswa/changepass.php";
        break;
    }
    ?>
    <?php
}
?>

    <!-- Custom Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>Created by Abdi Kesawa. 2025</p>
            <p>Follow me on:
                <a href="https://www.facebook.com/profile.php?id=100086204222090" class="text-white me-2"><i
                        class="bi bi-facebook"></i></a>
                <a href="https://x.com/realjasj" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                <a href="https://www.instagram.com/abdi_kesawa/" class="text-white me-2"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://github.com/R4Qabdi/" class="text-white me-2"><i class="bi bi-github"></i></a>
            </p>
        </div>
    </footer>

</body>

</html>