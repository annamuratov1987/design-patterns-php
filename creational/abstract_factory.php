<?php
interface VehicleFactory
{
    public function createVehicleBody(): VehicleBody;

    public function createVehicleTire(): VehicleTire;

    public function createVehicle(VehicleBody $body, VehicleTire $tire): VehicleInterface;
}

class CarFactory implements VehicleFactory
{
    public function createVehicleBody(): VehicleBody
    {
        return new CarBody();
    }

    public function createVehicleTire(): VehicleTire
    {
        return new CarTire();
    }

    public function createVehicle(VehicleBody $body, VehicleTire $tire): VehicleInterface
    {
        $car = new Car();
        $car->setBody($body);
        $car->setTire($tire);

        return $car;
    }
}

class BicycleFactory implements VehicleFactory
{
    public function createVehicleBody(): VehicleBody
    {
        return new BicycleBody();
    }

    public function createVehicleTire(): VehicleTire
    {
        return new BicycleTire();
    }

    public function createVehicle(VehicleBody $body, VehicleTire $tire): VehicleInterface
    {
        $bicycle = new Bicycle();
        $bicycle->setBody($body);
        $bicycle->setTire($tire);

        return $bicycle;
    }
}

interface VehicleInterface
{
    public function getInfo(): string;
}

interface VehicleBody
{
    public function getType(): string;
}

interface VehicleTire
{
    public function getWidth(): int;
}

abstract class Vehicle implements VehicleInterface
{
    protected VehicleBody $body;
    protected VehicleTire $tire;

    /**
     * @return VehicleBody
     */
    public function getBody(): VehicleBody
    {
        return $this->body;
    }

    /**
     * @param VehicleBody $body
     */
    public function setBody(VehicleBody $body): void
    {
        $this->body = $body;
    }

    /**
     * @return VehicleTire
     */
    public function getTire(): VehicleTire
    {
        return $this->tire;
    }

    /**
     * @param VehicleTire $tire
     */
    public function setTire(VehicleTire $tire): void
    {
        $this->tire = $tire;
    }
}

class Car extends Vehicle
{
    public function getInfo(): string
    {
        return "Car info: " . "Body type - ". $this->getBody()->getType() . ", Tire width - " . $this->getTire()->getWidth() . "mm.";
    }
}

class Bicycle extends Vehicle
{

    public function getInfo(): string
    {
        return "Bicycle info: " . "Frame type - ". $this->getBody()->getType() . ", Tire width - " . $this->getTire()->getWidth() . "mm.";
    }
}

class CarBody implements VehicleBody
{
    public function getType(): string
    {
        return "Sedan";
    }
}

class BicycleBody implements VehicleBody
{
    public function getType(): string
    {
        return "Hybrid";
    }
}

class CarTire implements VehicleTire
{
    public function getWidth(): int
    {
        return 195;
    }
}

class BicycleTire implements VehicleTire
{
    public function getWidth(): int
    {
        return 28;
    }
}

function clientCode(VehicleFactory $vehicleFactory)
{
    $vehicleBody = $vehicleFactory->createVehicleBody();
    $vehicleTire = $vehicleFactory->createVehicleTire();

    $vehicle = $vehicleFactory->createVehicle($vehicleBody, $vehicleTire);

    echo $vehicle->getInfo();
}

clientCode(new CarFactory());
echo "<br>";
clientCode(new BicycleFactory());