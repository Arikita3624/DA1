<?php

class ContactController {
    public function index() {
        global $content;
        $content = "views/pages/contact/Contact.php";
        require_once "./views/layouts/main.php";
    }
}


?>