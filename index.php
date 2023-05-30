<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Yönetimi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Kullanıcı Yönetimi</h1>
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

            // Veritabanından kullanıcıları sorgula
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Kullanıcılar varsa, tabloyu oluştur
                echo "<table>";
                echo "<tr><th>ID</th><th>İsim</th><th>Email</th><th>İşlemler</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td><a href='edit_user.php?id=" . $row['id'] . "' class='edit-button'>Düzenle</a> | <a href='delete_user.php?id=" . $row['id'] . "' class='delete-button'>Sil</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='alert alert-error'>Hiç kullanıcı bulunamadı.</p>";
            }

            // Veritabanı bağlantısını kapat
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
