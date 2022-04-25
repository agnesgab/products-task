<?php

namespace App\Validation;

class ProductValidator
{

    private array $data;
    private array $errors = [];
    private string $requiredErrorMessage = 'Please, submit required data';
    private string $typeErrorMessage = 'Please, provide the data of indicated type';

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validateProductForm(): array
    {
        $this->validateSku();
        $this->validateName();
        $this->validatePrice();
        $this->validateType();
        $this->validateSizeWeightDimensions();

        return $this->errors;
    }

    private function validateSku(): void
    {
        $value = trim($this->data['sku']);
        if (empty($value)) {
            $this->addError('sku', $this->requiredErrorMessage);
        } else {
            if (!preg_match("/^[A-Za-z0-9-]*$/", $value)) {
                $this->addError('sku', $this->typeErrorMessage);
            }
        }
    }

    private function validateName()
    {
        $value = trim($this->data['name']);
        if (empty($value)) {
            $this->addError('name', $this->requiredErrorMessage);
        } else {
            if (!preg_match("/^\w[\w.\-#&\s]*$/", $value)) {
                $this->addError('name', $this->typeErrorMessage);
            }
        }
    }

    private function validatePrice()
    {
        $value = trim($this->data['price']);
        if (empty($value)) {
            $this->addError('price', $this->requiredErrorMessage);
        } else {
            if (!preg_match("/[0-9]+(\\.[0-9][0-9]?)?/", $value)) {
                $this->addError('price', $this->typeErrorMessage);
            }
        }
    }

    private function validateType()
    {
        $value = trim($this->data['type_id']);
        if (empty($value)) {
            $this->addError('type_id', $this->requiredErrorMessage);
        }
    }

    private function validateSizeWeightDimensions()
    {
        $productInputData = array_chunk($this->data, 5);
        $value = $productInputData[1];
        foreach ($value as $v) {
            if (empty($v))
                $this->addError('value', $this->requiredErrorMessage);
        }
    }

    private function addError(string $key, string $value): void
    {
        $this->errors[$key] = $value;
    }
}