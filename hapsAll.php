<?php
session_start();

// Hapus semua data siswa
unset($_SESSION["studentsData"]);

// Redirect kembali ke halaman utama
header('Location: index.php');
exit();
?>
