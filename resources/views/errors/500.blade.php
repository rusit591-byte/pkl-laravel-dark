<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Kesalahan Server</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; background: #000000; color: #f5f5f5; font-family: system-ui, sans-serif; }
        .box { max-width: 440px; padding: 32px; border: 1px solid #ef4444; border-radius: 12px; background: #09090b; text-align: center; }
        .code { font-size: 56px; font-weight: 800; color: #ef4444; margin: 0; }
        h1 { font-size: 20px; margin: 8px 0; }
        p { color: #a1a1aa; font-size: 14px; line-height: 1.5; }
        a { display: inline-block; margin-top: 16px; padding: 10px 18px; border-radius: 8px; background: #ef4444; color: #ffffff; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <div class="box">
        <p class="code">500</p>
        <h1>Terjadi Kesalahan Server</h1>
        <p>Sistem mengalami kendala internal. Silakan coba beberapa saat lagi.</p>
        <a href="{{ url('/') }}">Kembali ke Beranda</a>
    </div>
</body>
</html>