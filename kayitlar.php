<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php


$host = "localhost";
$username = "root";
$password ="";
$database = "uyeler" ; 
$baglanti = mysqli_connect($host,$username,$password,$database);

$query = "SELECT * FROM kullanicilar";
$sonuc = mysqli_query($baglanti, $query);

if($sonuc){
	echo "kayit eklendi";
    if (isset($_POST['delete'])) {
    $id = $_POST['delete']; // tıklanan satırın id'si
 
    $query2 = "DELETE FROM kullanicilar WHERE id = $id";
    $sonuc2 = mysqli_query($baglanti, $query2);
    if ($sonuc2) {
        echo "Kayıt silindi.";
    } else {
        echo "Silinemedi.";
    }
}
    }
    else{
	echo "eklenmedi";
}

mysqli_close($baglanti);

?>
<body>
    <form method="POST">
        <ul>
           <?php while($row = mysqli_fetch_assoc($sonuc)):?>
                <li><?php echo $row["name"]. "<br>";?><button class="button" type="submit" value="<?php echo $row['id'];?>"  name ="delete"></button></li>
                <li><?php echo $row["surname"]. "<br>";?></li>
                <li><?php echo $row["telNo"]. "<br>";?></li>
                <li><?php echo $row["tc"]. "<br>";?></li>
                <li><?php echo $row["mail"]. "<br>";?></li>
                <li><?php echo $row["girisTarihi"]. "<br>";?></li>
                <li><?php echo $row["cikisTarihi"]. "<br>";?></li>
           <?php endwhile?>
        </ul>
    </form>

    <h2>Kayıtlar</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Telefon</th>
        <th>Oda No</th>
        <th>Email</th>
        <th>Giriş Tarihi</th>
        <th>Çıkış Tarihi</th>
        <th>İşlemler</th>
    </tr>

    <?php
    $baglanti = new mysqli("localhost", "root", "", "uyeler");
    $veriler = $baglanti->query("SELECT * FROM kullanicilar");

    while ($row = $veriler->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['ad']}</td>";
        echo "<td>{$row['soyad']}</td>";
        echo "<td>{$row['telefon']}</td>";
        echo "<td>{$row['oda_id']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['giris_tarihi']}</td>";
        echo "<td>{$row['cikis_tarihi']}</td>";
        echo "<td>
                <a href='guncelle.php?id={$row['id']}'>Güncelle</a> |
                <a href='sil.php?id={$row['id']}' onclick='return confirm(\"Silmek istediğine emin misin?\")'>Sil</a>
              </td>";   
        echo "</tr>";
    }
    ?>
</table>
<?php include("sil.php"); ?>
</body>
</html>