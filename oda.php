<?php
// Veritabanına bağlan
//$conn = new mysqli("localhost", "root", "", "otel");

// Hata kontrolü
//if ($conn->connect_error) {
    //die("Bağlantı hatası: " . $conn->connect_error);
//}

// Odaları çek
//$result = $conn->query("SELECT * FROM rooms");

// Oda sayıları
//$totalRooms = 0;
//$occupied = 0;
//$upcoming = 0;

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Oda Durumu</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #bcd2ee;
    margin: 0;
    padding-top: 120px;
    text-align: center;
    }
    .logo{
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
        .room {
            display: inline-block;
            width: 80px;
            height: 80px;
            margin: 10px;
            border-radius: 10px;
            color: white;
            text-align: center;
            line-height: 80px;
            font-weight: bold;
        }
        .empty { background-color: #4CAF50; }     /* Yeşil */
        .occupied { background-color: #F44336; }  /* Kırmızı */
        .upcoming { background-color: #FFC107; }  /* Sarı */
        .status-container {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <h2>Oda Durumu</h2>

    <img src="İNCİ.png" class="logo" alt="Logo">

    <div class="header">
        <a href="anaSayfa.php"><button>Anasayfa</button></a>
        <a href="rezervasyon.php"><button>Rezervasyon Sistemi</button></a>
        <a href="odaIslemleri.php"><button>Kayıtlar</button></a>
        <a href="degerlendir.php"><button>Bizi Değerlendirin</button></a>
        <a href="oda.php"><button>Oda Durumu</button></a>

    </div>

    <?php
        $conn = new mysqli("localhost", "root", "", "uyeler");

        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // 2. Verileri çek
        $sql = "SELECT * FROM odalar";
        $result = $conn->query($sql);

        // 3. Verileri durumlarına göre yazdır
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $odaAdi = $row['oda_no'];
                $durum = $row['durum'];

                // Duruma göre çıktı
                if ($durum == 1) {
                    echo "<p>$odaAdi: <span style='color:red;'>Dolu</span></p>";
                } else {
                    echo "<p>$odaAdi: <span style='color:green;'>Boş</span></p>";
                }
            }
        } else {
            echo "Hiç oda bulunamadı.";
        }

        $conn->close();
    ?>

    <!-- <div class="status-container">
        <p><strong>Toplam Oda:</strong> <?= $totalRooms ?></p>
        <p><strong>Dolu Oda:</strong> <?= $occupied ?></p>
        <p><strong>Yaklaşan Rezervasyon:</strong> <?= $upcoming ?></p>
        <p><strong>Doluluk Oranı:</strong> %<?= round($dolulukOrani, 1) ?></p>
    </div> -->

</body>
</html>
