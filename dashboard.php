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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php?page=home"><?=$_COOKIE['username']?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php?page=home" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-siswa"> Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-sertifikat"> Sertifikat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-jurusan"> Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=re-kategori-kegiatan"> Kategori Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stl-page/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stl-page/logout.php">Logout</a>
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
        case "re-operator":
            include "pages/operator/re-operator.php";
        break;
        case "up-operator":
            include "pages/operator/up-operator.php";
        break;


        case "in-pengguna":
            include "pages/pengguna/in-pengguna.php";
        break;
        case "re-pengguna":
            include "pages/pengguna/re-pengguna.php";
        break;
        case "up-pengguna":
            include "pages/pengguna/up-pengguna.php";
        break;
        case "up-pengguna-siswa":
            include "pages/pengguna/up-pengguna-siswa.php";
        break;
        case "up-pengguna-op":
            include "pages/pengguna/up-pengguna-operator.php";
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
        case "see-sertifikat":
            include "pages/sertifikat/see-sertifikat.php";
        break;
        case "up-sertifikat":
            include "pages/sertifikat/up-sertifikat.php";
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
    ?>
    <?php
}else if ($level == 'siswa'){
?>
    <!-- Dashboard for Siswa -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php?page=home"><?=$_COOKIE['nis']?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php?page=home" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=sertif"> Sertifikat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=pass">Ganti Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stl-page/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stl-page/logout.php">Logout</a>
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
    <footer class="bg-primary text-white text-center py-3">
        <div class="container">
            <p>&copy; 2025 Qwentifer. All rights reserved.</p>
            <p>Follow me on:
                <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                <a href="https://github.com/R4Qabdi/" class="text-white me-2"><i class="bi bi-github"></i></a>
            </p>
        </div>
    </footer>

</body>

</html>