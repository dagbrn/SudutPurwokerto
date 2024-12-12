<?php

session_start();
require "koneksi.php";

if(isset($_POST['login'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * from akun where username = '$username'");

    // Cek Username
    if(mysqli_num_rows($result) === 1 ){
        
        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            
            // Simpan Session
            $_SESSION["login"] = true;
            $_SESSION["id_akun"] = $row["id_akun"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            if($row["role"] == "admin"){
                header("Location: adminpage/index.php");
                exit();

            } else {
                header("Location: index.php");
                exit();
            }
        }
    }

    $error= true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>


    <?php if(isset($error)) : ?>
        <script>
            alert('Username atau Password salah!');
        </script>
    <?php endif; ?>

    <div class="left-section"></div>
    <div class="right-section">
        <div class="login-container">
            <h1>Login</h1>
            <h2>SudutPurwokerto</h2>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukan username anda" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Masukan password anda" required>
                        <span class="password-toggle"></span>
                    </div>
                </div>

                <button type="submit" class="login-btn" name="login">Masuk</button>
            </form>

            <div class="register-link">
                <span>Belum punya akun? </span>
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.password-toggle').addEventListener('click', function() {
            const passwordInput = document.querySelector('#password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>
</html>