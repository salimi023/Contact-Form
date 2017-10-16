<?php
require_once('../../model/class.MessageData.php');
require_once('../controllers/class.AdminMethods.php');
$arch = new AdminMethods;
if(isset($_POST['id'])) { // Archivating message 
    $arch->archiveMessage($_POST['id']);
    echo 'okay';
}
unset($arch);