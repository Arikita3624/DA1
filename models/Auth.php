<?php

class Auth {
    public function checkLogin() {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
}


?>