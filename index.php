<?php
session_start();

// Inisialisasi pesan error dan sukses
$error = '';
$success = '';

// Inisialisasi tombol aksi
$deleteButton = '';
$printButton = '';

// Cek jika data siswa belum ada di sesi
if (!isset($_SESSION["studentsData"])) {
    $_SESSION["studentsData"] = [];
}

// Proses data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    // Ambil nilai dari form dan hilangkan whitespace yang tidak perlu
    $studentName = trim($_POST["name"]);
    $studentNIS = trim($_POST["nis"]);
    $studentRayon = trim($_POST["rayon"]);

    // Validasi input
    if (empty($studentName) || empty($studentNIS) || empty($studentRayon)) {
        $error = '<div class="alert alert-danger text-center mt-3">Semua kolom harus diisi</div>';
    } else {
        // Cek apakah nama siswa sudah ada dalam data siswa yang tersimpan di sesi
        foreach ($_SESSION["studentsData"] as $student) {
            if ($student["name"] == $studentName) {
                $error = '<div class="alert alert-danger text-center mt-3">Nama siswa sudah ada</div>';
                break;
            }
        }

        // Jika tidak ada error, tambahkan data baru ke sesi
        if (empty($error)) {
            $_SESSION["studentsData"][] = [
                "name" => $studentName,
                "nis" => $studentNIS,
                "rayon" => $studentRayon
            ];
            $success = '<div class="alert alert-success text-center mt-3">Data siswa berhasil ditambahkan</div>';
        }
    }
}

// Buat tombol hapus dan print jika ada data siswa
if (!empty($_SESSION["studentsData"])) {
    $deleteButton = '<a class="btn btn-danger mt-2 me-2" href="hapsAll.php">Hapus Semua</a>';
    $printButton = '<a class="btn btn-success mt-2" href="pri.php">Print</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control { width: 100%; margin-bottom: 10px; }
        .container { max-width: 800px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Masukkan Data Siswa</h1>
    <div class="card p-4">
        <form action="" method="post" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="rayon" class="form-control" placeholder="Masukkan Rayon" required>
            </div>
            <div class="col-12 text-center">
                <button name="submit" type="submit" class="btn btn-primary">Tambah</button>
                <?= $deleteButton; ?>
                <?= $printButton; ?>
            </div>
        </form>
        <?= $error; ?>
        <?= $success; ?>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Rayon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION["studentsData"])): ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="alert alert-danger" role="alert">
                                Tidak ada data
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION["studentsData"] as $index => $student): ?>
                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= htmlspecialchars($student["name"]); ?></td>
                            <td><?= htmlspecialchars($student["nis"]); ?></td>
                            <td><?= htmlspecialchars($student["rayon"]); ?></td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="haps.php?id=<?= $index ?>">Hapus</a>
                                <a class="btn btn-warning btn-sm" href="edit.php?id=<?= $index ?>">Edit</a>
                                <a class="btn btn-info btn-sm" href="det.php?id=<?= $index ?>">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
