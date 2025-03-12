<?php
namespace App\DTOs;

class ProductDTO
{
    public string $name;
    public float $value;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->value = $data['value'];
    }
}
