<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .left-section {
            flex: 1;
            background-image: url('Alun-Alun.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
        }
        .left-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        h1 {
            color: #2F4F4F;
            margin-bottom: 5px;
            font-size: 48px;
            font-weight: bold;
        }

        h2 {
            color: #2F4F4F;
            font-size: 32px;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            box-sizing: border-box;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
            height: 20px;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23666"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.6;
        }

        .eye-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 24px;
            height: 24px;
            background: none;
            border: none;
            padding: 0;
        }

        .eye-icon svg {
            width: 24px;
            height: 24px;
            stroke: #666;
            stroke-width: 1;
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background-color: #5E8C7F;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-text {
            text-align: center;
            margin-top: 20px;
        }

        .login-text a {
            color: #698B69;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="left-section"></div>
    <div class="right-section">
        <div class="form-container">
            <h1>Register</h1>
            <h2>SudutPurwokerto</h2>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" placeholder="Masukan nama anda" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Masukan email anda" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Masukan username anda" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Masukan password anda" required>
                        <span class="password-toggle"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Masukan password anda" required>
                        <span class="password-toggle"></span>
                    </div>
                </div>

                <button type="submit" class="register-btn">Daftar</button>
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
