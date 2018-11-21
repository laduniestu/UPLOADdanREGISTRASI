<?php
    //membuat koneksi

    $conn=mysqli_connect("localhost","root","","phpdatabase");

    //ambil data dari tabel mahasiswa/query data mahasiswa
    $result=mysqli_query($conn,"SELECT * FROM mahasiswa");

    //function query akan menerima isi parameter dari string query yang ada pada index2.php (line 3)
    function query($query_kedua)
    {
        global $conn;
        $result = mysqli_query($conn, $query_kedua);
        //wadah kodong untuk menampung isi array pada saat looping line 16
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $rows[]=$row;
        }
        return $rows;
    }

    function tambah ($data)
    {
        global $conn;

        $nama = htmlspecialchars($data["Nama"]);
        $nim = htmlspecialchars($data["Nim"]);
        $email = htmlspecialchars($data["Email"]);
        $jurusan = htmlspecialchars($data["Jurusan"]);
        // $gambar = htmlspecialchars($data["Gambar"]);

        $gambar = upload();
        if(!$gambar){
            return false;
        }

        // query insert data
        $query = " INSERT INTO mahasiswa VALUES
                   ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }

    function hapus ($id)
    {
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiswa WHERE id=$id ");
        return mysqli_affected_rows($conn);
    }

    function edit ($data){
        global $conn;

        $id=$data["id"];
        $nama=htmlspecialchars($data["Nama"]);
        $nim=htmlspecialchars($data["Nim"]);
        $email=htmlspecialchars($data["Email"]);
        $jurusan=htmlspecialchars($data["Jurusan"]);
        $GambarLama=htmlspecialchars($data["GambarLama"]);

        if($_FILES['Gambar'][error]===4)
        {
            $gambar=$GambarLama;
        }else {
            $gambar=upload();
        }

        $query=" UPDATE mahasiswa SET
                    Nama = '$nama',
                    Nim = '$nim',
                    Email = '$email',
                    Jurusan = '$jurusan',
                    Gambar = '$gambar'
                    WHERE id = '$id'";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function cari($keyword){
        $sql="SELECT * FROM mahasiswa
                WHERE
                Nama LIKE '%$keyword%' OR
                Nim  LIKE '%$keyword%' OR
                Email  LIKE '%$keyword%' OR
                Jurusan  LIKE '%$keyword%'
                ";
            return query($sql);
    }

    function upload() {
        $nama_file   = $_FILES['Gambar']['name'];
        $ukuran_file = $_FILES['Gambar']['size'];
        $error       = $_FILES['Gambar']['error'];
        $tmpfile     = $_FILES['Gambar']['tmp_name'];

        if($error===4){
            //pastikan pada inputan gambar tidak terdapat atribut required

            echo "
                <script>
                    alert('Tidak ada gambar diupload');
                </script>
            ";
            return false;
        }

        $jenis_gambar = ['jpg', 'jpeg', 'gif'];
        $pecah_gambar = explode('.', $nama_file);
        $pecah_gambar = strtolower(end($pecah_gambar));
        if(!in_array($pecah_gambar, $jenis_gambar)){
            echo "
                <script>
                    alert('Yang anda upload bukan file gambar');
                </script>
            ";
            return false;
        }


        //cek kapasitass gambar dalam byte, kalau 1000000 byte = 1mb

        if($ukuran_file > 1000000){
            echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>
            ";
            return false;
        }

        //generate id untuk penamaan gambar dengan function uniqid()

        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $pecah_gambar; 

        move_uploaded_file($tmpfile, 'image/'. $namafilebaru);

        //kita return nama filenya agar dapat masuk ke $Gambar=$upload() pada function tambah
        return $namafilebaru;

    }


    function registrasi($data){

        global $conn;

        //stripclashes digunakan untuk enghilangkan blackslashes
        $username = strtolower(stripcslashes($data['username']));
        $password = mysqli_real_escape_string($conn, $data['password']);
        $password2 = mysqli_real_escape_string($conn, $data['password2']);

        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

        //cek kondisi jika line 175 nilai true maka cetak echo
        if(mysqli_fetch_assoc($result)){
            echo "
                <script>
                    alert('Username sudah ada');
                </script>
            ";
            return false;
        }
        
        //cek konfirmasi pasword
        if($password !== $password2){
            echo "
                <script>
                    alert('Password anda tidak sama');
                </script>
            ";
            return false;
        }

        $password = md5($password);
        // $password = password_hash($password, PASSWORD_DEFAULT);
        var_dump($password);

        mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }

?>
