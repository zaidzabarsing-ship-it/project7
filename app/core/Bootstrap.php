<?php

namespace App\Core;

class Bootstrap
{
    public function __construct()
    {
        // Ambil URL dari REQUEST_URI jika tidak ada parameter 'page'
        $url = $_GET['page'] ?? $this->getRequestUri();

        // Jika ada URL yang diakses
        if ($url) {
            // Filter dan bersihkan URL
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = trim($url, '/');
            $url = explode('/', $url);

            // Uppercase huruf pertama dan ambil bagian pertama sebagai nama controller
            $page = ucfirst(array_shift($url));

            // Cek apakah file controller ada
            if (file_exists(ROOT . "app/controllers/" . $page . ".php")) {
                // Halaman selain halaman publik hanya dapat diakses setelah login
                if (!in_array($page, ['Index', 'Auth']) && !isset($_SESSION['user_id'])) {
                    header('location:' . URL . '/auth/login');
                    exit;
                }

                $class = "App\\Controllers\\" . $page;
                $controller = new $class;

                // Cek method
                $action = $url ? array_shift($url) : 'index';

                // Cek apakah method ada pada controller
                if (method_exists($controller, $action)) {
                    // Parameters = controller/method/params
                    $params = array_values($url);
                    call_user_func_array([$controller, $action], $params);
                } else {
                    $controller = new \App\Core\Error();
                    $controller->fileNotFound();
                }
            } else {
                // Jika controller tidak ditemukan, tampilkan halaman error
                $class = "App\\Core\\Error";
                $controller = new $class();
                $controller->fileNotFound();
            }
        } else {
            // Jika tidak ada URL, panggil controller Index secara default
            $class = "App\\Controllers\\Index";
            $controller = new $class();
            $controller->index();
        }
    }

    /**
     * Mendapatkan request URI untuk Nginx
     */
    private function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);

        // Hilangkan nama folder project dari URL
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        if ($basePath !== '/' && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        return trim($uri, '/');
    }
}
