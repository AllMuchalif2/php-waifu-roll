<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Database;

class GachaController extends Controller {
    private $userModel;
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('index.php?url=auth/login');
        }
        $this->userModel = new User();
        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        $user = $this->userModel->findById($_SESSION['user_id']);
        
        $filters = [
            'search' => $_GET['search'] ?? '',
            'tier' => $_GET['tier'] ?? '',
            'sort' => $_GET['sort'] ?? 'total',
            'order' => $_GET['order'] ?? 'DESC'
        ];

        $sql = "
            SELECT w.name, w.image_url, w.tier, COUNT(uw.waifu_id) as total 
            FROM user_waifus uw 
            JOIN waifu_pool w ON uw.waifu_id = w.id 
            WHERE uw.user_id = ? 
        ";
        $params = [$_SESSION['user_id']];

        if (!empty($filters['search'])) {
            $sql .= " AND w.name LIKE ?";
            $params[] = "%" . $filters['search'] . "%";
        }

        if (!empty($filters['tier'])) {
            $sql .= " AND w.tier = ?";
            $params[] = $filters['tier'];
        }

        $sql .= " GROUP BY uw.waifu_id";

        $sortMapping = [
            'total' => 'total',
            'name' => 'w.name',
            'tier' => 'w.tier'
        ];
        $sort = $sortMapping[$filters['sort']] ?? 'total';
        $order = ($filters['order'] === 'ASC') ? 'ASC' : 'DESC';

        $sql .= " ORDER BY $sort $order";

        $stmtWaifu = $this->db->prepare($sql);
        $stmtWaifu->execute($params);
        $waifus = $stmtWaifu->fetchAll();

        $this->view('player/dashboard', [
            'user' => $user,
            'waifus' => $waifus,
            'filters' => $filters
        ]);
    }

    public function executeRoll() {
        $userId = $_SESSION['user_id'];
        
        $stmt = $this->db->prepare("SELECT dice_count, last_roll_timestamp FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        if (!$user || $user['dice_count'] < 1) {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'Dadu tidak mencukupi']);
            exit;
        }

        $currentTime = time();
        if ($user['last_roll_timestamp'] && ($currentTime - $user['last_roll_timestamp']) < 3) {
            header('Content-Type: application/json', true, 429);
            echo json_encode(['error' => 'Terlalu banyak permintaan, tunggu sejenak']);
            exit;
        }

        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("UPDATE users SET last_roll_timestamp = ?, dice_count = dice_count - 1 WHERE id = ?");
            $stmt->execute([$currentTime, $userId]);

            $stmt = $this->db->query("SELECT id, tier FROM waifu_pool");
            $pool = $stmt->fetchAll();

            if (empty($pool)) {
                 throw new \Exception("Waifu pool kosong!");
            }

            $tiers = ['C' => [], 'B' => [], 'A' => [], 'SR' => [], 'SSR' => []];
            foreach ($pool as $w) {
                $tiers[$w['tier']][] = $w['id'];
            }

            $rand = mt_rand(1, 1000);
            if ($rand <= 500) $selectedTier = 'C';
            elseif ($rand <= 750) $selectedTier = 'B';
            elseif ($rand <= 900) $selectedTier = 'A';
            elseif ($rand <= 970) $selectedTier = 'SR';
            elseif ($rand <= 995) $selectedTier = 'SSR';
            else $selectedTier = 'LIMITED';

            if (empty($tiers[$selectedTier])) $selectedTier = 'SSR';
            if (empty($tiers[$selectedTier])) $selectedTier = 'C';

            if ($selectedTier === 'LIMITED') {
                // Find ALL available limited waifus (not owned by anyone)
                $stmtAvailable = $this->db->query("
                    SELECT id FROM waifu_pool 
                    WHERE tier = 'LIMITED' 
                    AND id NOT IN (SELECT waifu_id FROM user_waifus)
                ");
                $availableLimited = $stmtAvailable->fetchAll(\PDO::FETCH_COLUMN);

                if (!empty($availableLimited)) {
                    $waifuId = $availableLimited[array_rand($availableLimited)];
                } else {
                    // No available LIMITED waifus! Fallback to SSR
                    $selectedTier = 'SSR';
                    if (empty($tiers['SSR'])) $selectedTier = 'C';
                    $waifuId = $tiers[$selectedTier][array_rand($tiers[$selectedTier])];
                }
            } else {
                $waifuId = $tiers[$selectedTier][array_rand($tiers[$selectedTier])];
            }

            $stmt = $this->db->prepare("INSERT INTO user_waifus (user_id, waifu_id) VALUES (?, ?)");
            $stmt->execute([$userId, $waifuId]);
            $message = "Anda mendapatkan karakter tier " . $selectedTier;

            $this->db->commit();

            $stmt = $this->db->prepare("SELECT * FROM waifu_pool WHERE id = ?");
            $stmt->execute([$waifuId]);
            $waifu = $stmt->fetch();

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'waifu' => $waifu, 'message' => $message]);
        } catch (\Exception $e) {
            $this->db->rollBack();
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }


    public function roll() {
        $user = $this->userModel->findById($_SESSION['user_id']);
        $this->view('player/roll', ['user' => $user]);
    }

    public function daily() {
        $userId = $_SESSION['user_id'];
        if ($this->userModel->canClaimDaily($userId)) {
            $this->userModel->claimDaily($userId);
            $_SESSION['success'] = "Daily Reward Berhasil Diklaim! +5 Dadu & +100 Koin.";
        } else {
            $_SESSION['error'] = "Anda sudah mengambil reward hari ini.";
        }
        $this->redirect('index.php?url=gacha/index');
    }
}
