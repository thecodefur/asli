<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Düzenle</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Kullanıcı Düzenle</h1>
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
                // Veritabanı bağlantısı için ayarları güncelleyin
                

                // if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                //     // Düzenleme isteği geldiğinde çalışacak kodlar buraya gelecek

                //     // URL'den kullanıcı ID'sini al
                //     if (isset($_GET['id'])) {
                //         $user_id = $_GET['id'];

                //         // Veritabanından kullanıcı bilgilerini sorgula
                //         $sql = "SELECT * FROM users WHERE id = $user_id";
                //         $result = mysqli_query($conn, $sql);
                //         if (mysqli_num_rows($result) > 0) {
                //             $user = mysqli_fetch_assoc($result);
                //         } else {
                //             echo "Kullanıcı bulunamadı.";
                //             exit;
                //         }
                //     } else {
                //         echo "Kullanıcı ID'si belirtilmedi.";
                //         exit;
                //     }
                // }

                // URL'den kullanıcı ID'sini al
                $user_id = $_GET['id'];

                // Veritabanından kullanıcı bilgilerini sorgula
                $sql = "SELECT * FROM users WHERE id = $user_id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                } else {
                    echo "Kullanıcı bulunamadı.";
                    exit;
                }
            }
            ?>

            <form method="POST" action="edit_user.php">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <label for="name">İsim:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>

                <input type="submit" value="Kullanıcıyı Güncelle">
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Güncelleme formu gönderildiğinde çalışacak kodlar buraya gelecek

                // Formdan gelen verileri al
                $user_id = $_POST['user_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];

                // Veritabanında kullanıcıyı güncelleme
                $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$user_id";
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='alert alert-success'>Kullanıcı başarıyla güncellendi! Ana sayfaya yönlendiriliyorsunuz...</p>";

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
