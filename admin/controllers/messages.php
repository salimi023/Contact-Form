<?php
require_once('../helpers/sessionstart.php');
require_once('../../model/class.MessageData.php');
require_once('../helpers/autoloader.php');
require_once('../../system/config.php');
require_once('../views/templates/header.html');
error_reporting();
$i = 1;
$list = new AdminMethods;
$search = new SearchMethods;
$list->messageData('1', '2');
$_SESSION['file'] = $search->getFileName();
require_once('../views/pages/messages.html');
require_once('../views/templates/footer.html');
unset($list, $search);