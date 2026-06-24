<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İNCİ Otel - Giriş Paneli</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #bcd2ee, #8fb3dd);
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
            margin: 0;
            min-height: 100vh;
        }

        form {
            background-color: white;
            padding: 40px 30px;
            display: inline-block;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.18);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        form:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
            transform: translateY(-3px);
        }

        h1 {
            margin-top: 0;
            color: #333;
        }

        h2 {
            margin-bottom: 20px;
            color: #666;
        }

        input[type="email"],
        input[type="password"] {
            width: 250px;
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        input[type="email"]:hover,
        input[type="password"]:hover {
            border-color: #8fb3dd;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #104e8b;
            box-shadow: 0 0 0 3px rgba(16, 78, 139, 0.15);
        }

        input[type="submit"] {
            padding: 10px 30px;
            background-color: #104e8b;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.25s ease, transform 0.15s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 10px rgba(16, 78, 139, 0.3);
        }

        input[type="submit"]:hover {
            background-color: #0d3e6f;
            box-shadow: 0 6px 16px rgba(16, 78, 139, 0.4);
            transform: translateY(-1px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(16, 78, 139, 0.3);
        }

        .error {
            color: #c0392b;
            margin-top: 14px;
            background-color: #fdecea;
            border: 1px solid #f5c6c0;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <form method="POST">
        <h1>İNCİ Otel Girişi Sistemi</h1>
        <h2>Şifre Doğrulama</h2>

        <input type="email" name="mail" placeholder="E-posta" required><br>
        <input type="password" name="sifre" placeholder="Şifre" required><br>
        <input type="submit" value="Giriş Yap">

        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "kullanicilar";

        $baglanti = mysqli_connect($host, $username, $password, $database);

        if (!$baglanti) {
            echo "<div class='error'>Veritabanı bağlantı hatası: " . mysqli_connect_error() . "</div>";
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

            $mail  = $_POST['mail'];
            $sifre = $_POST['sifre'];

            // SQL injection'a karşı prepared statement kullanılıyor
            $query = "SELECT * FROM kullanici WHERE mail = ? AND sifre = ?";
            $stmt = mysqli_prepare($baglanti, $query);
            mysqli_stmt_bind_param($stmt, "ss", $mail, $sifre);
            mysqli_stmt_execute($stmt);
            $sonuc = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($sonuc) > 0) {
                // Giriş başarılı, oturum başlatılıyor ve anaSayfa.php'ye yönlendiriliyor
                session_start();
                $kullanici = mysqli_fetch_assoc($sonuc);
                $_SESSION['kullanici_id'] = $kullanici['id'];
                $_SESSION['mail'] = $kullanici['mail'];

                header("Location: anaSayfa.php");
                exit();
            } else {
                echo "<div class='error'>E-posta veya şifre hatalı!</div>";
            }

            mysqli_stmt_close($stmt);
        }

        if ($baglanti) {
            mysqli_close($baglanti);
        }
        ?>

    </form>

</body>
</html>