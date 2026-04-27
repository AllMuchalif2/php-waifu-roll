<?php
require 'app/Config/config.php';
require 'app/Core/Database.php';
$db = App\Core\Database::getInstance()->getConnection();
$db->exec('
');
echo 'Table created';
