<?php
session_start();
require_once('../../system/config.php');
if(isset($_SESSION['user_id'])) {    
    $url = $basepath . 'admin/';
    header('Location: ' . $url);
    session_destroy();
}