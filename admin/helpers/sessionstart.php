<?php
session_start();
require_once('../../system/config.php');
if(!isset($_SESSION['user_id'])) {
    $home_url = $basepath . 'admin/';
    header('Location: ' . $home_url);
    exit();
}