<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data</title>
</head>
<body>
    <?php
        // buat koneksi
        $conn=mysqli_connect("localhost","root","","phpdatabase");

        // cek apakah button submit sudah di tekan atau belum
        if(isset($_POST['submit'])){
            // ambil data dari tiap element dalam form yang disimpan di variabel baru
            $nama=$_POST["Nama"];
            $nim=$_POST["Nim"];
            $email=$_POST["Email"];
            $jurusan=$_POST["Jurusan"];
            $gambar=$_POST["Gambar"];

            // query insert data
            $query = " INSERT INTO mahasiswa VALUES
                       ('','$nama','$nim','$email','$jurusan','$gambar')";
            mysqli_query($conn,$query);

            //cek sukses data ditambah menggunakan mysqli_affected_rows
            //jika kita var_dump maka akan muncuk int(1) jika gagal maka akan muncul int(-1)
            //var_dump(mysqli_affected_rows($conn));
            if (mysqli_affected_rows($conn) > 0 ) {
                echo "data berhasil disimpan";
            }
            else{
                echo"gagal";
                echo"<br>";
                echo mysqli_error($conn);
            }
        }
        ?>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post">
        <ul>
            <li>
                <!-- for pada label terhubung dengan id jadi jika label
                nama di klik maka textfield nama akan aktif juga -->
                <label for="Nama">Nama</label>
                <!-- untuk pengisian nama besarkecilnya harus sesuai dengan fieldnya -->
                <input type="text" name="Nama" id="Nama" required>
            </li>
            <li>
                <label for="Nim">Nim</label>
                <input type="text" name="Nim" id="Nim" required>
            </li>
            <li>
                <label for="Email">Email</label>
                <input type="text" name="Email" id="Email" required>
            </li>
            <li>
                <label for="Jurusan">Jurusan</label>
                <input type="text" name="Jurusan" id="Jurusan" required>
            </li>
            <li>
                <label for="Gambar">Gambar</label>
                <input type="text" name="Gambar" id="Gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>
