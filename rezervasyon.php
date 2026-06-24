<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Rezervasyon Sistemi</title>
    <style>
        body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #bcd2ee;
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
        form {
        background: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        h2 {
        text-align: center;
         margin-bottom: 20px;
        }
        a {
        text-decoration: none;
        }
        .rForm {
        display: flex;
        gap: 10px;        
        margin-bottom: 45px;
        }
        .grupForm {
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
    <img src="İNCİ.png" class="logo" alt="Logo">
    <div class="header">
        <a href="anaSayfa.php"><button>Anasayfa</button></a>
        <a href="rezervasyon.php"><button>Rezervasyon Sistemi</button></a>
        <a href="odaIslemleri.php"><button>Kayıtlar</button></a>
        <a href="degerlendir.php"><button>Bizi Değerlendirin</button></a>
        <a href="oda.php"><button>Oda Durumu</button></a>


    </div>
    </div>

    <form action="rezervasyon.php" method="POST">
    <h2>Rezervasyon Formu</h2>

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
        <input type="submit" value="Kaydet" name ="save">
    </div>
    </form>

    <?php
$host = "localhost";
$username = "root";
$password ="";
$database = "kullanicilar" ;

$baglanti = mysqli_connect($host,$username,$password,$database);

if (mysqli_connect_errno() > 0) {
    die("hata :" . mysqli_connect_errno());
}

if (isset($_POST['save'])) {
    $name = $_POST['ad'];
    $surname = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $tc = $_POST['tc'];
    $oda = $_POST['oda'];
    $mail = $_POST['email'];
    $girisTarihi = $_POST['giris_tarihi'];
    $cikisTarihi = $_POST['cikis_tarihi'];
    $query = "INSERT INTO users(ad, soyad, telefon, tc, oda ,mail, girisTarih, cikisTarihi) VALUES ('$name','$surname','$telefon','$tc','$oda','$mail','$girisTarihi','$cikisTarihi')";
    $sonuc = mysqli_query($baglanti, $query);

if($sonuc) {
	echo"<script> alert(' Rezervasyonunuz basariyla Yapildi!') </script>";
    }
    else {
	echo "eklenmedi";
}
}
mysqli_close($baglanti);
?>

<script>
function guncelleForm() {
    const odaTipi = document.getElementById("odaTipi").value;
    const kisiAlani = document.getElementById("kisiAlani");
    kisiAlani.innerHTML = ""; // Temizle

    if (odaTipi !== "") {
        const kisiSayisi = parseInt(odaTipi);
        for (let i = 1; i <= kisiSayisi; i++) {
            kisiAlani.innerHTML += `
                <div class="kisi-alani">
                    <h4>${i}. Kişi Bilgileri</h4>
                    <label>Ad:</label>
                    <input type="text" name="ad${i}" required>

                    <label>Soyad:</label>
                    <input type="text" name="soyad${i}" required>

                    <label>TC Kimlik No:</label>
                    <input type="text" name="tc${i}" pattern="\\d{11}" maxlength="11" required title="11 haneli TC Kimlik No girin">

                    <label>E-posta:</label>
                    <input type="email" name="email${i}" required>
                </div>
            `;
        }
    }
}
</script>

</body>
</html>
