<?php
// login.php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici = $_POST['kullanici'];
    $sifre = $_POST['sifre'];

    // Basit güvenlik: Kullanıcı adı 'admin', şifre '123456'
    if ($kullanici === 'admin' && $sifre === '123456') {
        $_SESSION['admin_giris'] = true;
        header("Location: panel.php");
        exit;
    } else {
        $hata = "Hatalı kullanıcı adı veya şifre!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli Girişi</title>
    <style>
        body { background: #2C3338; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: #fff; color: #333; padding: 40px; border-radius: 8px; width: 300px; text-align: center; }
        input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #E67E22; color: white; border: none; padding: 10px 20px; width: 100%; cursor: pointer; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Güzel Kardeşler<br>Admin Paneli</h2>
        <?php if(isset($hata)) echo "<p style='color:red;'>$hata</p>"; ?>
        <form method="POST">
            <input type="text" name="kullanici" placeholder="Kullanıcı Adı" required>
            <input type="password" name="sifre" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>