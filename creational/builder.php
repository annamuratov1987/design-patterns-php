<?php
interface BuilderInterface
{
    public function create(): BuilderInterface;
    public function doStepA(): BuilderInterface;
    public function doStepB(): BuilderInterface;
    public function doStepC(): BuilderInterface;
    public function getProduct(): object;
}

class FirstBuilder implements BuilderInterface
{
    private FirstProduct $product;

    public function create(): BuilderInterface
    {
        $this->product = new FirstProduct();
        return $this;
    }

    public function doStepA(): BuilderInterface
    {
        $this->product->parts .= "Part A\n";
        return $this;
    }

    public function doStepB(): BuilderInterface
    {
        $this->product->parts .= "Part B\n";
        return $this;
    }

    public function doStepC(): BuilderInterface
    {
        $this->product->parts .= "Part C\n";
        return $this;
    }

    public function getProduct(): object
    {
        return $this->product;
    }
}

class SecondBuilder implements BuilderInterface
{
    private SecondProduct $product;

    public function create(): BuilderInterface
    {
        $this->product = new SecondProduct();
        return $this;
    }

    public function doStepA(): BuilderInterface
    {
        $this->product->properties .= "Property A\n";
        return $this;
    }

    public function doStepB(): BuilderInterface
    {
        $this->product->properties .= "Property B\n";
        return $this;
    }

    public function doStepC(): BuilderInterface
    {
        $this->product->properties .= "Property C\n";
        return $this;
    }

    public function getProduct(): object
    {
        return $this->product;
    }
}

class FirstProduct
{
    public string $parts = "";

    public function getInfo(): string
    {
        return "Product type - FirstProduct\nComplated parts:\n" . $this->parts . "\n";
    }
}

class SecondProduct
{
    public string $properties = "";

    public function getInfo(): string
    {
        return "Product type - SecondProduct\nProperties:\n" . $this->properties . "\n";
    }
}

class BuildManager
{
    private BuilderInterface $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function setBuilder(BuilderInterface $builder): void
    {
        $this->builder = $builder;
    }

    public function build(string $type): void
    {
        $this->builder->create();
        if ($type == "normal"){
            $this->builder->doStepA();
        }
        elseif ($type == "improved")
        {
            $this->builder->doStepA();
            $this->builder->doStepB();
            $this->builder->doStepC();
        }
    }
}

function clientCode(BuilderInterface $builder)
{
    $buildManager = new BuildManager($builder);

    $buildManager->build("normal");
    $product = $builder->getProduct();
    echo $product->getInfo() . "\n";

    $buildManager->build("improved");
    $product = $builder->getProduct();
    echo $product->getInfo() . "\n";
}

$builder = new FirstBuilder();
clientCode($builder);

$builder = new SecondBuilder();
clientCode($builder);