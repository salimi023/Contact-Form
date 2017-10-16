<?php
class SearchMethods extends MessageData {
    protected $dbc = null;
    public $file = null;
    public $result = null;
    public $id = [];
    protected $res = null;        
    public function __construct() { // Connecting to database
        require_once('../system/class.Dbc.php');
        $con = new Dbc;
        $this->dbc = $con->db;
        return $this->dbc;
    }
    public function getNameList($list1, $list2) { // Getting list of names for search field
        $q = $this->dbc->query("SELECT name FROM form WHERE stat = '$list1' OR stat = '$list2' ORDER BY name ASC");
        $q->setFetchMode(PDO::FETCH_CLASS, 'MessageData');        
        while($arr = $q->fetch()) {
            $arr2[] = $arr->getName();
        }
        $un = array_unique($arr2);
        foreach($un as $value) {
            echo "<option>{$value}</option>";
        }       
    }    
    public function getEmailList($list1, $list2) { // Getting list of emalis for search field
        $q = $this->dbc->query("SELECT email FROM form WHERE stat = '$list1' OR stat = '$list2' ORDER BY email ASC");
        $q->setFetchMode(PDO::FETCH_CLASS, 'MessageData');        
        while($arr = $q->fetch()) {
            $arr2[] = $arr->getEmail();
        }
        $un = array_unique($arr2);
        foreach($un as $value) {
            echo "<option>{$value}</option>";
        }       
    }     
    public function getFileName() { // Getting filenames from URLs
        $uri = $_SERVER['REQUEST_URI'];
        $path = pathinfo($uri);
        $this->file = $path['filename'];
        return $this->file;
    }
    public function setSearchData() { // Setting search data from form
        parent::setName(strip_tags(trim($_POST['name'])));
        parent::setEmail(strip_tags(trim($_POST['email'])));
        parent::setStat(strip_tags(trim($_POST['status'])));
        parent::setDate(strip_tags(trim($_POST['date'])));
    }    

    // Searching based on name

    public function searchByNameStatusDate($name, $status, $date) { // Searching by name, status and date              
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE name = ? AND stat = ? AND received = ?");
            $this->result->execute(array($name, $status, $date));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;                    
    }
    public function searchByName($name) { // Searching by name        
        if($this->file === 'messages') {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE name = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($name, '1', '2'));            
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
        else {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE name = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($name, '3', '4'));            
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
    }
    public function searchByNameStatus($name, $status) { // Searching by name and status
        $this->result = $this->dbc->prepare("SELECT * FROM form WHERE name = ? AND stat = ?");
        $this->result->execute(array($name, $status));
        $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
        return $this->result;
    }
    public function searchByNameDate($name, $date) { // Searching by name and date
        if($this->file === 'messages') {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE name = ? AND received = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($name, $date, '1', '2'));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
        else {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE name = ? AND received = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($name, $date, '3', '4'));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
    }

    // Searching based on email

    public function searchByEmailStatusDate($email, $status, $date) { // Searching by email, status and date              
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE email = ? AND stat = ? AND received = ?");
            $this->result->execute(array($email, $status, $date));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;                    
    }
    public function searchByEmail($email) { // Searching by e-mail        
        if($this->file === 'messages') {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE email = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($email, '1', '2'));            
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
        else {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE email = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($email, '3', '4'));            
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
    }
    public function searchByEmailStatus($email, $status) { // Searching by e-mail and status
        $this->result = $this->dbc->prepare("SELECT * FROM form WHERE email = ? AND stat = ?");
        $this->result->execute(array($email, $status));
        $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
        return $this->result;
    }
    public function searchByEmailDate($email, $date) { // Searching by e-mail and date
        if($this->file === 'messages') {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE email = ? AND received = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($email, $date, '1', '2'));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
        else {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE email = ? AND received = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($email, $date, '3', '4'));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
    }

    // Search by date

    public function searchByDate($date) { // Searching by date
        if($this->file === 'messages') {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE received = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($date, '1', '2'));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
        else {
            $this->result = $this->dbc->prepare("SELECT * FROM form WHERE received = ? AND (stat = ? OR stat = ?)");
            $this->result->execute(array($date, '3', '4'));
            $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
            return $this->result;
        }
    }

    // Search by status

    public function searchByStatus($status) { // Searching by status        
        $this->result = $this->dbc->prepare("SELECT * FROM form WHERE stat = ?");
        $this->result->execute(array($this->stat));
        $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
        return $this->result;
    }

    // Search by status and date

    public function searchByDateStatus($status, $date) { // Searching by status and date        
        $this->result = $this->dbc->prepare("SELECT * FROM form WHERE received = ? AND stat = ?");
        $this->result->execute(array($date, $this->stat));
        $this->result->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
        return $this->result;
    }

    // ACTIONS ON SEARCH RESULTS 
    
    public function deleteResults($id) { // Delete all search results
        $q = $this->dbc->prepare("DELETE FROM form WHERE msg_id = ?");
        $q->execute(array($id));        
    }    

    protected function queryResults($id) { // Getting data for archivating and activating actions
        $q = $this->dbc->query("SELECT stat FROM form WHERE msg_id = '$id'");
        $q->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
        $this->res = $q->fetch();
    }

    public function archiveResults($arch) { // Archivating search results
        self::queryResults($arch);        
        switch($this->res->getStat()) {
            case '1':
            $this->dbc->query("UPDATE form SET stat = '3' WHERE msg_id = '$arch'");
            break;
            case '2':
            $this->dbc->query("UPDATE form SET stat = '4' WHERE msg_id = '$arch'");
            break;
        }
    }

    public function activateResults($act) { // Activating search results
        self::queryResults($act);
        switch($this->res->getStat()) {
            case '3':
            $this->dbc->query("UPDATE form SET stat = '1' WHERE msg_id = '$act'");
            break;
            case '4':
            $this->dbc->query("UPDATE form SET stat = '2' WHERE msg_id = '$act'");
            break;
        }
    }        
} 