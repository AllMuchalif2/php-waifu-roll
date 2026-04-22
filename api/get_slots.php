<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

require_once '../config/database.php';

$stmt = $pdo->query("
    SELECT 
        ls.slot_number, 
        ls.owner_id, 
        w.name AS waifu_name, 
        w.tier, 
        u.username AS owner_name 
    FROM limited_slots ls 
    JOIN waifu_pool w ON ls.waifu_id = w.id 
    LEFT JOIN users u ON ls.owner_id = u.id 
    ORDER BY ls.slot_number ASC
");
$slots = $stmt->fetchAll();

echo json_encode(['slots' => $slots]);
?>