<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İNCİ Otel - Giriş Paneli</title>
    <style>
        body {            
            background-color: #bcd2ee;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        form {
            background-color: white;
            padding: 30px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        h2 {
            margin-bottom: 20px;
            color: #666;
        }
        input[type="text"], input[type="password"] {
            width: 250px;
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 30px;
            background-color: #104e8b;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-top: 10px;   
        }
    </style>
</head>
<body>

    <form method="POST">
        <h1>İNCİ Otel Girişi Sistemi</h1>
        <h2>kayit ol</h2>

        <input type="text" name="kullanici_adi" placeholder="Kullanıcı Adı" required><br>
        <input type="password" name="sifre" placeholder="Şifre" required><br>
        <input type="submit" value="kayit ol">
        
        <?php
$host = "localhost";
$username = "root";
$password = "";
$database = "uyeler";

$conn = mysqli_connect($host, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    $query = "INSERT INTO users (username, password) VALUES('$kullanici_adi','$sifre')";
    // $sonuc = mysqli_query($baglanti, $query);


if ($conn->query($query) === TRUE) {
    echo "<script> alert('Kayıt başarıyla eklendi.')   </script>";
} else {
    echo "Hata: " . $conn->error;
}
}

mysqli_close($conn);
?>

    </form>

</body>
</html>