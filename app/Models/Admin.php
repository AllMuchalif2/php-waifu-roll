<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Admin {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateLastLogin($id) {
        $stmt = $this->db->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
