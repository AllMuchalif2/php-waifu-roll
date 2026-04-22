<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

require_once '../config/database.php';
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT dice_count, last_roll_timestamp FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user || $user['dice_count'] < 1) {
    http_response_code(400);
    echo json_encode(['error' => 'Dadu tidak mencukupi']);
    exit;
}

$currentTime = time();
if ($user['last_roll_timestamp'] && ($currentTime - $user['last_roll_timestamp']) < 3) {
    http_response_code(429);
    echo json_encode(['error' => 'Terlalu banyak permintaan, tunggu sejenak']);
    exit;
}

$pdo->beginTransaction();

$stmt = $pdo->prepare("UPDATE users SET last_roll_timestamp = ?, dice_count = dice_count - 1 WHERE id = ?");
$stmt->execute([$currentTime, $userId]);

$stmt = $pdo->query("SELECT id, tier FROM waifu_pool");
$pool = $stmt->fetchAll();

$tiers = ['C' => [], 'B' => [], 'A' => [], 'SR' => [], 'SSR' => []];
foreach ($pool as $w) {
    $tiers[$w['tier']][] = $w['id'];
}

$rand = mt_rand(1, 1000);
if ($rand <= 500) {
    $selectedTier = 'C';
} elseif ($rand <= 800) {
    $selectedTier = 'B';
} elseif ($rand <= 950) {
    $selectedTier = 'A';
} elseif ($rand <= 990) {
    $selectedTier = 'SR';
} else {
    $selectedTier = 'SSR';
}

if (empty($tiers[$selectedTier])) {
    $selectedTier = 'C';
}

$waifuId = $tiers[$selectedTier][array_rand($tiers[$selectedTier])];
$isLimitedAttempt = isset($_POST['slot_number']) ? (int) $_POST['slot_number'] : null;

if ($isLimitedAttempt && $selectedTier === 'SSR') {
    $stmt = $pdo->prepare("UPDATE limited_slots SET owner_id = ? WHERE slot_number = ? AND owner_id IS NULL");
    $stmt->execute([$userId, $isLimitedAttempt]);

    if ($stmt->rowCount() === 0) {
        $stmt = $pdo->prepare("INSERT INTO user_waifus (user_id, waifu_id) VALUES (?, ?)");
        $stmt->execute([$userId, $waifuId]);
        $message = "Slot sudah diambil orang lain. Anda dialihkan ke SSR biasa.";
    } else {
        $stmt = $pdo->prepare("SELECT waifu_id FROM limited_slots WHERE slot_number = ?");
        $stmt->execute([$isLimitedAttempt]);
        $limited = $stmt->fetch();
        $waifuId = $limited['waifu_id'];
        $message = "Selamat! Anda berhasil mengamankan Slot #" . $isLimitedAttempt;
    }
} else {
    $stmt = $pdo->prepare("INSERT INTO user_waifus (user_id, waifu_id) VALUES (?, ?)");
    $stmt->execute([$userId, $waifuId]);
    $message = "Anda mendapatkan karakter tier " . $selectedTier;
}

$pdo->commit();

$stmt = $pdo->prepare("SELECT * FROM waifu_pool WHERE id = ?");
$stmt->execute([$waifuId]);
$waifu = $stmt->fetch();

echo json_encode([
    'success' => true,
    'waifu' => $waifu,
    'message' => $message
]);
?>