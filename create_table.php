<?php
require 'app/Config/config.php';
require 'app/Core/Database.php';
$db = App\Core\Database::getInstance()->getConnection();
$db->exec('
CREATE TABLE IF NOT EXISTS gacha_history (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, waifu_id INT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE, FOREIGN KEY(waifu_id) REFERENCES waifu_pool(id) ON DELETE CASCADE)
');
echo 'Table created';
