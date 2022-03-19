<?php
    class Predict{
        //db stuff
        private $conn;

        // set league table &  properties
        private $table  = 'prediction';

        public $id;
        public $league_id;
        public $user_id;
        public $prediction;
        public $p_exact_score; 
        public $l_exact_score;
        public $l_match_result;
        public $l_win_team;
               

        //contruc the db contructor
        public function __construct($db){
            $this->conn=$db;
        }
        
        private function isExist(){
            $query ='SELECT count(1) AS num FROM ' . $this->table . 
                    ' WHERE user_id = :user_id And league_id = :league_id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->user_id   = htmlspecialchars(strip_tags($this->user_id));
            $this->league_id = htmlspecialchars(strip_tags($this->league_id));

            //bind parameter 
            $stmt->bindParam(':user_id'  ,$this->user_id); 
            $stmt->bindParam(':league_id',$this->league_id);  
            
            // execute stmt
            if ( $stmt->execute() ){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
               // echo("row = ".$row);
                if ($row['num'] < 1 ) {
                    return true;
                }
            }
            printf("Error %s. \n", $stmt->error);
            return false;
        }

        // create prediction function
        public function create(){
            if ($this->isExist()) {
                    $query ='INSERT INTO ' . $this->table .
                    ' SET user_id   = :user_id,'.
                    ' league_id     = :league_id,'.
                    ' prediction    = :prediction,'.
                    ' p_exact_score = :p_exact_score';

                // prepare statement
                $stmt = $this->conn->prepare($query);

                // clean data
                $this->user_id       = htmlspecialchars(strip_tags($this->user_id));
                $this->league_id     = htmlspecialchars(strip_tags($this->league_id));
                $this->prediction    = htmlspecialchars(strip_tags($this->prediction));
                $this->p_exact_score = htmlspecialchars(strip_tags($this->p_exact_score));                     

                //bind parameter
                $stmt->bindParam(':user_id'      ,$this->user_id); 
                $stmt->bindParam(':league_id'    ,$this->league_id);
                $stmt->bindParam(':prediction'   ,$this->prediction);
                $stmt->bindParam(':p_exact_score',$this->p_exact_score);                    

                // execute stmt
                if ( $stmt->execute() ){
                    return true;
                }
                printf("Error %s. \n", $stmt->error);
                return false;
            }
            printf("Error %s Already predict in league %s. \n", $this->user_id,$this->league_id);
        }
        
        //Update
        public function update(){
            $query = "UPDATE " . $this->table .
                ' SET  l_exact_score   = :l_match_result,'.                   
                ' l_match_result       = :l_match_result,'.
                ' l_win_team           = :l_win_team
                WHERE id=:id' ;

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->l_match_result= htmlspecialchars(strip_tags($this->l_match_result));
            $this->l_win_team= htmlspecialchars(strip_tags($this->l_win_team));
            $this->l_win_team= htmlspecialchars(strip_tags($this->id));


            //bind parameter 
            $stmt->bindParam(':l_match_result',$this->l_match_result);
            $stmt->bindParam(':l_win_team',$this->l_win_team);
            $stmt->bindParam(':id',$this->id);

            // execute stmt
            if ( $stmt->execute() ){
                return true;
            }
            printf("Error %s. \n", $stmt->error);
            return false;
        }
      
    }
?>