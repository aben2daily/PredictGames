<?php 

    class Member {
        //db stuff
        private $conn;
        
        // Member table & properties
        private $table      = 'members';

        public $id;
        public $league_id;
        public $user_id;
        public $joindt;        
        public $point;

        //contruc the db contructor
        public function __construct($db){
            $this->conn=$db;
        }
     
        //list members of a league
        public function getAll(){
            $query ='SELECT 
            l.league_name as leaguename,
            m.id,
            m.user_id,
            m.joindt,
            m.league_id,
            m.point
            FROM ' . $this->table . ' m
            LEFT JOIN  
                league l ON m.league_id = l.id
            ORDER BY m.joindt 
            DESC';
            // Prepare stmt 
            $stmt =$this->conn->prepare($query);
            
            // execute stmt
            $stmt->execute();

            return $stmt;
        }

        //list a specific member of a league
        public function getMember(){
            $query ='SELECT 
            l.league_name as leaguename,
            m.id,
            m.user_id,
            m.joindt,
            m.league_id,
            m.point
            FROM ' . $this->table . ' m
            LEFT JOIN 
                league l ON m.league_id = l.id
                where m.id = ? LIMIT 6';

            // Prepare stmt 
            $stmt = $this->conn->prepare($query);

            //Bind the parameter
            $stmt->bindParam(1,$this->id);

            // execute stmt
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->league_id= $row['league_id'];
            $this->leaguename= $row['leaguename'];
            $this->user_id= $row['user_id'];
            $this->joindt= $row['joindt'];
            $this->point= $row['point'];

        } 

        
        // add member to league
        public function addMember(){
            $query = "INSERT INTO " . $this->table .
                ' SET league_id = :league_id,'.
                    ' user_id = :user_id,'.
                    ' joindt = :joindt,'.
                    ' point = :point';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->league_id= htmlspecialchars(strip_tags($this->league_id));
            $this->user_id= htmlspecialchars(strip_tags($this->user_id));
            $this->joindt= htmlspecialchars(strip_tags($this->joindt));
            $this->point= htmlspecialchars(strip_tags($this->point));

            //bind parameter
            $stmt->bindParam(':league_id',$this->league_id); 
            $stmt->bindParam(':user_id',$this->user_id);
            $stmt->bindParam(':joindt',$this->joindt);
            $stmt->bindParam(':point',$this->point);

            // execute stmt
            if ( $stmt->execute() ){
                return true;
            }
            printf("Error %s. \n", $stmt->error);
            return false;
        }

        // update league function
        public function updateMember(){
            $query = "UPDATE " . $this->table .
                ' SET league_id = :league_id,'.
                    ' user_id = :user_id,'.
                    ' joindt = :joindt,'.
                    ' point = :point
                WHERE id=:id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->league_id= htmlspecialchars(strip_tags($this->league_id));
            $this->user_id= htmlspecialchars(strip_tags($this->user_id));
            $this->joindt= htmlspecialchars(strip_tags($this->joindt));
            $this->point= htmlspecialchars(strip_tags($this->point));
            $this->id= htmlspecialchars(strip_tags($this->id));

            //bind parameter
            $stmt->bindParam(':league_id',$this->league_id); 
            $stmt->bindParam(':user_id',$this->user_id);
            $stmt->bindParam(':joindt',$this->joindt);
            $stmt->bindParam(':point',$this->point);
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
