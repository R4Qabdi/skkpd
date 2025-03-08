<?php
include "../fpdf/fpdf.php";
include "../../koneksi.php";

// Buat objek PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// ===== HEADER (KOP SURAT) ===== //
$pdf->Image('../../gambar/logoti.png', 10, 6, 20); // Logo
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 7, 'SMK TI Bali Global Denpasar', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 7, 'Jl. Tukad Citarum No. 44 Denpasar. Bali', 0, 1, 'C');
$pdf->Cell(190, 7, 'website: https://smkti-baliglobal.sch.id | email: info@smkti-baliglobal.sch.id', 0, 1, 'C');
$pdf->Ln(5);
$pdf->Cell(190, 0, '', 'T', 1, 'C');
$pdf->Ln(10);

// ===== Fungsi Tampilkan Sertifikat ===== //
function tampilSertifikat($pdf, $koneksi, $angkatan, $status = NULL) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(95, 7, 'Angkatan : ' . strtoupper($angkatan), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);

    // Header Tabel
    $pdf->Cell(10, 7, 'No', 1);
    $pdf->Cell(20, 7, 'NIS', 1);
    $pdf->Cell(55, 7, 'Nama Siswa', 1);
    $pdf->Cell(60, 7, 'Jenis Kegiatan', 1);
    $pdf->Cell(33, 7, 'Status', 1);
    $pdf->Cell(12, 7, 'Kelas', 1, 1);

    $query = "SELECT nis, nama_siswa, jenis_kegiatan, kelas, angkatan, jurusan, status
    FROM tb_sertifikat 
    INNER JOIN tb_siswa USING(nis)
    INNER JOIN tb_kegiatan USING(id_kegiatan)
    INNER JOIN tb_jurusan USING(id_jurusan) WHERE angkatan = '$angkatan'";
    if ($status) {
        $query .= " AND tb_sertifikat.status = '$status'";
    }
    $result = mysqli_query($koneksi, $query);

    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 7, $no++, 1);
        $pdf->Cell(20, 7, $row['nis'], 1);
        $pdf->Cell(55, 7, $row['nama_siswa'], 1);
        $pdf->Cell(60, 7, $row['jenis_kegiatan'], 1);
        $pdf->Cell(33, 7, $row['status'], 1);
        $pdf->Cell(12, 7, $row['jurusan']." ".$row['kelas'], 1, 1);
    }
    $pdf->Ln(5);
}

// ===== Fungsi Rekap Kegiatan ===== //
function tampilRekapKegiatan($pdf, $koneksi, $angkatan = NULL, $status = NULL) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(190, 7, 'Rekap Jenis Kegiatan Sertifikat', 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(120, 7, 'Jenis Kegiatan', 1);
    $pdf->Cell(70, 7, 'Total Sertifikat', 1, 1, 'C');

    // Query Data
    $query = "SELECT tb_kegiatan.jenis_kegiatan, COUNT(tb_sertifikat.id_kegiatan) as total 
              FROM tb_sertifikat 
              JOIN tb_kegiatan ON tb_sertifikat.id_kegiatan = tb_kegiatan.id_kegiatan
              JOIN tb_siswa ON tb_sertifikat.nis = tb_siswa.nis";
    $conditions = [];
    if ($angkatan) {
        $conditions[] = "tb_siswa.angkatan = '$angkatan'";
    }
    if ($status) {
        $conditions[] = "tb_sertifikat.status = '$status'";
    }
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }
    $query .= " GROUP BY tb_kegiatan.jenis_kegiatan ORDER BY total DESC";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(120, 7, $row['jenis_kegiatan'], 1);
        $pdf->Cell(70, 7, $row['total'], 1, 1, 'C');
    }
    $pdf->Ln(5);
}

// ===== Panggil Fungsi Berdasarkan Filter User ===== //
$angkatan = isset($_COOKIE['angkatan']) ? $_COOKIE['angkatan'] : 'semua';
$status = isset($_COOKIE['status']) ? $_COOKIE['status'] : 'semua';

if ($angkatan == 'semua' && $status == 'semua') {
    $result_angkatan = mysqli_query($koneksi, "SELECT DISTINCT angkatan FROM tb_siswa ORDER BY angkatan ASC");
    while ($row = mysqli_fetch_assoc($result_angkatan)) {
        tampilSertifikat($pdf, $koneksi, $row['angkatan']);
    }
    tampilRekapKegiatan($pdf, $koneksi);
} elseif ($angkatan != 'semua' && $status == 'semua') {
    tampilSertifikat($pdf, $koneksi, $angkatan);
    tampilRekapKegiatan($pdf, $koneksi, $angkatan);
} elseif ($angkatan == 'semua' && $status != 'semua') {
    $result_angkatan = mysqli_query($koneksi, "SELECT DISTINCT angkatan FROM tb_siswa ORDER BY angkatan ASC");
    while ($row = mysqli_fetch_assoc($result_angkatan)) {
        tampilSertifikat($pdf, $koneksi, $row['angkatan'], $status);
    }
    tampilRekapKegiatan($pdf, $koneksi, NULL, $status);
} else {
    tampilSertifikat($pdf, $koneksi, $angkatan, $status);
    tampilRekapKegiatan($pdf, $koneksi, $angkatan, $status);
}

// Output PDF
$pdf->Output();
?>