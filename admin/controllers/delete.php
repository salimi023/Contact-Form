<?php
require_once('../../model/class.MessageData.php');
require_once('../helpers/autoloader.php');
$del = new AdminMethods;
if(isset($_POST['id'])) {
    $del->deleteMessage($_POST['id']);
    echo 'okay';
}