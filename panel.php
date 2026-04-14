<?php
// panel.php
session_start();
require 'db.php';

// Güvenlik: Sadece giriş yapanlar görebilir
if (!isset($_SESSION['admin_giris'])) {
    header("Location: login.php");
    exit;
}

// Güvenli çıkış işlemi
if (isset($_GET['cikis'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Fotoğraf Yükleme İşlemi
if (isset($_POST['foto_yukle'])) {
    $aciklama = $_POST['aciklama'];
    
    // Yüklenen dosya bilgileri
    $dosya_adi = $_FILES['foto']['name'];
    $gecici_yol = $_FILES['foto']['tmp_name'];
    
    // Benzersiz bir dosya adı oluşturuyoruz (Çakışmayı önlemek için)
    $yeni_dosya_adi = time() . '_' . $dosya_adi;
    $hedef_klasor = 'img/' . $yeni_dosya_adi;
    
    // Dosyayı img klasörüne taşı
    if (move_uploaded_file($gecici_yol, $hedef_klasor)) {
        // Veritabanına kaydet
        $sorgu = $db->prepare("INSERT INTO galeri (foto_yol, aciklama) VALUES (?, ?)");
        $sorgu->execute([$yeni_dosya_adi, $aciklama]);
        $mesaj = "Fotoğraf başarıyla yüklendi!";
    } else {
        $mesaj = "Dosya yüklenirken bir hata oluştu!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli</title>
    <style>
        body { font-family: sans-serif; background: #F4F6F7; margin: 0; }
        .header { background: #2C3338; color: white; padding: 20px; display: flex; justify-content: space-between; }
        .header a { color: #E67E22; text-decoration: none; font-weight: bold; }
        .container { max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        input[type="text"], input[type="file"] { width: 100%; padding: 10px; margin-top: 5px; }
        button { background: #E67E22; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Kontrol Paneli</h2>
        <a href="?cikis=1">Çıkış Yap</a>
    </div>

    <div class="container">
        <h3>Yeni Şantiye Fotoğrafı Ekle</h3>
        <?php if(isset($mesaj)) echo "<p style='color:green; font-weight:bold;'>$mesaj</p>"; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Fotoğraf Seçiniz:</label>
                <input type="file" name="foto" accept="image/*" required>
            </div>
            <div class="form-group">
                <label>Kısa Açıklama (Örn: Levent Bina Yıkımı):</label>
                <input type="text" name="aciklama" required>
            </div>
            <button type="submit" name="foto_yukle">Fotoğrafı Yükle ve Kaydet</button>
        </form>
    </div>
</body>
</html>