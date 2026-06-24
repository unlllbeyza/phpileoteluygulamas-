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
            background-color: #bcd2ee;
        }
        .logo {
            position: fixed;
            top: 0;
            left: 0;
            width: 80px;
            height: auto;
            z-index: 9999;
        }
        .header {
    flex-wrap: wrap;
    justify-content: center; /* Ortalar */
    background-color: #004080;
    padding: 10px;
    width: 100%;
    background-color: #4a708b;
    height: 80px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    z-index: 1000;
    }
        .header button {
            margin-left: 40px;
            padding: 10px 20px;
            background-color: #104e8b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }
        .header button:hover {
            background-color: #1c86ee;
        }
        .main-content {
            padding-top: 120px; /* header’dan sonra boşluk bırak */
            text-align: center;
        }
        .main-content img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            margin: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .iletisim {
            background-color: #4a708b;
            color: white;
            text-align: center;
            padding: 40px 20px;
            margin-top: 130px;
        }
        h1 {
            color: #2c3e50;
        }
        a {
            text-decoration: none;
            color: white;
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

        <!-- Fotoğraflar -->
        <img src="indir1.jpeg" alt="Otel Fotoğrafı 1">
        <img src="indir2.jpeg" alt="Otel Fotoğrafı 2">
        <img src="indir3.jpeg" alt="Otel Fotoğrafı 3">
    </div>

    
    <div class="iletisim">
        <h2>İletişim</h2>
        <p><strong>Adres:</strong> Atatürk Caddesi No:123, Kadıköy, İstanbul</p>
        <p><strong>Telefon:</strong> <a href="tel:+902123456789">+90 212 345 67 89</a></p>
        <p><strong>Konum:</strong> <a href="https://www.google.com/maps" target="_blank">Google Haritalar'da Gör</a></p>
    </div>
</body>
</html>
