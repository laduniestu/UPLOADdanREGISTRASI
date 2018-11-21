<?php
    require 'functions.php';
    $mahasiswa=query("SELECT * FROM mahasiswa");

    if(isset($_POST["cari"]))
    {
        $mahasiswa=cari($_POST["keyword"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.js"></script>
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./tambah_data.php">Tambah Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./registrasi.php">Register</a>
        </li>
        <li>
        <form action="" method="post" class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="keyword" autofocus autocomplete="off">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Search</button>
        </form>
        </li>
    </ul>
    <center><h1>Daftar Mahasiswa</h1></center><br>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama</th>
            <th scope="col">Nim</th>
            <th scope="col">Email</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Gambar</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <?php $i=1 ?>
        <!-- kita buat contoh data static -->
        <?php foreach($mahasiswa as $row):?>
        <tbody>
            <tr>
            <td scope="row"><?= $i; ?></td>
            <td scope="row"><?= $row["Nama"]; ?></td>
            <td scope="row"><?= $row["Nim"]; ?></td>
            <td scope="row"><?= $row["Email"]; ?></td>
            <td scope="row"><?= $row["Jurusan"]; ?></td>
            <td scope="row"> <img src="image/<?php echo $row["Gambar"]; ?>" alt="" srcset="" width="100" height="100"></td>
            <td>
                <a href="edit.php?id=<?php echo $row["id"];?>">Edit</a>
                
                <a href="hapus.php?id=<?php echo $row["id"]; ?> "onclick="return confirm('Apakah data ini akan dihapus')">Hapus</a>
            </td>
            </tr>
        </tbody>
        <?php $i++ ?>
        <?php endforeach;?>
    </table>
</body>
</html>

