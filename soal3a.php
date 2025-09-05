<?php
include "config.php";

// Query laporan jumlah orang per hobi
$sql = "SELECT hobi, COUNT(DISTINCT person_id) AS jumlah_person 
        FROM hobi 
        GROUP BY hobi 
        ORDER BY jumlah_person DESC";
$result = $conn->query($sql);

// Simpan hasil laporan
$laporan = [];
while ($row = $result->fetch_assoc()) {
    $laporan[] = $row;
}

// pencarian
$hasilPencarian = [];
$hobiDicari = "";
if (isset($_POST['search'])) {
    $hobiDicari = $_POST['hobi'];

    $sql = "SELECT p.nama, p.alamat 
            FROM person p 
            JOIN hobi h ON p.id = h.person_id 
            WHERE h.hobi = '$hobiDicari'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $hasilPencarian[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hobi</title>
</head>
<body>
    <h2>Laporan Jumlah Orang per Hobi</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Hobi</th>
            <th>Jumlah Person</th>
        </tr>
        <?php foreach ($laporan as $row): ?>
            <tr>
                <td><?= $row['hobi'] ?></td>
                <td><?= $row['jumlah_person'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3 style="margin-top:20px;">Cari berdasarkan Hobi</h3>
    <form method="post">
        <input type="text" name="hobi" placeholder="Masukkan nama hobi..." required>
        <button type="submit" name="search">Cari</button>
    </form>

    <?php if (!empty($hasilPencarian)): ?>
        <h2>Hasil Pencarian: <?= $hobiDicari ?></h2>
        <ul>
            <?php foreach ($hasilPencarian as $row): ?>
                <li><?= $row['nama'] ?> - <?= $row['alamat'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($_POST['search'])): ?>
        <p>Tidak ada orang dengan hobi <strong><?= $hobiDicari ?></strong>.</p>
    <?php endif; ?>
</body>
</html>
