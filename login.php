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
    <title>Document</title>
</head>
<body>
        <div class="login">
            <h2>Login</h2>

            <?php if(isset($error)) : ?>
            <p style="color: red; font-style: italic;">Username / Password Salah!</p>
            <?php endif; ?>

            <form action="" method="POST">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div>
                <button type="submit" class="" name="login">Masuk</button>
                </div>
                <div class="">
                    <p>Belum punya Akun?<a href="register.php">Register</a></p>
                </div>
            </form>
        </div>
</body>
</html>