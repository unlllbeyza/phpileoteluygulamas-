<?php
$host = "localhost";
$username = "root";
$password ="";
$database = "uyeler" ;

$baglanti = mysqli_connect($host,$username,$password,$database);

if (mysqli_connect_errno() > 0) {
    die("hata :" . mysqli_connect_errno());
} else {
     echo "baglanti var";  // bunu kullanma
}

if (isset($_POST['save'])) {
    $name = $_POST['ad'];
    $surname = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $tc = $_POST['tc'];
    $mail = $_POST['email'];
    $girisTarihi = $_POST['giris_tarihi'];
    $cikisTarihi = $_POST['cikis_tarihi'];
    $query = "INSERT INTO kullanicilar(name, surname, telNo, tc, mail, girisTarihi, cikisTarihi) VALUES ('$name','$surname','$telefon','$tc','$mail','$girisTarihi','$cikisTarihi')";
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