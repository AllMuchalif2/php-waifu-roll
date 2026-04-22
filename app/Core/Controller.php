<?php

namespace App\Core;

class Controller {
    protected function view($view, $data = [], $layout = null) {
        extract($data);
        $viewFile = "views/" . $view . ".php";
        
        if (file_exists($viewFile)) {
            if ($layout) {
                ob_start();
                require_once $viewFile;
                $content = ob_get_clean();
                require_once "views/layout/" . $layout . ".php";
            } else {
                require_once $viewFile;
            }
        } else {
            die("View $view not found.");
        }
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}
