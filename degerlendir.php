<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Bizi Değerlendirin</title>
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
    .container {
    background: white;
    max-width: 500px;
    margin: auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    h2 {
    margin-bottom: 20px;
    color: #104e8b;
    }

    .stars {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    cursor: pointer;
    }

    .star {
    font-size: 40px;
    color: #ccc;
    transition: color 0.3s;
    }

    .star.selected {
        color: gold;
    }

    textarea {
    width: 100%;
    height: 100px;
    resize: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
    margin-bottom: 20px;
    }

    button {
    background-color: #104e8b;
    color: white;
    padding: 12px 25px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    }

    button:hover {
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

    <div class="container">
        <h2>Bizi Değerlendirin</h2>
        <form action="degerlendirmeKaydet.php" method="POST">
            <div class="stars" id="yildizlar">
                <span class="star" data-deger="1">&#9733;</span>
                <span class="star" data-deger="2">&#9733;</span>
                <span class="star" data-deger="3">&#9733;</span>
                <span class="star" data-deger="4">&#9733;</span>
                <span class="star" data-deger="5">&#9733;</span>
            </div>
            <input type="hidden" name="puan" id="puan">
            <textarea name="yorum" placeholder="Yorum bırakmak isterseniz buraya yazabilirsiniz..."></textarea>
            <button type="submit">Gönder</button>
        </form>
    </div>

    <script>
        const yildizlar = document.querySelectorAll('.star');
        const puanInput = document.getElementById('puan');

        yildizlar.forEach(star => {
            star.addEventListener('click', () => {
                const deger = star.getAttribute('data-deger');
                puanInput.value = deger;

                yildizlar.forEach(s => {
                    s.classList.remove('selected');
                    if (s.getAttribute('data-deger') <= deger) {
                        s.classList.add('selected');
                    }
                });
            });
        });
    </script>
</body>
</html>
