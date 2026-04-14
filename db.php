<?php
// db.php
$host = 'localhost';
$dbname = 'harfiyat_db'; // Kendi veritabanı adını yaz
$user = 'root'; // Kendi veritabanı kullanıcı adını yaz
$pass = ''; // Kendi veritabanı şifreni yaz

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>