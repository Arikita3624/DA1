<?php

class SignInController {
    public function index() {
        global $content;
        $content = "views/pages/auth/SignIn.php";
        require_once "./views/layouts/main.php";
    }
}

class SignUpController {
    public function index() {
        global $content;
        $content = "views/pages/auth/SignUp.php";
        require_once "./views/layouts/main.php";
    }
}

?>