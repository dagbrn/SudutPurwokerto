<?php
    require 'koneksi.php';

    if(isset($_POST["daftar"])){

        if(registrasi($_POST) > 0){
            echo "<script>
                    alert('User baru berhasil ditambahkan!');
            </script>";
        } else {
            echo mysqli_error($conn);
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <div class="register">
            <h2>Register</h2>
            <form action="" method="POST">
                <div>
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" name="namaLengkap" id="namaLengkap" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div>
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2" required>
                </div>
                <div class="">
                <button type="submit" class="" name="daftar">Daftar</button>
                </div>
            </form>
            
            <div class="">
                <p>Sudah punya akun?<a href="login.php">Login</a></p>
            </div>

        </div>

</body>
</html>