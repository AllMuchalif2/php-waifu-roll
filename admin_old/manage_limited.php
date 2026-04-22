<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset_slot'])) {
        $slot_number = (int) $_POST['slot_number'];
        $stmt = $pdo->prepare("UPDATE limited_slots SET owner_id = NULL WHERE slot_number = ?");
        $stmt->execute([$slot_number]);
    } elseif (isset($_POST['reset_all'])) {
        $stmt = $pdo->prepare("UPDATE limited_slots SET owner_id = NULL");
        $stmt->execute();
    }
    header("Location: manage_limited.php");
    exit;
}

$stmt = $pdo->query("
    SELECT 
        ls.slot_number, 
        ls.owner_id, 
        w.name AS waifu_name, 
        w.tier, 
        u.username AS owner_name
    FROM limited_slots ls
    LEFT JOIN waifu_pool w ON ls.waifu_id = w.id
    LEFT JOIN users u ON ls.owner_id = u.id
    ORDER BY ls.slot_number ASC
");
$slots = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Slot Terbatas - Waifu Gacha</title>
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

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-gray {
            background-color: #7F8C8D;
        }

        .btn-gray:hover {
            background-color: #95A5A6;
        }

        .btn-danger {
            background-color: #E74C3C;
        }

        .btn-danger:hover {
            background-color: #C0392B;
        }

        .grid-100 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }

        .slot-card {
            background-color: #34495E;
            border-radius: 6px;
            padding: 1rem;
            text-align: center;
            border: 2px solid #2C3E50;
        }

        .slot-card.claimed {
            border-color: #F1C40F;
            background-color: #2C3E50;
        }

        .slot-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #BDC3C7;
            margin-bottom: 0.5rem;
        }

        .slot-details {
            font-size: 0.8rem;
            color: #ECF0F1;
            margin-bottom: 0.5rem;
        }

        .slot-owner {
            color: #F1C40F;
            font-weight: bold;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-small {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1><i class="fa-solid fa-table-cells-large"></i> Kelola Slot Terbatas</h1>
        <a href="index.php" class="btn btn-gray"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="container">
        <div class="header-actions">
            <h2>Status 100 Slot</h2>
            <form method="POST" onsubmit="return confirm('Anda yakin ingin mereset SEMUA slot terbatas?');">
                <button type="submit" name="reset_all" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i>
                    Reset Semua Slot</button>
            </form>
        </div>

        <div class="grid-100">
            <?php foreach ($slots as $slot): ?>
                <div class="slot-card <?php echo $slot['owner_id'] ? 'claimed' : ''; ?>">
                    <div class="slot-number">#
                        <?php echo htmlspecialchars($slot['slot_number']); ?>
                    </div>
                    <div class="slot-details">
                        <?php echo htmlspecialchars($slot['waifu_name'] ?? 'Kosong'); ?><br>
                        (
                        <?php echo htmlspecialchars($slot['tier'] ?? '-'); ?>)
                    </div>

                    <?php if ($slot['owner_id']): ?>
                        <div class="slot-owner"><i class="fa-solid fa-user"></i>
                            <?php echo htmlspecialchars($slot['owner_name']); ?>
                        </div>
                        <form method="POST" onsubmit="return confirm('Reset slot #<?php echo $slot['slot_number']; ?>?');">
                            <input type="hidden" name="slot_number" value="<?php echo $slot['slot_number']; ?>">
                            <button type="submit" name="reset_slot" class="btn btn-danger btn-small"><i
                                    class="fa-solid fa-trash-can"></i> Reset</button>
                        </form>
                    <?php else: ?>
                        <div class="slot-owner" style="color: #95A5A6;"><i class="fa-solid fa-lock-open"></i> Tersedia</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>