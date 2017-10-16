<?php
//Autoloader
function class_loader($class) {
    require_once('class.' . $class . '.php');
}
spl_autoload_register('class_loader');
?>