<?php
setcookie('nis', '', time(), '/');
setcookie('nama_lengkap', '', time(), '/');
setcookie('level_user', 'siswa', time() , '/');
setcookie('username', '', time(), '/');

echo"<script>alert('berhasil logout'); window.location.href='../stl-page/login.php'</script>";
?>