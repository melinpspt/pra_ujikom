<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }

        /* HEADER */
        .header_melinda {
            background-color: #2c3e50;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .header_melinda h1 {
            margin: 0;
            font-size: 20px;
        }

        .login_button_melinda a {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
        }

        .login_button_melinda a:hover {
            background-color: #2980b9;
        }

        /* CONTENT */
        .content_melinda {
            text-align: center;
            padding: 100px 20px;
        }

        .content_melinda h2 {
            font-size: 28px;
            color: #333;
        }

        .content_melinda p {
            font-size: 16px;
            color: #666;
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header_melinda">
        <h1>Perpustakaan Digital</h1>
        <div class="login_button_melinda">
            <a href="auth_melinda/login_melinda.php">Login</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content_melinda">
        <h2>Selamat Datang di Perpustakaan Digital Sekolah</h2>
        <p>
            Aplikasi ini digunakan untuk memudahkan siswa dan admin
            dalam melakukan peminjaman dan pengelolaan buku secara digital
            berbasis web.
        </p>
    </div>

</body>
</html>
