<?php
require_once('../helpers/sessionstart.php');
require_once('../../system/config.php');
require_once('../../model/class.MessageData.php');
require_once('../helpers/autoloader.php');
error_reporting();
$read = new AdminMethods;
if(isset($_GET['id'])) { // Selecting message
    $read->setMsgId($_GET['id']);
    $read->getMessage();    
}
if(isset($_POST['send'])) { // Sending and saving response
    $read->setResData();
    $read->checkResFields();
    if(empty($read->error)) {
        $read->sendResponse();
        $read->saveResponse();
        echo $read->success;
    }
    else {
        echo $read->error;
    }    
}
require_once('../views/templates/header.html');
require_once('../views/pages/read.html');
require_once('../views/templates/footer.html');
unset($read);