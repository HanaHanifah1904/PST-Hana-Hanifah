<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Pengaduan</title>
    <style>
        /* Reset */
        * {
            box-sizing: border-box;
            margin: 0; padding: 0;
            font-family: 'Poppins', Arial, sans-serif;
        }

        /* Dark mode support */
        :root {
            --color-bg-light: #f0f4f8;
            --color-bg-dark: #121212;
            --color-glass-light: rgba(255, 255, 255, 0.15);
            --color-glass-dark: rgba(0, 0, 0, 0.35);
            --color-primary: #4ade80; /* green-400 */
            --color-primary-dark: #22c55e; /* green-500 */
            --color-error: #ef4444; /* red-500 */
            --color-text-light: #111827;
            --color-text-dark: #e0e0e0;
            --color-glow: #4ade80;
        }

        body {
            position: relative;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
            color: var(--color-text-light);
            background: url('{{ asset('assets/img/hh.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            transition: color 0.3s ease;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: transparent;
            pointer-events: none;
            transition: background-color 0.3s ease;
            z-index: 0;
        }

        body.dark {
            color: var(--color-text-dark);
        }

        body.dark::before {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(2px);
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 600px;
            background: var(--color-glass-light);
            backdrop-filter: blur(18px) saturate(150%);
            -webkit-backdrop-filter: blur(18px) saturate(150%);
            border-radius: 20px;
            box-shadow:
                0 0 12px 2px rgba(74, 222, 128, 0.5),
                0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 40px 40px 50px;
            color: inherit;
            overflow: hidden;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        body.dark .container {
            background: var(--color-glass-dark);
            box-shadow:
                0 0 20px 3px rgba(34, 197, 94, 0.6),
                0 8px 40px rgba(0, 0, 0, 0.7);
        }

        /* Tombol toggle dalam container, kanan atas */
        .dark-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.8rem;
            color: var(--color-primary);
            filter: drop-shadow(0 0 2px var(--color-glow));
            transition: transform 0.3s ease;
            z-index: 5;
        }

        .dark-toggle:hover {
            transform: rotate(20deg);
        }

        h2 {
            font-size: 2.25rem;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-shadow: 0 0 8px var(--color-glow);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        label {
            font-weight: 600;
            font-size: 1rem;
            color: inherit;
            text-shadow: 0 0 3px rgba(0,0,0,0.15);
        }

        input, select, textarea {
            font-size: 1rem;
            padding: 14px 18px;
            border-radius: 12px;
            border: 2px solid transparent;
            outline-offset: 2px;
            background: rgba(255,255,255,0.85);
            box-shadow: inset 0 0 8px rgba(0,0,0,0.07);
            transition:
                border-color 0.3s ease,
                box-shadow 0.3s ease,
                background-color 0.3s ease,
                color 0.3s ease;
            color: var(--color-text-light);
            font-family: 'Poppins', Arial, sans-serif;
            resize: vertical;
        }

        body.dark input,
        body.dark select,
        body.dark textarea {
            background: rgba(34, 34, 34, 0.85);
            color: var(--color-text-dark);
            box-shadow: inset 0 0 10px rgba(0,0,0,0.9);
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 12px var(--color-glow);
            background-color: #fff;
            color: #000;
        }

        body.dark input:focus,
        body.dark select:focus,
        body.dark textarea:focus {
            background-color: #1e1e1e;
            color: var(--color-primary);
        }

        textarea {
            min-height: 120px;
        }

        /* Khusus textarea alamat, buat tinggi lebih kecil */
        textarea#alamat {
            min-height: 60px;  /* pendek supaya ga terlalu panjang */
            max-height: 80px;  /* batasi maksimal tinggi */
            resize: vertical;
        }

        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .btn-submit, .btn-back {
            flex: 1;
            padding: 14px 0;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 12px;
            cursor: pointer;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            user-select: none;
            box-shadow: 0 0 15px transparent;
            transition:
                background-color 0.35s ease,
                box-shadow 0.35s ease,
                transform 0.2s ease;
        }

        .btn-submit {
            background: linear-gradient(135deg, #22c55e 0%, #4ade80 100%);
            box-shadow: 0 0 15px #4ade80;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            box-shadow: 0 0 24px #22c55e;
            transform: scale(1.05);
        }
        .btn-submit:active {
            transform: scale(0.97);
        }

        .btn-back {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            box-shadow: 0 0 15px #fb923c;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);
            box-shadow: 0 0 24px #f97316;
            transform: scale(1.05);
        }
        .btn-back:active {
            transform: scale(0.97);
        }

        .alert {
            padding: 16px 24px;
            border-radius: 16px;
            font-weight: 600;
            box-shadow: 0 0 15px transparent;
            transition: box-shadow 0.3s ease;
            margin-bottom: 25px;
            font-size: 1rem;
            line-height: 1.3;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            box-shadow: 0 0 15px #22c55e;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            box-shadow: 0 0 15px #ef4444;
        }
        .alert ul {
            padding-left: 20px;
            margin-top: 6px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 25px 40px;
            }
            .button-container {
                flex-direction: column;
            }
            .btn-submit, .btn-back {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="dark-toggle" aria-label="Toggle Dark Mode" title="Toggle Dark Mode">🌙</button>
        <h2>Form Pengaduan</h2>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error validasi -->
        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <label for="Nama">Nama Lengkap</label>
        <input type="text" id="Nama" name="Nama" value="{{ old('Nama') }}" />
        @error('Nama')
            <small style="color:red;">{{ $message }}</small>
        @enderror

        <label for="Alamat">Alamat</label>
        <textarea id="Alamat" name="Alamat">{{ old('Alamat') }}</textarea>
        @error('Alamat')
            <small style="color:red;">{{ $message }}</small>
        @enderror

        <label for="No_HP">Nomor HP</label>
        <input type="tel" id="No_HP" name="No_HP" value="{{ old('No_HP') }}" />
        @error('No_HP')
            <small style="color:red;">{{ $message }}</small>
        @enderror

        <label for="Tanggal">Tanggal</label>
        <input type="date" id="Tanggal" name="Tanggal" value="{{ old('Tanggal') }}" />
        @error('Tanggal')
            <small style="color:red;">{{ $message }}</small>
        @enderror

        <label for="Pengaduan">Pengaduan</label>
        <textarea id="Pengaduan" name="Pengaduan">{{ old('Pengaduan') }}</textarea>
        @error('Pengaduan')
            <small style="color:red;">{{ $message }}</small>
        @enderror

        <label for="Foto_Pengaduan">Foto Pendukung</label>
        <input type="file" id="Foto_Pengaduan" name="Foto_Pengaduan" accept="image/*" />
        @error('Foto_Pengaduan')
            <small style="color:red;">{{ $message }}</small>
        @enderror

    <div class="button-container">
        <button type="submit" class="btn-submit">Kirim Pengaduan</button>
        <a href="{{ url()->previous() }}" class="btn-back" role="button">Kembali</a>
    </div>
</form>

    </div>

    <script>
        // Dark mode toggle logic
        const btnToggle = document.querySelector('.dark-toggle');
        const body = document.body;

        // Load mode from localStorage if exists
        if(localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark');
            btnToggle.textContent = '☀️';
        }

        btnToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            if(body.classList.contains('dark')){
                btnToggle.textContent = '☀️';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                btnToggle.textContent = '🌙';
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    </script>
</body>
</html>
