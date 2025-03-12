<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products, Response::HTTP_OK);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
        ]);

        $productDTO = new ProductDTO($validated);
        $product = $this->productService->createProduct($productDTO);

        return response()->json($product, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
        ]);

        $productDTO = new ProductDTO($validated);
        $updatedProduct = $this->productService->updateProduct($id, $productDTO);

        if (!$updatedProduct) {
            return response()->json(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($updatedProduct, Response::HTTP_OK);
    }


    public function destroy($id)
    {
        $deleted = $this->productService->deleteProduct($id);

        if (!$deleted) {
            return response()->json(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Producto eliminado'], Response::HTTP_OK);
    }
}
