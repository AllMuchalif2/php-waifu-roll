<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Waifu {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($filters = []) {
        $sql = "SELECT * FROM waifu_pool WHERE 1=1";
        $params = [];

        if (!empty($filters['search'])) {
            $sql .= " AND name LIKE ?";
            $params[] = "%" . $filters['search'] . "%";
        }

        if (!empty($filters['tier'])) {
            $sql .= " AND tier = ?";
            $params[] = $filters['tier'];
        }

        $sort = $filters['sort'] ?? 'id';
        $order = $filters['order'] ?? 'DESC';
        
        $allowedSort = ['id', 'name', 'tier', 'jikan_id'];
        $allowedOrder = ['ASC', 'DESC'];
        
        if (!in_array($sort, $allowedSort)) $sort = 'id';
        if (!in_array($order, $allowedOrder)) $order = 'DESC';

        $sql .= " ORDER BY $sort $order";

        // Pagination
        if (isset($filters['limit']) && isset($filters['offset'])) {
            $sql .= " LIMIT ? OFFSET ?";
            $params[] = (int)$filters['limit'];
            $params[] = (int)$filters['offset'];
        }

        $stmt = $this->db->prepare($sql);
        
        // Bind params manually to ensure integers for LIMIT/OFFSET
        foreach ($params as $i => $val) {
            $type = is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($i + 1, $val, $type);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll($filters = []) {
        $sql = "SELECT COUNT(*) FROM waifu_pool WHERE 1=1";
        $params = [];

        if (!empty($filters['search'])) {
            $sql .= " AND name LIKE ?";
            $params[] = "%" . $filters['search'] . "%";
        }

        if (!empty($filters['tier'])) {
            $sql .= " AND tier = ?";
            $params[] = $filters['tier'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function create($jikan_id, $name, $image_url, $tier) {
        $stmt = $this->db->prepare("INSERT INTO waifu_pool (jikan_id, name, image_url, tier) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$jikan_id, $name, $image_url, $tier]);
    }

    public function fetchFromJikan($jikan_id) {
        $url = "https://api.jikan.moe/v4/characters/" . $jikan_id . "/full";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'MYBINI-App/1.0');
        $response = curl_exec($ch);
        curl_close($ch);
        
        if (!$response) return null;
        
        $data = json_decode($response, true);
        if (isset($data['data'])) {
            return [
                'jikan_id' => $data['data']['mal_id'],
                'name' => $data['data']['name'],
                'image_url' => $data['data']['images']['jpg']['image_url']
            ];
        }
        return null;
    }

    public function update($id, $name, $tier) {
        $stmt = $this->db->prepare("UPDATE waifu_pool SET name = ?, tier = ? WHERE id = ?");
        return $stmt->execute([$name, $tier, $id]);
    }

    public function hasOwners($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user_waifus WHERE waifu_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    public function delete($id) {
        if ($this->hasOwners($id)) {
            return false;
        }
        $stmt = $this->db->prepare("DELETE FROM waifu_pool WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM waifu_pool WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function searchByName($name) {
        $url = "https://api.jikan.moe/v4/characters?q=" . urlencode($name) . "&limit=15&order_by=favorites&sort=desc";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'MYBINI-App/1.0');
        $response = curl_exec($ch);
        curl_close($ch);
        
        if (!$response) return null;
        
        $data = json_decode($response, true);
        return $data['data'] ?? [];
    }

    public function existsByJikanId($jikan_id) {
        $stmt = $this->db->prepare("SELECT id FROM waifu_pool WHERE jikan_id = ?");
        $stmt->execute([$jikan_id]);
        return (bool)$stmt->fetch();
    }
}
