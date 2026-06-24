<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İNCİ Otel - Ana Sayfa</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #bcd2ee, #8fb3dd);
            min-height: 100vh;
        }

        .logo {
            position: fixed;
            top: 12px;
            left: 20px;
            width: 56px;
            height: auto;
            z-index: 9999;
        }

        .header {
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
            background-color: #4a708b;
            height: 80px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.25);
            z-index: 1000;
        }

        .header button {
            margin-left: 20px;
            padding: 10px 22px;
            background-color: #104e8b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.25s ease, transform 0.15s ease, box-shadow 0.25s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .header button:hover {
            background-color: #1c86ee;
            transform: translateY(-2px);
            box-shadow: 0 5px 14px rgba(0, 0, 0, 0.25);
        }

        .header button:active {
            transform: translateY(0);
        }

        .main-content {
            padding-top: 140px;
            padding-bottom: 20px;
            text-align: center;
        }

        .main-content h1 {
            color: #2c3e50;
            font-size: 34px;
            margin-bottom: 6px;
        }

        .main-content .alt-baslik {
            color: #46566b;
            font-size: 16px;
            margin-bottom: 35px;
        }

        .galeri {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 0 20px;
        }

        .galeri img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .galeri img:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.3);
        }

        .iletisim {
            background-color: #4a708b;
            color: white;
            text-align: center;
            padding: 50px 20px;
            margin-top: 60px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
        }

        .iletisim h2 {
            margin-top: 0;
            margin-bottom: 22px;
            font-size: 24px;
        }

        .iletisim p {
            margin: 10px 0;
            font-size: 15px;
        }

        .iletisim a {
            text-decoration: none;
            color: #d6e9ff;
            transition: color 0.2s ease;
        }

        .iletisim a:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <img src="İNCİ.png" class="logo" alt="Logo">

    <div class="header">
        <a href="anaSayfa.php"><button>Anasayfa</button></a>
        <a href="rezervasyon.php"><button>Rezervasyon Sistemi</button></a>
        <a href="odaIslemleri.php"><button>Kayıtlar</button></a>
        <a href="degerlendir.php"><button>Bizi Değerlendirin</button></a>
        <a href="oda.php"><button>Oda Durumu</button></a>
    </div>

    <div class="main-content">
        <h1>Hoş Geldiniz!</h1>
        <p class="alt-baslik">İNCİ Otel'de konforlu ve huzurlu bir konaklama sizi bekliyor.</p>

        <div class="galeri">
            <img src="indir1.jpeg" alt="Otel Fotoğrafı 1">
            <img src="indir2.jpeg" alt="Otel Fotoğrafı 2">
            <img src="indir3.jpeg" alt="Otel Fotoğrafı 3">
        </div>
    </div>

    <div class="iletisim">
        <h2>İletişim</h2>
        <p><strong>Adres:</strong> Atatürk Caddesi No:123, Kadıköy, İstanbul</p>
        <p><strong>Telefon:</strong> <a href="tel:+902123456789">+90 212 345 67 89</a></p>
        <p><strong>Konum:</strong> <a href="https://www.google.com/maps" target="_blank">Google Haritalar'da Gör</a></p>
    </div>
</body>
</html>