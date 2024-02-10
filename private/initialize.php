<?php
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("ADMIN_PATH", PROJECT_PATH . "/admin");



$public_end = strpos($_SERVER['SCRIPT_NAME'], '/') + 9;
$doc_root = substr($_SERVER['SCRIPT_NAME'],0,$public_end);
define('ROOT_PATH',$doc_root);
?>