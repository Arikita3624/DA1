<?php
require_once("./views/header_footer/Header.php");

global $content;

if (!empty($content) && file_exists($content)) {
    require_once $content;
} else {
    die("Error: Content file '$content' not found.");
}

require_once("./views/header_footer/Footer.php");
?>