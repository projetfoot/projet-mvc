<?php 

abstract class Model
{
    private string $host;
    private string $dbname;
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
    protected function connection ()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $username = "root";
        $password = "";

        return new PDO($dsn, $username, $password, [PDO::FETCH_OBJ]);
    }
    
    /**
     * @param string $tableName table target
     * @param string $field target field in table
     * @param mixed $value target field in table
     * @return false|array
     */
    public function findOneBy (string $tableName, string $field , $value) : array
    {
        $sql =" SELECT * FROM $tableName WHERE $field = :$field";

        $query = $this->pdo->prepare($sql);

        $query->execute([
            ":$field" => $value
        ]);

        return $query->fetch() ?: [];
    }
}