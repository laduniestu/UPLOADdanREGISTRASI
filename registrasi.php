<?php
    require 'functions.php';
    if(isset($_POST['register'])){
        if(Registrasi($_POST) > 0) {
            echo "
                <style>
                    alert('User berhasil ditambahkan');
                </style>
            ";
        }else {
            echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Form Registrasi </title>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        label 
        {
            display : block;
        }
    </style>
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
    <center><h1>Registrasi</h1></center><br>
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Nama" class="col-sm-4 control-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" required>
            </div>
        </div>
        <div class="form-group">
            <label for="Password" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <label for="Nama" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="password2" placeholder="Masukkan ulang Password" name="password2" required>
            </div>
        </div>
        <div class="form-group">
            <center><button type="submit" name="register" class="btn btn-primary">Tambah</button>
        </div>
    </form>
</body>
</html>