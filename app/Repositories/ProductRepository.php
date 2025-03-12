<?php


namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getAll()
    {
        return Product::all();
    }

    public function findById(int $id)
    {
        return Product::find($id);
    }

    public function update(int $id, array $data)
    {
        $product = Product::find($id);
        if (!$product) {
            return null;
        }
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }
        return $product->delete();
    }
}
