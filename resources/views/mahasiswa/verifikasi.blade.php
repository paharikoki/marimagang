<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #DC143C;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        a.button {
            color: #fff;
            text-decoration: none;
            background-color: #DC143C;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>EMAIL INFORMASI</h2>
        </div>
        <div class="content">
            <p>Verifikasi Email Anda Dengan Klik Button Dibawah :</p>
            <a href="{{ url('/verification/' . $user->id) }}" class="button">Verifikasi Akun</a>
        </div>
        <div class="footer">
            <p>This is an automated email. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>