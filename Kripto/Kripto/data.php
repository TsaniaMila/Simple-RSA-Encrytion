<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body style = "background-color: burlywood; ">
<table class="table table-bordered table-active " >
    <tr class="table-dark">
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
    </tr>

    <?php
    require "aksi.php";
    $query = 'select * from data_mhs where 1';
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $no = 0;
    while ($row = $stmt->fetch()):
        $no++;
        ?>
        <tr>
            <td><?= $row['nim'] ?></td>
            <td><?= decrypt($row["nama"], $private_key) ?></td>
            <td><?= $row['tgl_lahir'] ?></td>
            <td><?= decryptAlamat($row["alamat"], $private_key) ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="index.php" class="btn btn-success">Kembali</a>
</body>
</html>