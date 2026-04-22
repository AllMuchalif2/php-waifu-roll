<?php
require_once 'config/database.php';

$user = 'admin';
$pass = 'password_anda_disini'; // Ganti dengan password yang diinginkan
$hash = password_hash($pass, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute([$user, $hash]);
    echo "Admin berhasil dibuat!";
} catch (PDOException $e) {
    echo "Gagal: " . $e->getMessage();
}
?>