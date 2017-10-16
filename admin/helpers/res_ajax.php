<?php
require_once('../system/class.Dbc.php');
require_once('../../model/class.MessageData.php');
$con = new Dbc;
$data = new MessageData;
$id = $_POST['msg_id'];
$stat = $_POST['stat'];
$q = $con->db->query("SELECT stat FROM form WHERE msg_id = '$id' LIMIT 1");
$q->setFetchMode(PDO::FETCH_ASSOC);
$row = $q->fetch();
if($row['stat'] === $stat) {
    echo 'okay';
}
unset($con, $data);