<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Ekle</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Kullanıcı Ekle</h1>
        <div class="menu">
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="add_user.php">Kullanıcı Ekle</a></li>
            </ul>
        </div>
        <div class="content">
            <form method="POST" action="add_user.php">
                <label for="name">İsim:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <input type="submit" value="Kullanıcı Ekle">
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Form gönderildiğinde çalışacak kodlar

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

                // Formdan gönderilen verileri al
                $name = $_POST['name'];
                $email = $_POST['email'];

                // Veritabanına kullanıcı ekleme
                $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='alert alert-success'>Kullanıcı başarıyla eklendi! Ana sayfaya yönlendiriliyorsunuz...</p>";

                    // Ana sayfaya yönlendirme
                    header("refresh:3; url=index.php");
                } else {
                    echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
                }

                // Veritabanı bağlantısını kapat
                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</body>
</html>
