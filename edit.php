<?php
session_start();

// Cek apakah id sudah ada di query string
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

// Ambil data siswa untuk diedit
$student = $_SESSION["studentsData"][$id];
$error = '';
$success = '';

// Proses data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentName = trim($_POST["name"]);
    $studentNIS = trim($_POST["nis"]);
    $studentRayon = trim($_POST["rayon"]);

    // Validasi input
    if (empty($studentName) || empty($studentNIS) || empty($studentRayon)) {
        $error = '<div class="alert alert-danger text-center mt-3">Semua kolom harus diisi</div>';
    } else {
        // Update data siswa di sesi
        $_SESSION["studentsData"][$id] = [
            "name" => $studentName,
            "nis" => $studentNIS,
            "rayon" => $studentRayon
        ];
        $success = '<div class="alert alert-success text-center mt-3">Data siswa berhasil diperbarui</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control { width: 100%; margin-bottom: 10px; }
        .container { max-width: 800px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data Siswa</h1>
    <div class="card p-4">
        <form action="" method="post" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']); ?>" required placeholder="Masukkan Nama">
            </div>
            <div class="col-md-4">
                <input type="text" name="nis" class="form-control" value="<?= htmlspecialchars($student['nis']); ?>" required placeholder="Masukkan NIS">
            </div>
            <div class="col-md-4">
                <input type="text" name="rayon" class="form-control" value="<?= htmlspecialchars($student['rayon']); ?>" required placeholder="Masukkan Rayon">
            </div>
            <div class="col-12 text-center">
                <button name="submit" type="submit" class="btn btn-primary">Perbarui</button>
                <a class="btn btn-secondary" href="index.php">Batal</a>
            </div>
        </form>
        <?= $error; ?>
        <?= $success; ?>
    </div>
</div>
</body>
</html>
