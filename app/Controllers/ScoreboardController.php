<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class ScoreboardController extends Controller {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        $stmt = $this->db->query("
            SELECT u.username, u.coins, COUNT(uw.waifu_id) as waifu_count
            FROM users u
            LEFT JOIN user_waifus uw ON u.id = uw.user_id
            GROUP BY u.id
            ORDER BY waifu_count DESC, u.coins DESC
            LIMIT 50
        ");
        $rankings = $stmt->fetchAll();

        $this->view('player/scoreboard', ['rankings' => $rankings]);
    }
}
