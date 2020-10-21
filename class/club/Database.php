<?php 

class Database { 
    
    private $host;
    private $dbname;
    protected $pdo;

    public function __construct()
    {
        $this->host = 'localhost:3306';
        $this->dbname = 'foot2';
        
        $this->pdo = $this->connection();
    }   

    public function connection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $username = 'root';
        $password = '';
        
        return new PDO($dsn, $username, $password);
    }


    public function findOneBy (string $tableName, string $field , $value) 
    {
        $sql =" SELECT * FROM $tableName WHERE $field = :$field";

        $query = $this->pdo->prepare($sql);

        $query->execute([
            ":$field" => $value
        ]);

        return $query->fetch();
    }

}
    
?>