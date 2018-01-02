<?php
namespace App\Services;
use medoo;

class Database {

    public static $instance;
    private $connection;

    public function __construct() {
        return false;
    }

    public static function getInstance() {
        if(!isset(static::$instance)){
            static::$instance = new self();
        }
        return static::$instance;
    }

    public function connect($connectionInfo) {
        $this->connection = new medoo($connectionInfo);
        return $this->connection;
    }
    

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
    public function __sleep()
    {
        // TODO: Implement __sleep() method.
    }
}