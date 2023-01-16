<?php
interface TransportFactory
{
    public function createTransportBody(): TransportBody;

    public function createTransportWheel(): TransportWheel;

    public function createTransport(TransportBody $body, TransportWheel $wheel): TransportInterface;
}

class CarFactory implements TransportFactory
{
    public function createTransportBody(): TransportBody
    {
        return new CarBody();
    }

    public function createTransportWheel(): TransportWheel
    {
        return new CarWheel();
    }

    public function createTransport(TransportBody $body, TransportWheel $wheel): TransportInterface
    {
        $car = new Car();
        $car->setBody($body);
        $car->setWheel($wheel);

        return $car;
    }
}

class BicycleFactory implements TransportFactory
{
    public function createTransportBody(): TransportBody
    {
        return new BicycleBody();
    }

    public function createTransportWheel(): TransportWheel
    {
        return new BicycleWheel();
    }

    public function createTransport(TransportBody $body, TransportWheel $wheel): TransportInterface
    {
        $bicycle = new Bicycle();
        $bicycle->setBody($body);
        $bicycle->setWheel($wheel);

        return $bicycle;
    }
}

interface TransportInterface
{
    public function getInfo(): string;
}

interface TransportBody
{
    public function getType(): string;
}

interface TransportWheel
{
    public function getWidth(): int;
}

abstract class Transport implements TransportInterface
{
    protected TransportBody $body;
    protected TransportWheel $wheel;

    /**
     * @return TransportBody
     */
    public function getBody(): TransportBody
    {
        return $this->body;
    }

    /**
     * @param TransportBody $body
     */
    public function setBody(TransportBody $body): void
    {
        $this->body = $body;
    }

    /**
     * @return TransportWheel
     */
    public function getWheel(): TransportWheel
    {
        return $this->wheel;
    }

    /**
     * @param TransportWheel $wheel
     */
    public function setWheel(TransportWheel $wheel): void
    {
        $this->wheel = $wheel;
    }
}

class Car extends Transport
{
    public function getInfo(): string
    {
        return "Car info: " . "Body type - ". $this->getBody()->getType() . ", Wheel width - " . $this->getWheel()->getWidth() . "mm.";
    }
}

class Bicycle extends Transport
{

    public function getInfo(): string
    {
        return "Bicycle info: " . "Frame type - ". $this->getBody()->getType() . ", Wheel width - " . $this->getWheel()->getWidth() . "mm.";
    }
}

class CarBody implements TransportBody
{
    public function getType(): string
    {
        return "Sedan";
    }
}

class BicycleBody implements TransportBody
{
    public function getType(): string
    {
        return "Hybrid";
    }
}

class CarWheel implements TransportWheel
{
    public function getWidth(): int
    {
        return 195;
    }
}

class BicycleWheel implements TransportWheel
{
    public function getWidth(): int
    {
        return 28;
    }
}

function clientCode(TransportFactory $TransportFactory)
{
    $TransportBody = $TransportFactory->createTransportBody();
    $TransportWheel = $TransportFactory->createTransportWheel();

    $Transport = $TransportFactory->createTransport($TransportBody, $TransportWheel);

    echo $Transport->getInfo();
}

clientCode(new CarFactory());
echo "<br>";
clientCode(new BicycleFactory());