<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Waifu {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM waifu_pool ORDER BY id DESC");
        return $stmt->fetchAll();
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

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM waifu_pool WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM waifu_pool WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function searchByName($name) {
        $url = "https://api.jikan.moe/v4/characters?q=" . urlencode($name) . "&limit=5";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        if (!$response) return null;
        
        $data = json_decode($response, true);
        return $data['data'] ?? [];
    }
}
