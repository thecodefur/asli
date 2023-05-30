<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Sil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Kullanıcı Sil</h1>
        <div class="menu">
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="add_user.php">Kullanıcı Ekle</a></li>
            </ul>
        </div>
        <div class="content">
            <?php
            // Veritabanı bağlantısı için ayarları güncelleyin
            $db_host = 'localhost';
            $db_user = 'your_username';
            $db_pass = 'your_password';
            $db_name = 'asli';

            // Veritabanına bağlanma
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if (!$conn) {
                die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
            }

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                // Silme isteği geldiğinde çalışacak kodlar buraya gelecek

                // URL'den kullanıcı ID'sini al
                $user_id = $_GET['id'];

                // Veritabanından kullanıcıyı silme
                $sql = "DELETE FROM users WHERE id = $user_id";
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='alert alert-error'>Kullanıcı başarıyla silindi! Ana sayfaya yönlendiriliyorsunuz...</p>";

                    // Ana sayfaya yönlendirme
                    header("refresh:3; url=index.php");
                } else {
                    echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

            // Veritabanı bağlantısını kapat
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
