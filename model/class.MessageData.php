<?php
class MessageData {
    
    // Frontend vars
    public $msg_id = null;
    public $name = null;
    public $email = null;
    public $phone = null;
    public $message = null;
    public $received = null;
    public $stat = null;
    
    // Backend admin vars (If you don't need backend admin just delete them.)
    public $res_subject = null;
    public $res_text = null;
    public $res_sent = null;
    public $date = null;

    // Frontend functions    
    public function getMsgId() {
        return $this->msg_id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getMessage() {
        return $this->message;
    }
    public function getReceived() {
        return $this->received;
    }
    public function getStat() {
        return $this->stat;
    }
    public function setName($name) {
        $this->name = $name;
        return $this->name;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this->email;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this->phone;
    }
    public function setMessage($message) {
        $this->message = $message;
        return $this->message;
    }
    public function setReceived() {
        $this->received = date('Y-m-d H:i:s');
        return $this->received;
    }    
    
    // Backend admin functions (If you don't need backend admin just delete them!)
    public function getResSubject() {
        return $this->res_subject;
    }
    public function getResText() {
        return $this->res_text;
    }
    public function getResSent() {
        return $this->res_sent;
    }
    public function setMsgId($msg_id) {
        $this->msg_id = $msg_id;
        return $this->msg_id;
    }
    public function setResSubject($res_subject) {
        $this->res_subject = $res_subject;
        return $this->res_subject;
    }
    public function setResText($res_text) {
        $this->res_text = $res_text;
        return $this->res_text;
    }
    public function setResSent() {
        $this->res_sent = date('Y-m-d H:i:s');
        return $this->res_sent;
    }
    public function setStat($cond) {
        switch($cond) {
            case 'Not Responded':
            $this->stat = 1;
            break;
            case 'Responded':
            $this->stat = 2;
            break;
            case 'Not Responded - Arch':
            $this->stat = 3;
            break;
            case 'Responded - Arch':
            $this->stat = 4;
            break;
            default:
            $this->stat = '';
            break;
        }
        return $this->stat;
    }
    public function setDate($date) {
        $this->date = $date;
        return $this->date;
    }
}