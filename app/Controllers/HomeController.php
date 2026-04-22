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
        // Fetch Top Waifus
        $stmt = $this->db->query("SELECT * FROM waifu_pool ORDER BY tier DESC, id DESC LIMIT 6");
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
