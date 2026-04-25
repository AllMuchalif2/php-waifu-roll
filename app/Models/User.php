<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, dice_count, coins) VALUES (?, ?, 10, 0)");
        return $stmt->execute([$username, $hash]);
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    public function canClaimDaily($user_id) {
        $stmt = $this->db->prepare("SELECT last_daily_claim FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $last = $stmt->fetchColumn();
        return $last !== date('Y-m-d');
    }

    public function claimDaily($user_id) {
        $stmt = $this->db->prepare("UPDATE users SET dice_count = dice_count + 5, coins = coins + 100, last_daily_claim = CURRENT_DATE WHERE id = ?");
        return $stmt->execute([$user_id]);
    }

    public function addCoins($userId, $amount) {
        $stmt = $this->db->prepare("UPDATE users SET coins = coins + ? WHERE id = ?");
        return $stmt->execute([$amount, $userId]);
    }

    public function removeCoins($userId, $amount) {
        $stmt = $this->db->prepare("UPDATE users SET coins = coins - ? WHERE id = ?");
        return $stmt->execute([$amount, $userId]);
    }

    public function addDice($userId, $amount) {
        $stmt = $this->db->prepare("UPDATE users SET dice_count = dice_count + ? WHERE id = ?");
        return $stmt->execute([$amount, $userId]);
    }
}
