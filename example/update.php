
<?php
//TODO BU ALANDA ( UPDATE ALANINDA ) ÖNCELİKLE PHP KODLARI YAZILMALIDIR DAHA SONRA HTML YAZILACAKTIR
//! veritabanı bağlantı aşamaları
// her sayfada aynıdır.
// Veritabanı bağlantı bilgileri (connect.php dosyasındakiyle aynı olmalı)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "customer";


// Veritabanına bağlan
$connect = new mysqli($servername, $username, $password, $dbname);


// Bağlantıyı kontrol et
if($connect){
    echo 'bağlantı başarılı';
}else{
    echo 'başarısız bağlantı';
}



//! Veri güncelleme alanı
// Güncellenecek verinin ID'sini al
$id = $_GET["id"];

// Veriyi güncelleme formu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yeni_ad = $_POST["yeni_ad"];
    $yeni_soyad = $_POST["yeni_soyad"];
    $yeni_email = $_POST["yeni_email"];


    // Veriyi güncelleme SQL sorgusu ( tablo adına dikkat edilmelidir. )
    $sql = "UPDATE customer_info SET ad = '$yeni_ad', soyad = '$yeni_soyad', email = '$yeni_email' WHERE id = '$id'";
   



// kullanıcıya güncellendi ise olumlu güncellenmedi ise olumsuz değer dönen alan    
    if ($connect->query($sql) === TRUE) {
        echo "Veri başarıyla güncellendi.";
        header("Location: connect.php"); // ana sayfaya yönlendirir
        exit();
    } else {
        echo "Hata: " . $sql . "<br>" . $connect->error;
    }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Güncelle</title>
</head>
<body>
    <h2>Güncelleme Ekranına Hoşgeldiniz !</h2>

    <form method="post" action="update.php?id=<?php echo $id; ?>">
        yeni ad: <input  type="text" name="yeni_ad"  >
        yeni soyad: <input  type="text" name="yeni_soyad" >
        yeni email: <input  type="text" name="yeni_email" >
        <button type="submit">Güncelle</button>
    </form>
</body>
</html>


