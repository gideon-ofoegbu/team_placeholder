<?php
include_once 'core.php';

class Portfolio{
    // database connection
    public $conn;

    // object properties should only be fields on object table
    public $portfolio_id;
    public $category;
    public $amount_invest;
    public $session_id;
    
    // constructor with $conn as database connection
    public function __construct($db){
      $this->conn = $db;
    }

    public function getList(){
        $Core = new Core();
         if($Core->isActive($this->session_id)){
             $query = $this->conn->prepare("SELECT portfolio_id, portfolio_name, increate_rate, amount_range, duration
             FROM portfolio");
             $query->execute();
             $result = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
         }else{
             return null;
         }
    }
    
    public function acquire(){
      $Core = new Core();
      //return $this->session_id;
      if($Core->isActive($this->session_id)){
        $user_id = $Core->getUserID($this->session_id);
        
        $status = "active";
        $txn_type = "debit";
        $amount_earn = 0;
        $query = $this->conn->prepare("INSERT INTO `acquired_portfolio` (`portfolio_id`, `user_id`, `category`, `amount_invest`, `amount_earn`, `status`) VALUES (:portfolio_id,:user_id,:category,:amount_invest,:amount_earn,:status)");
        // bind query param
        $query->bindParam("portfolio_id", $this->portfolio_id, PDO::PARAM_INT);
        $query->bindParam("user_id", $user_id, PDO::PARAM_INT);
        $query->bindParam("category", $this->category, PDO::PARAM_STR);
        $query->bindParam("amount_invest", $this->amount_invest, PDO::PARAM_INT);
        $query->bindParam("amount_earn", $amount_earn, PDO::PARAM_INT);
        $query->bindParam("status", $status, PDO::PARAM_STR);
        $query->execute();

        $query = $this->conn->prepare("INSERT INTO wallet(user_id,amount,type) VALUES(:user_id,:amount,:type)");
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->bindParam("amount", $this->amount_invest, PDO::PARAM_STR);
        $query->bindParam("type", $txn_type, PDO::PARAM_STR);
        
        $query->execute();

        $log = $Core->logAction($user_id, "Portfolio acquired", "Acquire portfolio");
        
        $data = array('wallet' => $Core->walletBalance($user_id));

        return $data;

      }else{
        return false;
      }
    }
    
    
    


}

?>