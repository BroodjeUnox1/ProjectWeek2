<?php

class Database
{

    private $host;
    private $dbName;
    private $user;
    private $password;

    private $dbh;
    private $statement;
    private $error;


    /**
     * Constructs our database class
     */
    public function __construct()
    {
        // Including PDOConfig file and setting connection variables
        include "config.php";
        $this->user = $pdoConfig['username'];
        $this->host = $pdoConfig['hostname'];
        $this->dbName = $pdoConfig['dbName'];
        $this->password = $pdoConfig['password'];

        // DSN for MySQL
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8mb4";
        $options = array(
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);

        } catch (PDOException $exception) {
            $this->error = $exception->getMessage();
            echo $this->error;
        }

    }


    /**
     * PDO prepares your sql statement
     * @param $sqlStatement
     */
    public function prepare($sqlStatement)
    {
        $this->statement = $this->dbh->prepare($sqlStatement);
    }

    /**
     * PDO prepares your sql statement
     * @param $param
     * @param $value
     * @param $type
     */
    public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch (true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindParam($param, $value, $type);
    }

    /**
     * Execute your PDO prepared sql statement
     * @param array $values
     * @return sql data
     */
    public function execute()
    {
        // Get SQL error
        return $this->statement->execute();
        $SQLError = $this->dbh->errorInfo();

        if(!is_null($this->SQLError[2])) {
            echo $this->SQLError[2];
        }
    }

    /**
     * Fetches data from your database
     * @return sql fetched data
     */
    public function fetch() {
        $this->statement->execute();
        return $this->statement->fetch();
    }

    public function fetchAll() {
        $this->statement->execute();
        return $this->statement->fetchAll();
    }


}

?>