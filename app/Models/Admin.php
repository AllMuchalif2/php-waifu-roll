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

    public function getDashboardStats() {
        $stats = [];
        
        // Total Players
        $stmt = $this->db->query("SELECT COUNT(*) FROM users");
        $stats['total_players'] = $stmt->fetchColumn();
        
        // Total Waifus
        $stmt = $this->db->query("SELECT COUNT(*) FROM waifu_pool");
        $stats['total_waifus'] = $stmt->fetchColumn();
        
        // Tier Breakdown
        $stmt = $this->db->query("SELECT tier, COUNT(*) as count FROM waifu_pool GROUP BY tier");
        $tierStats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        $stats['tiers'] = [
            'C' => $tierStats['C'] ?? 0,
            'B' => $tierStats['B'] ?? 0,
            'A' => $tierStats['A'] ?? 0,
            'R' => $tierStats['R'] ?? 0,
            'S' => $tierStats['S'] ?? 0,
            'SR' => $tierStats['SR'] ?? 0,
            'SSR' => $tierStats['SSR'] ?? 0,
            'UR' => $tierStats['UR'] ?? 0,
            'LIMITED' => $tierStats['LIMITED'] ?? 0,
        ];
        
        return $stats;
    }
}
