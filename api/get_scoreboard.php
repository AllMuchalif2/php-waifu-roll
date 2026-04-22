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

$stmt = $pdo->query("SELECT id, username, coins FROM users ORDER BY coins DESC, id ASC LIMIT 19");
$top19 = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT username, coins FROM users WHERE id = ?");
$stmt->execute([$userId]);
$currentUser = $stmt->fetch();

$stmt = $pdo->prepare("SELECT COUNT(*) + 1 AS rank FROM users WHERE coins > ? OR (coins = ? AND id < ?)");
$stmt->execute([$currentUser['coins'], $currentUser['coins'], $userId]);
$userRank = $stmt->fetch()['rank'];

echo json_encode([
    'top_19' => $top19,
    'current_user' => [
        'username' => $currentUser['username'],
        'coins' => $currentUser['coins'],
        'rank' => $userRank
    ]
]);
?>