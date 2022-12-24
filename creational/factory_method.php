<?php
interface Product {
    public function getInfo(): string;
}

class Book implements Product
{
    private string $author;
    private string $name;

    /**
     * @param string $author
     * @param string $name
     */
    public function __construct(string $author, string $name)
    {
        $this->author = $author;
        $this->name = $name;
    }

    public function getInfo(): string
    {
        return "Книга: " . $this->author . ". " . $this->name . ".";
    }
}

class Notebook implements Product
{
    private string $brend;
    private string $cpu;
    private string $memory;

    /**
     * @param string $brend
     * @param string $cpu
     * @param string $memory
     */
    public function __construct(string $brend, string $cpu, string $memory)
    {
        $this->brend = $brend;
        $this->cpu = $cpu;
        $this->memory = $memory;
    }

    public function getInfo(): string
    {
        return "Ноутбук: " . $this->brend . " " . $this->cpu . "/" . $this->memory;
    }
}

abstract class ProductCreator {
    abstract public function getProduct(): Product;

    public function printProductInfo(): void
    {
        $product = $this->getProduct();
        echo $product->getInfo();
    }
}

class BookCreator extends ProductCreator {
    private Book $book;

    /**
     * @param string $author
     * @param string $name
     */
    public function __construct(string $author, string $name)
    {
        $this->book = new Book($author, $name);
    }

    public function getProduct(): Product
    {
        return $this->book;
    }
}

class NotebookCreator extends ProductCreator {
    private Notebook $notebook;

    /**
     * @param string $brend
     * @param string $cpu
     * @param string $memory
     */
    public function __construct(string $brend, string $cpu, string $memory)
    {
        $this->notebook = new Notebook($brend, $cpu, $memory);
    }

    public function getProduct(): Product
    {
        return $this->notebook;
    }
}

function createdProductInfo(ProductCreator $creator){
    $creator->printProductInfo();
}

createdProductInfo(new BookCreator("Мэтт Зандстра", "РНР 8. Объекты, шаблоны и методики программирования"));
echo "<br>";
createdProductInfo(new NotebookCreator("Hp", "Core i3", "8 Gb"));