<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller {
    private $userModel;
    private $adminModel;

    public function __construct() {
        $this->userModel = new User();
        $this->adminModel = new Admin();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('index.php?url=gacha/index');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $this->redirect('index.php?url=gacha/index');
            } else {
                $error = "Username atau password salah.";
            }
        }

        $this->view('auth/login', ['error' => $error]);
    }

    public function register() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('index.php?url=gacha/index');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Semua kolom harus diisi.";
            } elseif ($this->userModel->findByUsername($username)) {
                $error = "Username sudah terdaftar.";
            } else {
                if ($this->userModel->create($username, $password)) {
                    $_SESSION['user_id'] = $this->userModel->lastInsertId();
                    $this->redirect('index.php?url=gacha/index');
                } else {
                    $error = "Gagal mendaftar.";
                }
            }
        }

        $this->view('auth/register', ['error' => $error]);
    }

    public function adminLogin() {
        if (isset($_SESSION['admin_id'])) {
            $this->redirect('index.php?url=admin/index');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $admin = $this->adminModel->findByUsername($username);
            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $this->adminModel->updateLastLogin($admin['id']);
                $this->redirect('index.php?url=admin/index');
            } else {
                $error = "Admin credentials invalid.";
            }
        }

        $this->view('auth/admin_login', ['error' => $error]);
    }

    public function logout() {
        session_destroy();
        $this->redirect('index.php?url=auth/login');
    }
}
