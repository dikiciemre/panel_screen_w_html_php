<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--
         form yapısı oluşturdum.
         name değerlerini girmek önemli ( veriyi veritabanına kaydederken o ismi kullanacağız. )
    -->
    <h2>DİKİCİ LTD. ŞTİ'YE HOŞGELDİNİZ !!</h2>

    <form action="connect.php" method="post" class="form">
        ad: <input type="text" name="ad" placeholder="Adınızı giriniz..">
        soyad: <input type="text" name="soyad" placeholder="Soyadınızı giriniz..">
        email: <input type="email" name="email" placeholder="E-mail adresinizi giriniz..">
        <button type="submit">Kaydet</button>
    </form>
</body>
</html>



<?php
//! php kod başlangıcı

// servername database name gibi değerleri değişkenlere atamak okunabilirlik sağlar
// kendi veritabanınızda database name değerini doğru girmek önemlidir.
$servername = "localhost";
$dbname = "customer";
$username = "root";
$password = "root";


//! database bağlantısı yapma aşaması
$connect = mysqli_connect($servername, $username, $password, $dbname);
// kontrol açısından bağlantı oldu mu olmadı mı emin olmak için if else döngüsü yazdım.
if($connect){
    echo 'bağlantı başarılı'."<br>";
}else{
    echo 'bağlantı başarısız'."<br>";
}


//! Veritabanına kayıt ekleme alanı
if ($_SERVER["REQUEST_METHOD"] == "POST") { // bu kod önemli yoksa veriler gereksiz bir döngüye giriyor
       $ad = $_POST["ad"];
       $soyad = $_POST["soyad"];
       $email = $_POST["email"];

       $sql = "INSERT INTO customer_info (ad, soyad, email) VALUES ('$ad', '$soyad', '$email')";

       if ($connect->query($sql) === TRUE) {
           echo "Veritabanına kayıt başarıyla eklendi."."<br>";
       } else {
           echo "Hata: " . $sql . "<br>" . $connect->error;
       }
    }

   
//! veri listele
// bu aşamada SQL sorgumuzu yazıyoruz ( tablo adını doğru girdiğimizden emin olalım. )
       $sql = "SELECT id, ad,soyad,email FROM customer_info";
       $result = $connect->query($sql);
 
// verileri basit bir table yapısı içinde listemek için       
       if ($result->num_rows > 0) {
        echo "<h3>CUSTOMERS:</h3>";
        echo "<table>";
        echo "<tr><th>Customers</th><th>İşlemler</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row["id"]}</td>";
            echo "<td>{$row["ad"]}</td>";
            echo "<td>{$row["soyad"]}</td>";
            echo "<td>{$row["email"]}</td>";
            echo "<td><a href='delete.php?id={$row["id"]}'>Sil</a> | <a href='update.php?id={$row["id"]}'>Güncelle</a></td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Veri bulunamadı.";
    }

//! Bağlantıyı kapat
           $connect->close();
?>








