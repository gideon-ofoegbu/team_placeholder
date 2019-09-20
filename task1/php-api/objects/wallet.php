<?php
include_once 'core.php';

class Wallet{
    // database connection
    public $conn;

    // object properties should only be fields on object table
    public $txn_ref;
    public $txn_status;
    public $amount;
    public $currency;
    public $channel;
    public $ipaddress;
    public $last4;
    public $bank;
    public $gate_response;
    public $session_id;
    
    // constructor with $conn as database connection
    public function __construct($db){
      $this->conn = $db;
    }

    public function fundWallet(){
      $Core = new Core();
      if($Core->isActive($this->session_id)){
        $user_id = $Core->getUserID($this->session_id);
        $type = "credit";
        $query = $this->conn->prepare("INSERT INTO transactions(user_id, txn_ref, txn_status, amount, currency, channel, ipaddress, last4, bank, gateway_response, type) VALUES(:uid,:txn_ref,:txn_status,:amount,:currency,:channel,:ipaddress,:last4,:bank,:gateway_response,:type)");
        // bind query param
        $query->bindParam("uid", $user_id, PDO::PARAM_INT);
        $query->bindParam("txn_ref", $this->txn_ref, PDO::PARAM_STR);
        $query->bindParam("txn_status", $this->txn_status, PDO::PARAM_INT);
        $query->bindParam("amount", $this->amount, PDO::PARAM_STR);
        $query->bindParam("currency", $this->currency, PDO::PARAM_STR);
        $query->bindParam("channel", $this->channel, PDO::PARAM_STR);
        $query->bindParam("ipaddress", $this->ipaddress, PDO::PARAM_STR);
        $query->bindParam("last4", $this->last4, PDO::PARAM_STR);
        $query->bindParam("bank", $this->bank, PDO::PARAM_STR);
        $query->bindParam("gateway_response", $this->gateway_response, PDO::PARAM_STR);
        $query->bindParam("type", $type, PDO::PARAM_STR);
        $query->execute();

        $query = $this->conn->prepare("INSERT INTO wallet(user_id,amount,type) VALUES(:user_id,:amount,:type)");
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->bindParam("amount", $this->amount, PDO::PARAM_STR);
        $query->bindParam("type", $type, PDO::PARAM_STR);
        $query->execute();

        $log = $Core->logAction($user_id, "User fund wallet", "Fund wallet");
        
        $data = array('wallet' => $Core->walletBalance($user_id));

        return $res = array("status"=> "success", "message"=> "Wallet successfully funded", "data"=> $data);
      }
    }
    
    public function walletBalance(){
      $Core = new Core();
      if($Core->isActive($this->session_id)){
            $user_id = $Core->getUserID($this->session_id);
            $data = array('wallet' => $Core->walletBalance($user_id));

            return $res = array("status"=> "success", "message"=> "Wallet balance fetched", "data"=> $data);

      }else{
        return 4;
      }
    }


    



}

?>