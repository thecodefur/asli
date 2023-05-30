<?php

// Veritabanı bağlantısı
$conn = mysqli_connect("localhost", "kullanici_adi", "parola", "veritabani_adi");

// Bağlantı kontrolü
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Kullanıcı ekleme işlemi
function kullaniciEkle($ad, $email, $sifre) {
    global $conn;
    
    $hashedSifre = password_hash($sifre, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO kullanici (ad, email, sifre) VALUES ('$ad', '$email', '$hashedSifre')";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

// Kullanıcı düzenleme işlemi
function kullaniciDuzenle($id, $ad, $email, $sifre) {
    global $conn;
    
    $hashedSifre = password_hash($sifre, PASSWORD_DEFAULT);
    
    $query = "UPDATE kullanici SET ad='$ad', email='$email', sifre='$hashedSifre' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

// Kullanıcı silme işlemi
function kullaniciSil($id) {
    global $conn;
    
    $query = "DELETE FROM kullanici WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

?>
