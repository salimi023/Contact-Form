<?php
$day = strtolower(date('l'));
$code = strip_tags(trim(strtolower($_POST['day'])));
if($day === $code) {
    echo 'okay';
}