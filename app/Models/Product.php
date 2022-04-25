<?php

namespace App\Models;

abstract class Product
{
    private ?int $id;
    private string $sku;
    private string $name;
    private float $price;
    private Attribute $attribute;

    public function __construct(?int $id = null, string $sku, string $name, float $price)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setItemAttributeValues(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    public function getAttributeName(): string
    {
        return $this->attribute->getName();
    }

    public function getAttributeValue(): string
    {
        return $this->attribute->getValue();
    }
}