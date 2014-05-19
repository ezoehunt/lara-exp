<?php namespace Acme\Library;

use PDO;

class DatabasePDO {

// FROM http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
// Uses environment vars for connection

    private $stmt;
    private $dbh;
    private $error;
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $_ENV['DBHOST'] . ';dbname=' . $_ENV['DBNAME'] ;

        // Set options
        $options = array(
        PDO::ATTR_PERSISTENT    => true,
        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
        $this->dbh = new PDO($dsn, $_ENV['DBUSER'], $_ENV['DBPWD'], $options);
        }
        // Catch any errors
        catch(PDOException $e){
        $this->error = $e->getMessage();
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
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
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    // Returns an array of the results set rows
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Returns a single result
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Count of affected rows
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    // Last inserted ID as a string
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

}