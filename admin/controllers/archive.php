<?php
require_once('../helpers/sessionstart.php');
require_once('../../system/config.php');
require_once('../views/templates/header.html');
require_once('../../model/class.MessageData.php');
require_once('../helpers/autoloader.php');
error_reporting();
$i = 1;
$arch = new AdminMethods;
$search = new SearchMethods;
$arch->messageData('3', '4');
$_SESSION['file'] = $search->getFileName();
require_once('../views/pages/archive.html');
require_once('../views/templates/footer.html');
unset($arch, $search);