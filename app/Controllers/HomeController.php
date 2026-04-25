<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class HomeController extends Controller {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        // Fetch Top Waifus with Owner Name for LIMITED
        $stmt = $this->db->query("
            SELECT w.*, 
            (SELECT username FROM users u JOIN user_waifus uw ON u.id = uw.user_id WHERE uw.waifu_id = w.id LIMIT 1) as owner_name
            FROM waifu_pool w 
            ORDER BY CASE w.tier 
                WHEN 'LIMITED' THEN 1 
                WHEN 'SSR' THEN 2 
                WHEN 'SR' THEN 3 
                WHEN 'A' THEN 4 
                WHEN 'B' THEN 5 
                WHEN 'C' THEN 6 
                ELSE 7 END ASC, 
            w.id DESC 
            LIMIT 6
        ");
        $topWaifus = $stmt->fetchAll();

        // Fetch Top Scoreboard
        $stmt = $this->db->query("
            SELECT u.username, u.coins, COUNT(uw.waifu_id) as waifu_count
            FROM users u
            LEFT JOIN user_waifus uw ON u.id = uw.user_id
            GROUP BY u.id
            ORDER BY waifu_count DESC, u.coins DESC
            LIMIT 5
        ");
        $rankings = $stmt->fetchAll();

        $this->view('home/index', [
            'topWaifus' => $topWaifus,
            'rankings' => $rankings
        ]);
    }
}
