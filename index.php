<?php
error_reporting(0);
require_once('model/class.MessageData.php');
require_once('controllers/class.MessageMethods.php');
require_once('system/config.php');
$msg = new MessageMethods;
if(isset($_POST['send'])) {
    $msg->setMessageData();
    $msg->checkFormFields();
    if(empty($msg->error)) {
        if(empty($_POST['reg'])) {
        $msg->sendMessage($address, $subject);
        if(file_exists($msg->link)) {
        $msg->saveMessage();
        }
        echo $msg->success;
        }
    }
    else {
        echo $msg->error;
    }
}
require_once('view/form.html');
unset($msg);