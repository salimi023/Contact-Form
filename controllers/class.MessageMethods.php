<?php
class MessageMethods extends MessageData { // Methods of processing data captured by the form.html
    public $dbc = null;
    protected $privacy = null;    
    public $code = null;
    protected $day = null;
    public $link = null;
    public $success = null;
    public $error = null;
        
    public function __construct() { 
        // Connecting to database
        $this->link = 'admin/system/class.Dbc.php';
        if(file_exists($this->link)) {                
        require_once($this->link);
        $con = new Dbc;
        $this->dbc = $con->db;
        }
        // Determining current day for CAPTCHA validation        
        $this->day = strtolower(date('l'));
        return $this->day;
    }
    public function setMessageData() { // Writing data captured by the form into variables (model/class.MessageData.php)
        parent::setName(strip_tags(trim($_POST['name'])));
        parent::setEmail(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        parent::setPhone(strip_tags(trim($_POST['phone'])));
        parent::setMessage(strip_tags(trim($_POST['message'])));
        $this->privacy = $_POST['privacy'];
        $this->code = strip_tags(trim(strtolower($_POST['code'])));
        parent::setReceived();
    }
    public function checkFormFields() { // Checking the obligatory form fields        
        $fields = [
            'Name' => $this->name,
            'E-mail' => $this->email,
            'Message' => $this->message,
            'Privacy policy' => $this->privacy,
            'Security question' => $this->code
        ];
        foreach($fields AS $key => $value) {
            if(empty($value)) {
                $this->error = "<div class=\"alert alert-danger\" role=\"alert\">Error! Please feel in the missing field: {$key}!</div>";
                return $this->error;
            }
        }
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) { // E-mail address validation
            $this->error = '<div class="alert alert-danger" role="alert">Please enter a valied e-mail address!</div>';
            return $this->error;
        }
        if($this->code !== $this->day) { // Validation of CAPTCHA on serverside
            $this->error = '<div class="alert alert-danger" role="alert">The answer to the Security Question is incorrect!</div>';
            return $this->error;
        } 
    }    
    public function sendMessage($email, $subject) { // Sending the message
        $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers .= "From: Your website" . "\r\n"; 		
		// $subject = "=?UTF-8?B?" . base64_encode($subject) . "?="; //Freemail.hu subject line encoding 
		$msg = "Text of message:<br /><br /><strong>Sender:</strong> {$this->name}<br /><strong>E-mail address:</strong> {$this->email}<br /><strong>Telephone:</strong> {$this->phone}<br /><br /><strong>Message:</strong><br />{$this->message}<br /><br />Date of sending: {$this->received}";                                    		
		mail($email, $subject, $msg, $headers);                                                   
        $this->success = '<div class="alert alert-success" role="alert"><h4>Your message has been sent! Thank you!</h4></div>';        
        return $this->success;
    }
    public function saveMessage() { // Saving the message into database
        $q = $this->dbc->prepare("INSERT INTO form (name, email, phone, message, received) VALUES (?, ?, ?, ?, ?)");
        $q->execute(array($this->name, $this->email, $this->phone, $this->message, $this->received));
    }
}    