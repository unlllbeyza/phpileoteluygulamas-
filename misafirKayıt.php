<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Misafir Kayıt Paneli</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #bcd2ee;
;
        }

         .sidebar {
            width: 200px;
            background-color: #4a708b ;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
        }
        .sidebar button {
            display: block;
            width: 90%;
            margin: 10px auto;
            padding: 15px;
            background-color: #104e8b;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: left;
            cursor: pointer;
            font-size: 15px;
        }
        .sidebar button:hover {            
            background-color: #1c86ee;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        a {
        text-decoration: none;
        }
        .form-row {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
        }
        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #104e8b;
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }
        input[type="submit"]:hover {
            background-color: #1c86ee;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <a href="anaSayfa.php"><button>Anasayfa</button></a>
        <a href="rezervasyon.php"><button>Rezervasyon Sistemi</button></a>
        <a href="odaIslemleri.php"><button>Kayıtlar</button></a>
        <a href="degerlendir.php"><button>Bizi Değerlendirin</button></a>
        <a href="oda.php"><button>Oda Durumu</button></a>

    </div>

<form action="misafirKayıt.php" method="POST">
    <h2>Misafir Kayıt Formu</h2>

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

    <div class="form-row">
        <div class="form-group">
            <label>Telefon:</label>
            <input type="tel" name="telefon" title="Geçerli bir telefon numarası girin" required>
        </div>
        <div class="form-group">
            <label>TC Kimlik No:</label>
            <input type="text" name="tc" required pattern="\d{11}" maxlength="11" title="11 haneli TC kimlik numarası girin.">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>E-posta:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
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

    <div class="form-row">
        <div class="form-group">
            <label>Giriş Tarihi:</label>
            <input type="date" name="giris_tarihi" required>
        </div>
        <div class="form-group">
            <label>Çıkış Tarihi:</label>
            <input type="date" name="cikis_tarihi" required>
        </div>
    </div>

    <input type="submit" value="Kaydet" name ="save">
</form>

<?php include("database.php"); 
$baglanti = new mysqli("localhost", "root", "", "uyeler");

// Boş odaları çekiyoruz
$odalar = $baglanti->query("SELECT id, oda_no FROM odalar WHERE durum='boş'");
?>



</body>
</html>
