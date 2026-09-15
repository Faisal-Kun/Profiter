<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - ProfitKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #111318;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #22d3ee;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .logo p {
            color: #9ca3af;
            font-size: 14px;
        }

        .login-card {
            background: #17191f;
            border: 1px solid #262a33;
            border-radius: 14px;
            padding: 30px;
        }

        .login-card h2 {
            margin-bottom: 24px;
            font-size: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #d1d5db;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #30343d;
            border-radius: 8px;
            background: #11141b;
            color: #fff;
            outline: none;
        }

        input:focus {
            border-color: #22d3ee;
        }

        .error {
            color: #f87171;
            font-size: 13px;
            margin-top: 6px;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #22d3ee;
            color: #111318;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .login-button:hover {
            opacity: 0.9;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #9ca3af;
        }

        .register-link a {
            color: #22d3ee;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">
        <h1>ProfitKu</h1>
        <p>Smart UMKM Management</p>
    </div>

    <div class="login-card">

        <h2>Login</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-button">
                Login
            </button>

        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </div>

    </div>

</div>

</body>
</html>
