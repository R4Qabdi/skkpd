<?php


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
                    <a class="nav-link active" href="#" aria-current="page">Home <span
                            class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">view</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="dashboard.php?page=re-siswa">tabel siswa</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">input</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="dashboard.php?page=in-siswa">input siswa</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-md p-5">
    </div>
    <?php
    switch(@$_GET['page']){
        case "in-siswa":
            include "pages/in-siswa.php";
        break;
        case "re-siswa":
            include "pages/re-siswa.php";
        break;
        case "up-siswa":
            include "pages/up-siswa.php";
        break;
        case "home":
            include "pages/home.php";
        break;
        default:
            include "pages/notfound.php";
        break;
    }
    ?>
</body>

</html>