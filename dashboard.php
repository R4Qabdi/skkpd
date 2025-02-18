<?php
    include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdn.tailwindcss.com/"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand ms-5" href="dashboard.php?page=home">Navbar</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php?page=home" aria-current="page">Home <span
                            class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">view</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="dashboard.php?page=re-siswa">tabel siswa</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-operator">tabel operator</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-pengguna">tabel pengguna</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-sertifikat">tabel sertifikat</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-kegiatan">tabel kegiatan</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-kategori">tabel kategori</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-jurusan">tabel jurusan</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">input</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="dashboard.php?page=in-siswa">input siswa</a>
                        <a class="dropdown-item" href="dashboard.php?page=in-operator">input operator</a>
                        <a class="dropdown-item" href="dashboard.php?page=in-pengguna">input pengguna</a>
                        <a class="dropdown-item" href="dashboard.php?page=in-sertifikat">input sertifikat</a>
                        <a class="dropdown-item" href="dashboard.php?page=in-kegiatan">input kegiatan</a>
                        <a class="dropdown-item" href="dashboard.php?page=in-kategori">input kategori</a>
                        <a class="dropdown-item" href="dashboard.php?page=re-jurusan">tabel jurusan</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="stl-page/login.php" aria-current="page">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="stl-page/logout.php" aria-current="page">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-md p-5">

    </div>
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
        case "up-sertifikat":
            include "pages/sertifikat/up-sertifikat.php";
        break;
        
        case "in-kegiatan":
            include "pages/kegiatan/in-kegiatan.php";
        break;
        case "re-kegiatan":
            include "pages/kegiatan/re-kegiatan.php";
        break;
        case "up-kegiatan":
            include "pages/kegiatan/up-kegiatan.php";
        break;
        
        case "in-kategori":
            include "pages/kategori/in-kategori.php";
        break;
        case "re-kategori":
            include "pages/kategori/re-kategori.php";
        break;
        case "up-kategori":
            include "pages/kategori/up-kategori.php";
        break;
    }
    ?>
</body>

</html>