<?php


class Database {

    private $DBMS = "mysql";
    private $host   = "localhost";
    private $user   = "root";
    private $pass   = "";
    private $dbname = "carshop";

    protected $tableName = "";

    public function connect() {
        try {
            $conn = new PDO("$this->DBMS:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            return (['outcome' => false, 'message' => $e->getMessage()]);
        }
    }

    public function get($where = null, $attr=null,$one=null) {
        if(is_null($where)) {
            $stmt = $this->connect()->query("SELECT * FROM $this->tableName ORDER BY ID DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        }else {
            $stmt = $this->connect()->prepare("SELECT * FROM $this->tableName WHERE $where ORDER BY ID DESC");
            $stmt->execute($attr);
            if(is_null($one)) {
                return $stmt->fetch();
            }else {
                return $stmt->fetchAll();
            }
        }
    }

    public function querry($type, $req, $params = []) {
        if($type == "INSERT") {
            $stmt = $this->connect()->prepare("$type INTO $this->tableName SET $req");
        }else if($type == "UPDATE") {
            $stmt = $this->connect()->prepare("$type $this->tableName SET $req ");
        } else if($type == "DELETE"){
            $stmt = $this->connect()->prepare("$type FROM $this->tableName $req");
        }
        $stmt->execute($params);
        return $stmt->rowCount();
    }
    
}

