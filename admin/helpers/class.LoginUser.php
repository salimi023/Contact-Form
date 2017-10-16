<?php
class LoginUser extends UserData {
    protected $dbc = null;
    public $ulogin = null;
    public $upassw = null;
    public $udata = null;
    public function __construct() { // Database connection
        require_once('system/class.Dbc.php');
        $con = new Dbc;
        $this->dbc = $con->db;
    }
    public function setLoginData() {
        parent::setLogin(strip_tags(trim($_POST['name'])));
        parent::setPass(strip_tags(trim($_POST['pass'])));
    }
    public function checkFields() {
        $fields = [
            'Login name' => $this->login,
            'Password' => $this->pass
        ];
        foreach($fields AS $key => $value) {
            if(empty($value)) {
                throw new Exception("<div class=\"alert alert-danger\" role=\"alert\">Please fill in the {$key} field!</div>");
            }
        }
    } 
    public function getUserData() {
        // Fetching user data by login name
        $q = $this->dbc->query("SELECT user_id, name, login, pass FROM users WHERE login = '$this->login'");
        $q->setFetchMode(PDO::FETCH_CLASS, 'UserData');
        $this->ulogin = $q->fetch();
        return $this->ulogin;              
    }
}