<?php
$baglanti = new mysqli("localhost", "root", "", "uyeler");


$baglanti->query("DELETE FROM kullanicilar WHERE id = $id");

$id = $_GET['id'];

header("Location: kayitlar.php"); 
exit;
?>
