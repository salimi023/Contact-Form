<?php
ob_start();
error_reporting();
session_start();
require_once('../model/class.UserData.php');
require_once('helpers/class.LoginUser.php');
require_once('../system/config.php');
require_once('views/templates/header.html');
error_reporting(0);
$user = new LoginUser;
if(!isset($_SESSION['user_id'])) {
if(isset($_POST['login'])) {
    try {
        $user->setLoginData();        
        $user->checkFields();
        $user->getUserData();
        if(!empty($user->ulogin)) {
            if(password_verify($user->pass, $user->ulogin->getPass())) {
                $_SESSION['user_id'] = $user->ulogin->getUserId();
                $_SESSION['name'] = $user->ulogin->getName();
                $url = $basepath . 'admin/controllers/messages.php';
                header('Location: ' . $url);
            }
            else {
                throw new Exception('<div class="alert alert-danger" role="alert">Incorrect Password!</div>');
            }
        }
        else {
            throw new Exception('<div class="alert alert-danger" role="alert">Incorrect Login name!</div>');
        }
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }
}
}
require_once('views/pages/login.html');
require_once('views/templates/footer.html');
unset($user);
ob_end_flush();