<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';

$stmt = $pdo->prepare("SELECT username, last_login FROM admins WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Waifu Gacha</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #2C3E50;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #34495E;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            margin: 0;
            font-size: 1.2rem;
            color: #ECF0F1;
        }
        .container {
            padding: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background-color: #34495E;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        .card h2 {
            margin-top: 0;
            color: #ECF0F1;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .card p {
            color: #BDC3C7;
            font-size: 0.9rem;
            margin-top: 0;
            margin-bottom: 1.5rem;
        }
        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background-color: #E74C3C;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn:hover {
            background-color: #C0392B;
        }
        .btn-blue {
            background-color: #2980B9;
        }
        .btn-blue:hover {
            background-color: #236C9F;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1><i class="fa-solid fa-shield-halved"></i> Admin Panel</h1>
        <form method="POST" style="margin: 0;">
            <button type="submit" name="logout" class="btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="card">
            <h2><i class="fa-solid fa-user-check"></i> Selamat Datang, <?php echo htmlspecialchars($admin['username'] ?? 'Admin'); ?></h2>
            <p>Terakhir login: <?php echo htmlspecialchars($admin['last_login'] ?? 'Belum ada data'); ?></p>
        </div>

        <div class="grid">
            <div class="card">
                <h2><i class="fa-solid fa-table-cells-large"></i> Kelola Slot Terbatas</h2>
                <p>Pantau status 100 slot waifu terbatas dan atur ulang pemenang jika diperlukan.</p>
                <a href="manage_limited.php" class="btn btn-blue"><i class="fa-solid fa-gear"></i> Kelola Slot</a>
            </div>
        </div>
    </div>
</body>
</html>