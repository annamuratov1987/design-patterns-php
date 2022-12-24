<?php
class Singleton {
    private static $instance;
    private string $name;

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

    public static function getInstance(): Singleton
    {
        return static::$instance !== null ? static::$instance : static::$instance = new static();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


}

$firstObj = Singleton::getInstance();
$firstObj->setName("Singleton Object");

$secondObj = Singleton::getInstance();

echo "First object name: " . $firstObj->getName();
echo "<br>";
echo "Second object name: " . $secondObj->getName();
