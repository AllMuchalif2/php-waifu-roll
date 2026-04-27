<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Waifu;

class HomeController extends Controller
{
    private $db;

    private $waifuModel;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->waifuModel = new Waifu();
    }

    public function index()
    {
        // Fetch Top Waifus with Owner Name for LIMITED
        $stmt = $this->db->query("
            SELECT w.*, 
            (SELECT username FROM users u JOIN user_waifus uw ON u.id = uw.user_id WHERE uw.waifu_id = w.id LIMIT 1) as owner_name
            FROM waifu_pool w 
            ORDER BY CASE w.tier 
                WHEN 'LIMITED' THEN 1 
                WHEN 'UR' THEN 2
                WHEN 'SSR' THEN 3 
                WHEN 'SR' THEN 4
                WHEN 'S' THEN 5 
                WHEN 'R' THEN 6
                WHEN 'A' THEN 7 
                WHEN 'B' THEN 8 
                WHEN 'C' THEN 9 
                ELSE 10 END ASC, 
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

    public function pool()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $filters = [
            'search' => $_GET['search'] ?? '',
            'tier' => $_GET['tier'] ?? '',
            'sort' => $_GET['sort'] ?? 'id',
            'order' => $_GET['order'] ?? 'DESC',
            'limit' => $limit,
            'offset' => $offset
        ];

        $waifus = $this->waifuModel->getAll($filters);
        $totalItems = $this->waifuModel->countAll($filters);
        $totalPages = ceil($totalItems / $limit);

        $this->view('home/pool', [
            'waifus' => $waifus,
            'filters' => $filters,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalItems
            ]
        ]);
    }
}
