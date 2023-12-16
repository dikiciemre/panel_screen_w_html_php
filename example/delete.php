<?php
//! dataabse bağlantı aşamaları
$servername = "localhost";
$dbname = "customer";
$username = "root";
$password = "root";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if($connect){
    echo 'bağlantı başarılı'."<br>";
}else{
    echo 'bağlantı başarısız'."<br>";
}


//! verileri silme alanı

// Silinecek verinin ID'sini al
$id = $_GET["id"];

// Veriyi silen SQL sorgusu yazıldı.
$sql = "DELETE FROM customer_info WHERE id = $id";



// veriler silindi ise bize bir dönüş yapar sonrasında ana sayfamız olan connect.php ye aktarır
if ($connect->query($sql) === TRUE) {
    echo "Veri başarıyla silindi.";
    header("Location: connect.php");
    exit();
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

  // Bağlantıyı kapat
  $connect->close();
?>