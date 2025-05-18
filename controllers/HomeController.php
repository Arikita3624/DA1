<?php
    $content = "views/pages/HomePage.php";
class HomeController
{
    public function index() {
        global $content;
        $content = "views/pages/HomePage.php";
        require_once "./views/layouts/main.php";

    }
}

?>