<?php
session_start();

// Cek apakah id sudah ada di query string dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Cek apakah data siswa dengan id tersebut ada
    if (isset($_SESSION["studentsData"][$id])) {
        // Hapus data siswa berdasarkan id
        unset($_SESSION["studentsData"][$id]);
        
        // Reindeks array agar tidak ada celah dalam indeks
        $_SESSION["studentsData"] = array_values($_SESSION["studentsData"]);
    }
}

// Redirect kembali ke halaman utama
header('Location: index.php');
exit();
?>
