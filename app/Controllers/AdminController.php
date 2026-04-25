<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;
use App\Models\Waifu;

class AdminController extends Controller {
    private $adminModel;
    private $waifuModel;

    public function __construct() {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirect('index.php?url=auth/adminLogin');
        }
        $this->adminModel = new Admin();
        $this->waifuModel = new Waifu();
    }

    public function index() {
        $admin = $this->adminModel->findById($_SESSION['admin_id']);
        $stats = $this->adminModel->getDashboardStats();
        $this->view('admin/dashboard', [
            'admin' => $admin,
            'stats' => $stats
        ], 'admin');
    }

    public function waifus() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $limit = 15;
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

        $this->view('admin/waifus', [
            'waifus' => $waifus,
            'filters' => $filters,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalItems
            ]
        ], 'admin');
    }

    public function addWaifu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jikan_id = $_POST['jikan_id'];
            $name = $_POST['name'];
            $image_url = $_POST['image_url'];
            $tier = $_POST['tier'];

            if ($this->waifuModel->create($jikan_id, $name, $image_url, $tier)) {
                $this->redirect('index.php?url=admin/waifus');
            }
        }
    }

    public function fetchWaifu() {
        if (isset($_GET['jikan_id'])) {
            $data = $this->waifuModel->fetchFromJikan($_GET['jikan_id']);
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }
    }
    
    public function updateWaifu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $tier = $_POST['tier'];
            $this->waifuModel->update($id, $name, $tier);
            $this->redirect('index.php?url=admin/waifus');
        }
    }

    public function deleteWaifu() {
        if (isset($_GET['id'])) {
            if ($this->waifuModel->delete($_GET['id'])) {
                $_SESSION['success'] = "Waifu berhasil dihapus.";
            } else {
                $_SESSION['error'] = "Gagal hapus! Waifu ini sudah dimiliki oleh player.";
            }
            $this->redirect('index.php?url=admin/waifus');
        }
    }
    public function searchWaifu() {
        if (isset($_GET['query'])) {
            $results = $this->waifuModel->searchByName($_GET['query']);
            header('Content-Type: application/json');
            echo json_encode($results);
            exit;
        }
    }
}
