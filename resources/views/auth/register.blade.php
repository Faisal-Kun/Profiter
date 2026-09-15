<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - ProfitKu</title>

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

        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #3b82f6;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .logo p {
            color: #8995a8;
            font-size: 14px;
        }

        .register-card {
            background: #151b24;
            border: 1px solid #273342;
            border-radius: 16px;
            padding: 30px;
        }

        .register-card h2 {
            margin-bottom: 8px;
            font-size: 22px;
        }

        .register-description {
            color: #8995a8;
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
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
            border: 1px solid #303a4a;
            border-radius: 9px;
            background: #111820;
            color: #fff;
            outline: none;
            transition: 0.2s;
        }

        input::placeholder {
            color: #64748b;
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .error {
            color: #f87171;
            font-size: 13px;
            margin-top: 6px;
        }

        .register-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 9px;
            background: #3b82f6;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: 0.2s;
        }

        .register-button:hover {
            background: #60a5fa;
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #8995a8;
        }

        .login-link a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #93c5fd;
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="logo">
        <h1>ProfitKu</h1>
    </div>

    <div class="register-card">

        <h2>Buat akun baru</h2>

        <p class="register-description">
            Daftar untuk mulai mengelola produk, produksi, dan penjualan usaha kamu.
        </p>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Pengguna</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama pengguna"
                    required
                    autofocus
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    required
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Masukkan kembali password"
                    required
                >
            </div>

            <button type="submit" class="register-button">
                Buat Akun
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk</a>
        </div>

    </div>

</div>

</body>
</html>