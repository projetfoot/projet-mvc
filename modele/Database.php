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

    /**
     * Database connection
     */
    public function connection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $username = 'root';
        $password = '';
        
        return new PDO($dsn, $username, $password);
    }

     /**
     * @param string $tableName table target
     * @param string $field target field in table
     * @param mixed $value target field in table
     * @return false|array
     */
    public function findOneBy (string $tableName, string $field , $value) 
    {
        $sql =" SELECT * FROM $tableName WHERE $field = :$field";

        $query = $this->pdo->prepare($sql);

        $query->execute([
            ":$field" => $value
        ]);

        return $query->fetch();
    }


    // private $dbName = 'foot2' ; 
    // private $dbHost = 'localhost:3306' ; 
    // private $dbUsername = 'root'; 
    // private $dbUserPassword = ''; 
    // protected $pdo ; 
    
    // public function __construct() 
    // { 
    //     $dbName = $this->dbName;
    //     $dbHost = $this->dbHost;
    //     $dbUsername = $this->dbUsername;
    //     $dbUserPassword = $this->dbUserPassword;
    //     $this->pdo = $this->connect();
    // } 
        
    // protected function connect ()
    // {
    //     $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName";
    //     $dbUsername = "root";
    //     $dbUserPassword = "";

    //     var_dump(new PDO($dsn,$dbUsername,$dbUserPassword , [PDO::FETCH_OBJ]));
    // }
}
    
?>