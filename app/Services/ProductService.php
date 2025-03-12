<?php


namespace App\Services;

use App\DTOs\ProductDTO;
use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(ProductDTO $productDTO)
    {
        return $this->productRepository->create([
            'name' => $productDTO->name,
            'value' => $productDTO->value
        ]);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->findById($id);
    }

    public function updateProduct(int $id, ProductDTO $productDTO)
    {
        return $this->productRepository->update($id, [
            'name' => $productDTO->name,
            'value' => $productDTO->value
        ]);
    }

    public function deleteProduct(int $id)
    {
        return $this->productRepository->delete($id);
    }
}
