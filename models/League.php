<?php

    class League{
        //db stuff
        private $conn;

        // set league table &  properties
        private $table  = 'league';

        public $id;
        public $league_name;
        public $createdby;
        public $createddt;
        public $location;

        //contruc the db contructor
        public function __construct($db){
            $this->conn=$db;
        }

        // create league function
        public function create(){
            $query = "INSERT INTO " . $this->table .
                ' SET league_name   = :league_name,'.
                    ' createdby     = :createdby,'.
                    ' createddt     = :createddt,'.
                    ' location      = :location';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->league_name  = htmlspecialchars(strip_tags($this->league_name));
            $this->createdby    = htmlspecialchars(strip_tags($this->createdby));
            $this->createddt    = htmlspecialchars(strip_tags($this->createddt));
            $this->location     = htmlspecialchars(strip_tags($this->location));

            //bind parameter
            $stmt->bindParam(':league_name' ,$this->league_name); 
            $stmt->bindParam(':createdby'   ,$this->createdby);
            $stmt->bindParam(':createddt'   ,$this->createddt);
            $stmt->bindParam(':location'    ,$this->location);

            // execute stmt
            if ( $stmt->execute() ){
                return true;
            }
            printf("Error %s. \n", $stmt->error);
            return false;
        }

        // update league function
        public function update(){
            $query =' UPDATE ' . $this->table .
                    ' SET league_name = :league_name,'.
                    '   createdby   = :createdby,'.
                    '   createddt   = :createddt,'.
                    '   location    = :location
                    WHERE id=:id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->league_name  = htmlspecialchars(strip_tags($this->league_name));
            $this->createdby    = htmlspecialchars(strip_tags($this->createdby));
            $this->createddt    = htmlspecialchars(strip_tags($this->createddt));
            $this->location     = htmlspecialchars(strip_tags($this->location));
            $this->id           = htmlspecialchars(strip_tags($this->id));

            //bind parameter
            $stmt->bindParam(':league_name',$this->league_name); 
            $stmt->bindParam(':createdby',$this->createdby);
            $stmt->bindParam(':createddt',$this->createddt);
            $stmt->bindParam(':location',$this->location);
            $stmt->bindParam(':id',$this->id);

            // execute stmt
            if ($stmt->execute()){
                return true;
            }
            printf("Error %s. \n", $stmt->error);
            return false;
        }

        //list details of  leagues
        public function getAll(){
            $query ='SELECT 
            l.id,
            l.league_name,
            l.createdby,
            l.createddt,
            l.location
            FROM ' . $this->table . ' l
            ORDER BY l.createddt , l.createdby
            DESC';
            // Prepare stmt 
            $stmt =$this->conn->prepare($query);
            
            // execute stmt
            $stmt->execute();

            return $stmt;
        }

        //list a specific member of a league
        public function getLeague(){
            $query ='SELECT 
            l.id,
            l.league_name,
            l.createdby,
            l.createddt,
            l.location
            FROM ' . $this->table . ' l
            WHERE 
                 l.id = ? LIMIT 6';

            // Prepare stmt 
            $stmt = $this->conn->prepare($query);

            //Bind the parameter
            $stmt->bindParam(1,$this->id);

            // execute stmt
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id= $row['id'];
            $this->league_name= $row['league_name'];
            $this->createdby= $row['createdby'];
            $this->createddt= $row['createddt'];
            $this->location= $row['location'];

        }         
}

?>