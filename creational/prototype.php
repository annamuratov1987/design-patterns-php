<?php
class PrototypeDemo
{
    public string $simpleProperty;
    public Property $complicatedProperty;

    /**
     * @param string $simpleProperty
     * @param Property $complicatedProperty
     */
    public function __construct(string $simpleProperty, Property $complicatedProperty)
    {
        $this->simpleProperty = $simpleProperty;
        $this->complicatedProperty = $complicatedProperty;
    }

    public function __clone(): void
    {
        $this->simpleProperty = "";
        $this->complicatedProperty = new Property();
    }
}

class Property
{
    private string $name;
    private string $value;

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
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}

$param = new Property();
$param->setName("Param 1");
$param->setValue("Value 1");

$firstObj = new PrototypeDemo("Simple property 1", $param);

$secondObj = clone $firstObj;
$secondObj->simpleProperty = "Simple property 2";
$secondObj->complicatedProperty->setName("Pram 2");
$secondObj->complicatedProperty->setValue("Value 2");

echo "First object details:\n";
echo "1-property: " . $firstObj->simpleProperty . "\n";
echo "2-property: " . $firstObj->complicatedProperty->getName() . ": " . $firstObj->complicatedProperty->getValue() . "\n";

echo "Second object details:\n";
echo "1-property: " . $secondObj->simpleProperty . "\n";
echo "2-property: " . $secondObj->complicatedProperty->getName() . ": " . $secondObj->complicatedProperty->getValue() . "\n";