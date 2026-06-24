<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kayıtlar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #bcd2ee;
      padding-top: 100px;
      text-align: center;
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
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      background-color: #4a708b;
      padding: 10px;
      width: 100%;
      height: 80px;
      position: fixed;
      top: 0;
      left: 0;
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

    .form-container {
      max-width: 95%;
      margin: auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #aaa;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #104e8b;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #e3f1ff;
    }

    .delete-btn {
      background-color: red;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
    }

    .delete-btn:hover {
      background-color: darkred;
    }

    .edit-btn {
      background-color: green;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
    }

    .edit-btn:hover {
      background-color: darkgreen;
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

<div class="form-container">
  <h2>Kayıtlı Kullanıcılar</h2>

  <?php
  $baglanti = mysqli_connect("localhost", "root", "", "kullanicilar");

  if (!$baglanti) {
      die("Bağlantı hatası: " . mysqli_connect_error());
  }

  // Silme işlemi
  if (isset($_POST['delete'])) {
      $id = intval($_POST['delete']);
      $query2 = "DELETE FROM users WHERE id = $id";
      $sonuc2 = mysqli_query($baglanti, $query2);
      if ($sonuc2) {
          echo "<p style='color: green;'>Kayıt silindi.</p>";
      } else {
          echo "<p style='color: red;'>Silme işlemi başarısız.</p>";
      }
  }

  $query = "SELECT * FROM users";
  $sonuc = mysqli_query($baglanti, $query);

  if (mysqli_num_rows($sonuc) > 0) {
      echo "<form method='POST'><table>";
      echo "<tr>
              <th>Ad</th>
              <th>Soyad</th>
              <th>Telefon</th>
              <th>TC</th>
              <th>Mail</th>
              <th>Giriş Tarihi</th>
              <th>Çıkış Tarihi</th>
              <th>Sil</th>
              <th>Düzenle</th>
            </tr>";

      while ($row = mysqli_fetch_assoc($sonuc)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row["ad"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["soyad"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["telefon"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["tc"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["mail"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["girisTarihi"]) . "</td>";
          echo "<td>" . htmlspecialchars($row["cikisTarihi"]) . "</td>";
          echo "<td><button class='delete-btn' type='submit' name='delete' value='" . $row['id'] . "'>Sil</button></td>";
          echo "<td><a href='duzenle.php?id=" . $row['id'] . "' class='edit-btn'>Düzenle</a></td>";
          echo "</tr>";
      }

      echo "</table></form>";
  } else {
      echo "<p>Hiç kayıt bulunamadı.</p>";
  }

  mysqli_close($baglanti);
  ?>
</div>

</body>
</html>