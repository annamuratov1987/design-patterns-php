<?php
class Singleton {
    private static $instance;
    public $name;

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance()
    {
        return static::$instance !== null ? static::$instance : static::$instance = new static();
    }
}

$firstObj = Singleton::getInstance();
$firstObj->name = "Singleton Object";

$secondObj = Singleton::getInstance();

echo "First object name is " . $firstObj->name . "<br>";
echo "Second object name is " . $secondObj->name;
