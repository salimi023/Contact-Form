<?php
require_once('../../model/class.MessageData.php');
require_once('../controllers/class.AdminMethods.php');
$act = new AdminMethods;
if(isset($_POST['id'])) {
    $act->setMsgId($_POST['id']);
    $act->activateArchivedMessage($act->msg_id);
    echo 'okay';
}
unset($act);