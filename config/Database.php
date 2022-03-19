<?php


class Database{
 // local test
    private $db_host= 'localhost';
    private $db_name= 'prediction';
    private $db_port='3307';
    private $username= 'prediction';
    private $password= 'Pr3dictpass';
/*
    //Remote connection
    private $rdb_host= '139.162.233.84';
    private $rdb_name= 'predition_league_db';
    //private $db_port='3307';
    private $rusername= 'payday_test_user';
    private $rpassword= 'Pa7&*uy@m%$#2($Jk';   
*/
    private $conn;

    public function connect (){
        $this->conn=null;

        try{
           //$this->conn = new PDO('mysql:host='.$this->db_host.'; port='.$this->db_port.' ;dbname='.$this->db_name, $this->username,$this->password);
            $this->conn = new PDO('mysql:host='.$this->rdb_host.' ;dbname='.$this->rdb_name, $this->rusername,$this->rpassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e){
                echo 'Connection error '. $e->getMessage();

            }
        return $this->conn;
    }

}
 

?>