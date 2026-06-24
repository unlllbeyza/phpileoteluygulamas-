<?php
$conn = new mysqli("localhost", "root", "", "kullanicilar");

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Otelde sabit oda numaraları (rezervasyon formundaki listeyle aynı)
$tumOdalar = ["101", "102", "103", "104", "105", "106", "107", "108", "109", "110"];

$bugun = date("Y-m-d");

// users tablosundaki giriş/çıkış tarihlerine göre her odanın durumunu hesapla
$odaDurumlari = [];
foreach ($tumOdalar as $odaNo) {
    $odaDurumlari[$odaNo] = 0; // varsayılan: boş
}

$sql = "SELECT oda, girisTarih, cikisTarihi FROM users";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $odaNo = $row['oda'];
        $giris = $row['girisTarih'];
        $cikis = $row['cikisTarihi'];

        if (!array_key_exists($odaNo, $odaDurumlari)) {
            continue;
        }

        if ($bugun >= $giris && $bugun <= $cikis) {
            // Şu anda konaklama devam ediyor
            $odaDurumlari[$odaNo] = 1; // dolu
        } elseif ($giris > $bugun && $odaDurumlari[$odaNo] != 1) {
            // İleri tarihli rezervasyon var, ama oda şu an dolu değilse
            $odaDurumlari[$odaNo] = 2; // yaklaşan
        }
    }
}

$conn->close();

// Görüntüleme için diziye çevir
$odalar = [];
foreach ($odaDurumlari as $odaNo => $durum) {
    $odalar[] = ["oda_no" => $odaNo, "durum" => $durum];
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Oda Durumu</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #bcd2ee, #8fb3dd);
            min-height: 100vh;
            text-align: center;
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

        .main-content {
            padding-top: 140px;
            padding-bottom: 40px;
        }

        h2 {
            color: #2c3e50;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .alt-baslik {
            color: #46566b;
            font-size: 15px;
            margin-bottom: 30px;
        }

        /* Lejant */
        .lejant {
            display: flex;
            justify-content: center;
            gap: 28px;
            margin-bottom: 35px;
            flex-wrap: wrap;
        }

        .lejant-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #2c3e50;
            font-weight: bold;
        }

        .nokta {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
        }

        /* Oda kutuları */
        .oda-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 18px;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .room {
            width: 100px;
            height: 100px;
            border-radius: 14px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: default;
        }

        .room:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
        }

        .empty { background-color: #43a047; }      /* Boş - Yeşil */
        .occupied { background-color: #e53935; }    /* Dolu - Kırmızı */
        .upcoming { background-color: #fbc02d; }     /* Yaklaşan Rezervasyon - Sarı */

        .bos-mesaj {
            font-size: 16px;
            color: #2c3e50;
            margin-top: 30px;
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
        <h2>Oda Durumu</h2>
        <p class="alt-baslik">Otelinizdeki tüm odaların anlık durumunu buradan takip edebilirsiniz.</p>

        <div class="lejant">
            <div class="lejant-item"><span class="nokta" style="background-color:#43a047;"></span> Boş</div>
            <div class="lejant-item"><span class="nokta" style="background-color:#e53935;"></span> Dolu</div>
            <div class="lejant-item"><span class="nokta" style="background-color:#fbc02d;"></span> Yaklaşan Rezervasyon</div>
        </div>

        <?php if (count($odalar) > 0) { ?>
            <div class="oda-grid">
                <?php foreach ($odalar as $row) {
                    $odaNo = htmlspecialchars($row['oda_no']);
                    $durum = $row['durum'];

                    if ($durum == 1) {
                        $sinif = "occupied";
                    } elseif ($durum == 2) {
                        $sinif = "upcoming";
                    } else {
                        $sinif = "empty";
                    }
                    ?>
                    <div class="room <?= $sinif ?>"><?= $odaNo ?></div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="bos-mesaj">Hiç oda bulunamadı.</p>
        <?php } ?>
    </div>

</body>
</html>