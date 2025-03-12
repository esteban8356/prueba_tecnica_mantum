<?php
namespace App\DTOs;

class BuyDTO
{
    public int|null $user_id;
    public float $total;
    public int|null $payment_id;
    public array $products;

    public function __construct(array $data)
    {
        $this->user_id = $data['user_id'] ?? null;
        $this->total = $data['total'];
        $this->payment_id = $data['payment_id'] ?? null;
        $this->products = $data['products'];
    }
}
