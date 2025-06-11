<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password BookStudy</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: maroon;">Reset Password BookStudy</h2>

    <p>
        Halo {{ isset($isAdmin) && $isAdmin ? 'Admin' : ($user->nama ?? 'Pengguna') }},
    </p>

    <p>Kami menerima permintaan reset password untuk akun Anda.</p>

    <p>
        <a href="{{ $url }}" 
           style="background-color: maroon; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
           Reset Password
        </a>
    </p>

    <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>

    <p>Terima kasih,<br>
    <strong>Bookstudy</strong> Team</p>
</body>
</html>