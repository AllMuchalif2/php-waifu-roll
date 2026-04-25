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
        
        $stmtWaifu = $this->db->prepare("
            SELECT w.name, w.image_url, w.tier, COUNT(uw.waifu_id) as total 
            FROM user_waifus uw 
            JOIN waifu_pool w ON uw.waifu_id = w.id 
            WHERE uw.user_id = ? 
            GROUP BY uw.waifu_id
        ");
        $stmtWaifu->execute([$_SESSION['user_id']]);
        $waifus = $stmtWaifu->fetchAll();

        $this->view('player/dashboard', [
            'user' => $user,
            'waifus' => $waifus
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

            // Special logic for LIMITED
            if ($selectedTier === 'LIMITED') {
                $waifuId = $tiers['LIMITED'][array_rand($tiers['LIMITED'])];
                // Check if anyone owns this waifu
                $stmtCheck = $this->db->prepare("SELECT id FROM user_waifus WHERE waifu_id = ? LIMIT 1");
                $stmtCheck->execute([$waifuId]);
                if ($stmtCheck->fetch()) {
                    // Already owned! Fallback to SSR
                    $selectedTier = 'SSR';
                    if (empty($tiers['SSR'])) $selectedTier = 'C';
                    $waifuId = $tiers[$selectedTier][array_rand($tiers[$selectedTier])];
                }
            } else {
                $waifuId = $tiers[$selectedTier][array_rand($tiers[$selectedTier])];
            }

            $isLimitedAttempt = isset($_POST['slot_number']) ? (int) $_POST['slot_number'] : null;

            if ($isLimitedAttempt && $selectedTier === 'SSR') {
                $stmt = $this->db->prepare("UPDATE limited_slots SET owner_id = ? WHERE slot_number = ? AND owner_id IS NULL");
                $stmt->execute([$userId, $isLimitedAttempt]);

                if ($stmt->rowCount() === 0) {
                    $stmt = $this->db->prepare("INSERT INTO user_waifus (user_id, waifu_id) VALUES (?, ?)");
                    $stmt->execute([$userId, $waifuId]);
                    $message = "Slot sudah diambil orang lain. Anda dialihkan ke SSR biasa.";
                } else {
                    $stmt = $this->db->prepare("SELECT waifu_id FROM limited_slots WHERE slot_number = ?");
                    $stmt->execute([$isLimitedAttempt]);
                    $limited = $stmt->fetch();
                    $waifuId = $limited['waifu_id'];
                    $message = "Selamat! Anda berhasil mengamankan Slot #" . $isLimitedAttempt;
                }
            } else {
                $stmt = $this->db->prepare("INSERT INTO user_waifus (user_id, waifu_id) VALUES (?, ?)");
                $stmt->execute([$userId, $waifuId]);
                $message = "Anda mendapatkan karakter tier " . $selectedTier;
            }

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

    public function getSlots() {
        $stmt = $this->db->query("SELECT * FROM limited_slots ORDER BY slot_number ASC");
        $slots = $stmt->fetchAll();
        header('Content-Type: application/json');
        echo json_encode(['slots' => $slots]);
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
