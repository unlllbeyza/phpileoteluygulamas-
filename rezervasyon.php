<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "kullanicilar";

$baglanti = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno() > 0) {
    die("hata :" . mysqli_connect_errno());
}

$mesaj = "";
$mesajTip = ""; // "hata" veya "basari"

if (isset($_POST['save'])) {
    $name = $_POST['ad'];
    $surname = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $tc = $_POST['tc'];
    $oda = $_POST['oda'];
    $mail = $_POST['email'];
    $girisTarihi = $_POST['giris_tarihi'];
    $cikisTarihi = $_POST['cikis_tarihi'];

    if ($cikisTarihi <= $girisTarihi) {
        $mesaj = "Çıkış tarihi, giriş tarihinden sonra olmalıdır!";
        $mesajTip = "hata";
    } else {
        // Aynı odada tarih çakışması var mı kontrol et
        // Çakışma şartı: mevcut.girisTarih < yeni.cikisTarihi VE mevcut.cikisTarihi > yeni.girisTarih
        $kontrolQuery = "SELECT COUNT(*) AS adet FROM users WHERE oda = ? AND girisTarih < ? AND cikisTarihi > ?";
        $kontrolStmt = mysqli_prepare($baglanti, $kontrolQuery);
        mysqli_stmt_bind_param($kontrolStmt, "sss", $oda, $cikisTarihi, $girisTarihi);
        mysqli_stmt_execute($kontrolStmt);
        $kontrolSonuc = mysqli_stmt_get_result($kontrolStmt);
        $satir = mysqli_fetch_assoc($kontrolSonuc);
        mysqli_stmt_close($kontrolStmt);

        if ($satir['adet'] > 0) {
            $mesaj = "$girisTarihi - $cikisTarihi tarihleri arasında $oda numaralı oda müsait değildir!";
            $mesajTip = "hata";
        } else {
            $query = "INSERT INTO users(ad, soyad, telefon, tc, oda, mail, girisTarih, cikisTarihi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($baglanti, $query);
            mysqli_stmt_bind_param($stmt, "ssssssss", $name, $surname, $telefon, $tc, $oda, $mail, $girisTarihi, $cikisTarihi);
            $sonuc = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($sonuc) {
                $mesaj = "Rezervasyonunuz başarıyla yapıldı!";
                $mesajTip = "basari";
            } else {
                $mesaj = "Rezervasyon eklenirken bir hata oluştu.";
                $mesajTip = "hata";
            }
        }
    }
}

mysqli_close($baglanti);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Rezervasyon Sistemi</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #bcd2ee, #8fb3dd);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 110px;
            padding-bottom: 60px;
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

        .form-wrapper {
            flex: 1;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            background: white;
            padding: 40px;
            border-radius: 18px;
            max-width: 640px;
            width: 90%;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        form:hover {
            box-shadow: 0 14px 45px rgba(0, 0, 0, 0.28);
            transform: translateY(-2px);
        }

        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 26px;
        }

        a {
            text-decoration: none;
        }

        .mesaj {
            text-align: center;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 22px;
            font-size: 14px;
            font-weight: bold;
        }

        .mesaj.hata {
            color: #c0392b;
            background-color: #fdecea;
            border: 1px solid #f5c6c0;
        }

        .mesaj.basari {
            color: #1e7e34;
            background-color: #e8f7ed;
            border: 1px solid #bfe6cc;
        }

        .rForm {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .grupForm {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 6px;
            color: #444;
            font-weight: bold;
        }

        input, select {
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
            outline: none;
        }

        input:hover, select:hover {
            border-color: #8fb3dd;
        }

        input:focus, select:focus {
            border-color: #104e8b;
            box-shadow: 0 0 0 3px rgba(16, 78, 139, 0.15);
        }

        input[type="submit"] {
            background-color: #104e8b;
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            padding: 13px;
            font-size: 15px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(16, 78, 139, 0.3);
            transition: background-color 0.25s ease, transform 0.15s ease, box-shadow 0.25s ease;
        }

        input[type="submit"]:hover {
            background-color: #1c86ee;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 78, 139, 0.4);
        }

        input[type="submit"]:active {
            transform: translateY(0);
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

    <div class="form-wrapper">
        <form action="rezervasyon.php" method="POST">
            <h2>Rezervasyon Formu</h2>

            <?php if ($mesaj !== "") { ?>
                <div class="mesaj <?= $mesajTip ?>"><?= htmlspecialchars($mesaj) ?></div>
            <?php } ?>

            <div class="rForm">
                <div class="grupForm">
                    <label>Giriş Tarihi:</label>
                    <input type="date" name="giris_tarihi" required>
                </div>
                <div class="grupForm">
                    <label>Çıkış Tarihi:</label>
                    <input type="date" name="cikis_tarihi" required>
                </div>
            </div>

            <div class="rForm">
                <div class="grupForm">
                    <label>Ad:</label>
                    <input type="text" name="ad" required>
                </div>
                <div class="grupForm">
                    <label>Soyad:</label>
                    <input type="text" name="soyad" required>
                </div>
            </div>

            <div class="rForm">
                <div class="grupForm">
                    <label>Telefon:</label>
                    <input type="tel" name="telefon" title="Geçerli bir telefon numarası girin" required>
                </div>
                <div class="grupForm">
                    <label>TC Kimlik No:</label>
                    <input type="text" name="tc" required pattern="\d{11}" maxlength="11" title="11 haneli TC kimlik numarası girin.">
                </div>
            </div>

            <div class="rForm">
                <div class="grupForm">
                    <label>E-posta:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="grupForm">
                    <label>Oda Seçimi:</label>
                    <select name="oda" required>
                        <option value="">-- Oda Seçin --</option>
                        <option>101</option>
                        <option>102</option>
                        <option>103</option>
                        <option>104</option>
                        <option>105</option>
                        <option>106</option>
                        <option>107</option>
                        <option>108</option>
                        <option>109</option>
                        <option>110</option>
                    </select>
                </div>
            </div>

            <input type="submit" value="Kaydet" name="save">
        </form>
    </div>

</body>
</html>