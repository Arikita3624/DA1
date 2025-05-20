<?php

class DashboardController {
    public function index() {
        global $content_admin;
        $content_admin = '../admin/views/dashboard.php';
        require_once "../admin/views/layouts/main_admin.php";
    }
}