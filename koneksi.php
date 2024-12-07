<?php
    $conn = mysqli_connect("localhost","root","","sudutpurwokerto");

    if(mysqli_connect_errno()){
        echo "failed to connect to database: " . mysqli_connect_error();
        exit();
    }

    function query($query){
      global $conn;

      $result = mysqli_query($conn, $query);
      $rows = [];
      
      while($row = mysqli_fetch_assoc($result)){
        $rows[] = $rows;
      }

      return $rows;
    }

    function registrasi($data){
      global $conn;

      $namaLengkap = mysqli_real_escape_string($data["namaLengkap"]);
      $email = mysqli_real_escape_string($data["email"]);
      $username = strtolower($data["username"]);
      $password = mysqli_real_escape_string($conn, $data["password"]);
      $password2 = mysqli_real_escape_string($conn, $data["password2"]);

      // Cek Username Duplikat
      $result = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");
      if (mysqli_fetch_assoc($result)) {
          echo "<script>
                  alert('Username sudah terdaftar!');
                </script>";
          return false;
      }

      // Cek Passoword 1 dan 2
      if($password !== $password2){
        echo "<script>
                alert('Password Tidak sesuai!');
              </script>";

        return false;
      }

      $password = password_hash($password, PASSWORD_DEFAULT);
  
      mysqli_query($conn, "INSERT INTO akun (nama_lengkap, email, username, password, role) 
      VALUES('$namaLengkap', '$email', '$username', '$password','user')");

      return mysqli_affected_rows($conn); 

    }




?>