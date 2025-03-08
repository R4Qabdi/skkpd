<?php
include "../fpdf/fpdf.php";
include "../../koneksi.php";
if (!@$_COOKIE['level_user']) {
    echo "<script>alert('belum login');window.location.href='../../login.php'</script>";
} elseif ($_COOKIE['level_user'] == 'operator') {
    echo "<script>alert('anda operator, silahkan kembali');window.location.href='../../tampilan/halaman_utama.php?page=sertifikat'</script>";
}

$nis = $_COOKIE['nis'];
$nama = $_COOKIE['nama_lengkap'];

$total_point = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(Angka_Kredit) FROM sertifikat INNER JOIN kegiatan USING(Id_Kegiatan) WHERE Status='Valid' AND NIS='$nis'"))[0];

if ($total_point < 30) {
    echo "<script>alert('Poin belum cukup untuk mencetak sertifikat!!!');window.location.href='../../tampilan/halaman_utama.php?page=sertifikat_siswa'</script>";
}


$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->Image('background-sertif.jpeg', 0, 0, 297, 210);

$pdf->Ln(85);
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(0, 10, $nama, 0, 1, 'C');
$pdf->Ln(10);


$pdf->Output();