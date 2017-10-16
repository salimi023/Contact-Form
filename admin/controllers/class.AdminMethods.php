<?php
class AdminMethods extends MessageData {
    public $dbc = null;
    public $mdat = null;
    public $msgdat = null;    
    public $error = null;
    public $success = null;
    public $amdat = null;                
    public function __construct() { 
        // Connecting to database                
        require_once('../system/class.Dbc.php');
        $con = new Dbc;
        $this->dbc = $con->db;
        return $this->dbc;        
    }
    public function messageData($stat1, $stat2) { // Querrying messages from db
        $this->mdat = $this->dbc->query("SELECT * FROM form WHERE stat = '$stat1' OR stat = '$stat2' ORDER BY received DESC");
        $this->mdat->setFetchMode(PDO::FETCH_CLASS, 'MessageData');
        return $this->mdat;        
    }
    public function getMessage() { // Getting the data of selected message
        $this->msgdat = $this->dbc->query("SELECT * FROM form WHERE msg_id = '$this->msg_id' LIMIT 1");
        $this->msgdat->setFetchMode(PDO::FETCH_CLASS, 'MessageData');        
        return $this->msgdat;
    }
    public function setResData() { // Setting response data
        parent::setResSubject(strip_tags(trim($_POST['subject'])));
        parent::setResText(strip_tags(trim($_POST['text'])));
        parent::setResSent();
    }
    public function checkResFields() { // Checking obligatory fields
        $res_fields = [
            'subject' => $this->res_subject,
            'text' => $this->res_text
        ];
        foreach($res_fields as $key => $value) {
            if(empty($value)) {
                $this->error = "<div id=\"error\" class=\"alert alert-danger\" role=\"alert\">You've forgotten the {$key}! Please feel it in!</div>";
                return $this->error;                 
            }
        }
    }
    public function sendResponse() { // Sending the response
        $q = $this->dbc->query("SELECT email FROM form WHERE msg_id = '$this->msg_id' LIMIT 1");
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();
        $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers .= "From: Your website" . "\r\n"; 
		$subject = $this->res_subject;
		$subject = "=?UTF-8?B?" . base64_encode($subject) . "?="; //Freemail subject line encoding 
		$msg = $this->res_text;                                    		
		mail($row['email'], $subject, $msg, $headers);                                                   
        $this->success = '<div class="alert alert-success" role="alert"><h4>Your response has been sent!</h4></div>';        
        return $this->success;
    }
    public function saveResponse() { // Saving response to database
        $q = $this->dbc->prepare("UPDATE form SET stat = ?, res_subject = ?, res_text = ?, res_sent = ? WHERE msg_id = '$this->msg_id'");
        $q->execute(array('2', $this->res_subject, $this->res_text, $this->res_sent));
    }
    public function deleteMessage($id) { // Deleting messages
        $q = $this->dbc->prepare("DELETE FROM form WHERE msg_id = ? LIMIT 1");
        $q->execute(array($id));        
    }    
    public function archiveMessage($id) { // Archiving messages        
        $q = $this->dbc->query("SELECT res_sent FROM form WHERE msg_id = '$id'");
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();          
        if(empty($row['res_sent'])) {
            $q2 = $this->dbc->prepare("UPDATE form SET stat = '3' WHERE msg_id = ?");
            $q2->execute(array($id));
        }
        else {
            $q3 = $this->dbc->prepare("UPDATE form SET stat = '4' WHERE msg_id = ?");
            $q3->execute(array($id));
        }
    }    
    public function activateArchivedMessage($id) { // Activating archived messages
        $q = $this->dbc->query("SELECT res_sent FROM form WHERE msg_id = '$id'");
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();               
        if(empty($row['res_sent'])) {
            $q2 = $this->dbc->prepare("UPDATE form SET stat = '1' WHERE msg_id = ?");
            $q2->execute(array($id));
        }
        else {
            $q3 = $this->dbc->prepare("UPDATE form SET stat = '2' WHERE msg_id = ?");
            $q3->execute(array($id));
        }
    }    
}