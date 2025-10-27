<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DLH Subang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html[data-theme='light'] {
            --bg-color: #f0f4f8;
            --card-color: rgba(255, 255, 255, 0.9);
            --text-color: #0B2447;
            --btn-color: #0B2447;
            --btn-hover: #031634;
        }
        html[data-theme='dark'] {
            --bg-color: #0B2447;
            --card-color: rgba(25, 55, 109, 0.85);
            --text-color: #f0f4f8;
            --btn-color: #19376D;
            --btn-hover: #031634;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: 0.3s;
        }

        .login-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 2rem;
        }

        .login-card {
            background: var(--card-color);
            padding: 2rem 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 400px;
            transition: 0.3s;
        }

        .login-card .form-control {
            border-radius: 0.6rem;
            transition: 0.3s;
        }

        .login-card .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(11, 36, 71, 0.3);
        }

        .login-card .btn-primary {
            background: var(--btn-color);
            border: none;
            border-radius: 0.6rem;
            transition: 0.3s;
        }

        .login-card .btn-primary:hover {
            background: var(--btn-hover);
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 1.3rem;
        }

        .text-center small a {
            color: var(--text-color);
            text-decoration: none;
        }
        .text-center small a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="theme-toggle" id="themeToggle"><i class="fas fa-moon"></i></div>

    <div class="container login-section">
        <div class="login-card">
            <h4 class="text-center mb-4"><i class="fas fa-sign-in-alt me-2"></i>Login</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                    </div>
                    @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- ReCAPTCHA v2 Checkbox -->
                <div class="mb-3">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    @error('g-recaptcha-response') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>

                <div class="text-center mt-3">
                    @if(Route::has('password.request'))
                        <small><a href="{{ route('password.request') }}">Lupa Password?</a></small>
                    @endif
                </div>
            </form>

            <div class="text-center mt-3">
                @if(Route::has('register'))
                    <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
                @endif
            </div>
        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        const toggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        toggle.addEventListener('click', () => {
            if(html.getAttribute('data-theme') === 'light') {
                html.setAttribute('data-theme', 'dark');
                toggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                html.setAttribute('data-theme', 'light');
                toggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });
    </script>
</body>
</html>
