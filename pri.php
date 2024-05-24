<?php
session_start();

// Cek apakah data siswa ada
if (!isset($_SESSION["studentsData"]) || empty($_SESSION["studentsData"])) {
    echo '<div class="alert alert-danger text-center mt-3" role="alert">Tidak ada data untuk dicetak</div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
        .container { max-width: 800px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Data Siswa</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Rayon</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION["studentsData"] as $index => $student): ?>
                    <tr>
                        <th scope="row"><?= $index + 1; ?></th>
                        <td><?= htmlspecialchars($student['name']); ?></td>
                        <td><?= htmlspecialchars($student['nis']); ?></td>
                        <td><?= htmlspecialchars($student['rayon']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center no-print mt-3">
        <button class="btn btn-primary" onclick="window.print()">Cetak</button>
        <a class="btn btn-secondary" href="index.php">Kembali</a>
    </div>
</div>
</body>
</html>
