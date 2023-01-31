<?php
    class Demande{

        // conn
        private $conn;

        // table
        private $dbTable = "demande";

        // col
        public $id_dem;
        public $first_name;
        public $last_name;
        public $mat;
        public $pay;
        public $adr;
        public $tel;
        public $mail;
        public $date_deb;
        public $date_fin;
        public $date_dem;
        public $type_con;
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET demandes
        public function getDemandes(){
            $sqlQuery = "SELECT id_dem, date_deb, date_fin, date_dem,type_con,first_name,last_name,mat,pay,adr,tel,mail
               FROM " . $this->dbTable . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

       
        public function ajoutDemande(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                    date_deb = :date_deb, 
                    date_fin = :date_fin, 
                    date_dem = :type_con,
                    type_con = :type_con,
                    first_name = :first_name,
                    last_name = :last_name,
                    mat = :mat,
                    pay = :pay,
                    adr = :adr,
                    tel = :tel,
                    mail = :mail ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->date_deb=htmlspecialchars(strip_tags($this->date_deb));
            $this->date_fin=htmlspecialchars(strip_tags($this->date_fin));
            $this->date_dem=htmlspecialchars(strip_tags($this->date_dem));
            $this->type_con=htmlspecialchars(strip_tags($this->type_con));
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->mat=htmlspecialchars(strip_tags($this->mat));
            $this->pay=htmlspecialchars(strip_tags($this->pay));
            $this->adr=htmlspecialchars(strip_tags($this->adr));
            $this->tel=htmlspecialchars(strip_tags($this->tel));
            $this->mail=htmlspecialchars(strip_tags($this->mail));

            
        
                   
            // bind data
            $stmt->bindParam(":date_deb", $this->date_deb);
            $stmt->bindParam(":date_fin", $this->date_fin);
            $stmt->bindParam(":date_dem", $this->date_dem);
            $stmt->bindParam(":type_con", $this->type_con);
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":mat", $this->mat);
            $stmt->bindParam(":pay", $this->pay);
            $stmt->bindParam(":adr", $this->adr);
            $stmt->bindParam(":tel", $this->tel);
            $stmt->bindParam(":mail", $this->mail);
            

            

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

       // GET demande
       public function getDem(){
        $sqlQuery = "SELECT
            id_dem,
            first_name,
            last_name,
            mat,
            pay,
            adr,
            tel,
            mail,
            date_deb,
            date_fin,
            date_dem,
            type_con
                  FROM
                    ". $this->dbTable ."
                WHERE 
                id_dem = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id_dem);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->date_deb = $dataRow['date_deb'];
        $this->date_fin = $dataRow['date_fin'];
        $this->date_dem = $dataRow['date_dem'];
        $this->type_con = $dataRow['type_con'];
        $this->first_name = $dataRow['first_name'];
        $this->last_name = $dataRow['last_name'];
        $this->mat = $dataRow['mat'];
        $this->pay = $dataRow['pay'];
        $this->adr = $dataRow['adr'];
        $this->tel = $dataRow['tel'];
        $this->mail = $dataRow['mail'];
      
    }      
        

        


    }
?>