<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
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

        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        h1 {
            color: #2F4F4F;
            font-size: 3.8em;
            margin-bottom: 0;
            font-weight: 600;
        }

        h2 {
            color: #2F4F4F;
            font-size: 1.8em;
            margin-top: 5px;
            margin-bottom: 40px;
            font-weight: normal;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #F0F0F0;
            font-size: 1em;
            box-sizing: border-box;
        }

        input::placeholder {
            color: #999;
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

        .login-btn {
            width: 100%;
            padding: 15px;
            background-color: #5E8C7F;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            margin-top: 30px;
            font-weight: 500;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .register-link a {
            color: #668B8B;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="left-section"></div>
    <div class="right-section">
        <div class="login-container">
            <h1>Login</h1>
            <h2>SudutPurwokerto</h2>
            
            <form action="process_login.php" method="POST">
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

                <button type="submit" class="login-btn">Masuk</button>
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
