<?php
require_once('../helpers/sessionstart.php');
require_once('../../model/class.MessageData.php');
require_once('../helpers/autoloader.php');
require_once('../../system/config.php');
require_once('../views/templates/header.html');
error_reporting(0);
$i = 1;
$search = new SearchMethods;
$search->file = $_SESSION['file'];
if(isset($_POST['search'])) {
    try {           
        $search->setSearchData();        
        if(!empty($search->name) || !empty($search->email) || !empty($search->stat) || !empty($search->date)) { // Checking the filters       

    // Searching based on name

            if(!empty($search->name) && empty($search->email) && !empty($search->stat) && !empty($search->date)) { // Searching by name, status and date
                $search->searchByNameStatusDate($search->name, $search->stat, $search->date);
            }

            if(!empty($search->name) && empty($search->email) && empty($search->stat) && empty($search->date)) { // Searching by name
                $search->searchByName($search->name);
            }

            if(!empty($search->name) && empty($search->email) && !empty($search->stat) && empty($search->date)) { // Searching by name and status
                $search->searchByNameStatus($search->name, $search->stat);
            }

            if(!empty($search->name) && empty($search->email) && empty($search->stat) && !empty($search->date)) { // Searching by name and date
                $search->searchByNameDate($search->name, $search->date);
            }

    // Searching based on e-mail

            if(empty($search->name) && !empty($search->email) && !empty($search->stat) && !empty($search->date)) { // Searching by e-mail, status and date
                $search->searchByEmailStatusDate($search->email, $search->stat, $search->date);
            }

            if(empty($search->name) && !empty($search->email) && empty($search->stat) && empty($search->date)) { // Searching by e-mail
                $search->searchByEmail($search->email);
            }

            if(empty($search->name) && !empty($search->email) && !empty($search->stat) && empty($search->date)) { // Searching by e-mail and status
                $search->searchByEmailStatus($search->email, $search->stat);
            }

            if(empty($search->name) && !empty($search->email) && empty($search->stat) && !empty($search->date)) { // Searching by name and date
                $search->searchByEmailDate($search->email, $search->date);
            }

    // Searching by status

            if(empty($search->name) && empty($search->email) && !empty($search->stat) && empty($search->date)) {
                $search->searchByStatus($search->stat);
            }

    // Searching by date
    
            if(empty($search->name) && empty($search->email) && empty($search->stat) && !empty($search->date)) {        
                $search->searchByDate($search->date);
            }

    // Searching by status and date
    
            if(empty($search->name) && empty($search->email) && !empty($search->stat) && !empty($search->date)) {
                $search->searchByDateStatus($search->stat, $search->date);
            }            
        }
        else {
            throw new Exception('<div class="alert alert-danger" role="alert"><h3>Error!</h3>Please, pick at least one filter!</div>');
        }
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }    
}
require_once('../views/pages/searchpage.html');
if(isset($_POST['delall'])) { // Deleting all search results      
    foreach($_SESSION['res'] AS $value) {        
        $search->deleteResults($value);
    }
    header('Location: messages.php');    
}
if(isset($_POST['archall'])) { // Archivating all search results
    foreach($_SESSION['res'] AS $value) {
        $search->archiveResults($value);
    }
    header('Location: messages.php');
}
if(isset($_POST['actall'])) { // Activating all search results
    foreach($_SESSION['res'] AS $value) {
        $search->activateResults($value);
    }
    header('Location: messages.php');
}        
require_once('../views/templates/footer.html');
unset($search);