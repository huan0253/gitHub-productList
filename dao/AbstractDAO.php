<?php

/**
 * Abstract data access class. Holds all of the database
 * connection information, and initializes a mysqli object
 * on instantiation.
 *
 * 
 */
class AbstractDAO
{//18.188.104.157
    protected $PDO;
    protected static $DSN = "mysql:host=18.188.104.157;dbname=ecommerce";
    protected static $DB_USERNAME = "Adam";
    protected static $DB_PASSWORD = "1234";

    function __construct()
    {
//should also add error handling
        try {
            $this->PDO = new PDO(self::$DSN, self::$DB_USERNAME, self::$DB_PASSWORD);
            // set the PDO error mode to exception
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getPDO()
    {
        return $this->PDO;
    }
}