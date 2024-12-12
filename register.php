<?php
    require 'koneksi.php';

    if(isset($_POST["daftar"])){

        if(registrasi($_POST) > 0){
            echo "<script>
                    alert('User baru berhasil ditambahkan!');
            </script>";
            header('Location: login.php');
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
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="left-section"></div>
    <div class="right-section">
    <div class="form-container">
            <h1>Register</h1>
            <h2>SudutPurwokerto</h2>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_lengkap">Nama</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan nama anda" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukan email anda" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukan username anda" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" name="password" id="password" placeholder="Masukan password anda" required>
                        <span class="password-toggle eye-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="3" stroke="currentColor" />
                                <path d="M12 5C7 5 2.73 8.11 1 12.5C2.73 16.89 7 20 12 20C17 20 21.27 16.89 23 12.5C21.27 8.11 17 5 12 5Z" stroke="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password2">Password</label>
                    <div class="password-field">
                        <input type="password" name="password2" id="password2" placeholder="Masukan password anda" required>
                        <span class="password-toggle eye-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="3" stroke="currentColor" />
                                <path d="M12 5C7 5 2.73 8.11 1 12.5C2.73 16.89 7 20 12 20C17 20 21.27 16.89 23 12.5C21.27 8.11 17 5 12 5Z" stroke="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>

                <button type="submit" class="register-btn" name="daftar">Daftar</button>
            </form>

            <p class="login-text">Sudah punya akun? <a href="login.php">Login</a></p>

        </div> 
    </div>

    <script>
        const togglePassword = (button, inputId) => {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Ganti icon sesuai status password
            if (type === 'text') {
                button.innerHTML = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5C7 5 2.73 8.11 1 12.5C2.73 16.89 7 20 12 20C17 20 21.27 16.89 23 12.5C21.27 8.11 17 5 12 5Z" stroke="currentColor"/>
                    <line x1="4" y1="4" x2="20" y2="20" stroke="currentColor"/>
                </svg>`;
            } else {
                button.innerHTML = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                    <path d="M12 5C7 5 2.73 8.11 1 12.5C2.73 16.89 7 20 12 20C17 20 21.27 16.89 23 12.5C21.27 8.11 17 5 12 5Z" stroke="currentColor"/>
                </svg>`;
            }
        };

        // Event listeners untuk kedua tombol mata
        document.querySelectorAll('.eye-icon').forEach(button => {
            button.addEventListener('click', function() {
                const inputId = this.previousElementSibling.id;
                togglePassword(this, inputId);
            });
        });
    </script>

</body>
</html>