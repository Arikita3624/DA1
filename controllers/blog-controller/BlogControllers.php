<?php

class BlogControllers{
    public function index(){
        global $content;
        $content = "views/pages/blog/Blog.php";
        require_once "./views/layouts/main.php";
    }
}

class BlogDetailController {
    public function index() {
        global $content;
        $content = "views/pages/blog/BlogDetail.php";
        require_once "./views/layouts/main.php";
    }
}




?>