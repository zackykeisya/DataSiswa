<?php
session_start();

// Cek apakah id sudah ada di query string dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = intval($_GET['id']);

// Cek apakah data siswa dengan id tersebut ada
if (!isset($_SESSION["studentsData"][$id])) {
    header('Location: index.php');
    exit();
}

// Ambil data siswa untuk ditampilkan
$student = $_SESSION["studentsData"][$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 800px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Data Siswa</h1>
    <div class="card p-4">
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label">Nama:</label>
            <div class="col-sm-8">
                <p class="form-control-plaintext"><?= htmlspecialchars($student['name']); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label">NIS:</label>
            <div class="col-sm-8">
                <p class="form-control-plaintext"><?= htmlspecialchars($student['nis']); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 col-form-label">Rayon:</label>
            <div class="col-sm-8">
                <p class="form-control-plaintext"><?= htmlspecialchars($student['rayon']); ?></p>
            </div>
        </div>
        <div class="text-center">
            <a class="btn btn-secondary" href="index.php">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>
