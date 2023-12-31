<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body style = "background-color: burlywood; ">
    <div class="container" style="width:800px; margin-top:50px;">
        <h1 style="color:white;">Data Mahasiswa</h1>
        <hr>
        <form action="aksi.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="nama" class="col-md-2">Nama Lengkap</label>
                <div class="col-md-10"><input type="varchar" name="nama" id="nama" class="form-control"></div>
            </div>

            <div class="mb-3 row">
                <label for="nim" class="col-md-2">NIM</label>
                <div class="col-md-10"><input type="varchar" name="nim" id="nim" class="form-control"></div>
            </div>

            <div class="mb-3 row">
                <label for="tgl_lahir" class="col-md-2">Tanggal Lahir</label>
                <div class="col-md-10"><input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" ></div>
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="col-md-2">Alamat</label>
                <div class="col-md-10"><input type="varchar" name="alamat" id="alamat" class="form-control"></div>
            </div>


            <div class="mb-3 row">
                <div class="offset-2 col-md-10">
                    <input type="submit" name="aksi" value="Submit" class="btn btn-primary">
                </div>
            </div>
            
        </form>  
        <div class="mb-3 row">
            <div class="offset-2 col-md-10">
                <button class="btn btn-info text-white"><a href="data.php" class="text-white">Lihat Detail</a></button>
            </div>
        </div>
    </div>
    <footer>
        <p style="text-align:center;">Created By: Tsania Camila</p>
    </footer>
</body>
</html>