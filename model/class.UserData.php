<?php

// User Login data (if you don't need backend admin just delete the file)

class UserData {
    public $user_id = null;
    public $name = null;
    public $login = null;
    public $pass = null;
    public function getUserId() {
        return $this->user_id;
    }
    public function getName() {
        return $this->name;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getPass() {
        return $this->pass;
    }
    public function setLogin($login) {
        $this->login = $login;
        return $this->login;
    }
    public function setPass($pass) {
        $this->pass = $pass;
        return $this->pass;
    }
}