<?php
namespace App\Http\Controllers;

use App\DTOs\BuyDTO;
use App\Services\BuyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BuyController extends Controller
{
    protected BuyService $buyService;

    public function __construct(BuyService $buyService)
    {
        $this->buyService = $buyService;
    }

    public function index()
    {
        $buys = $this->buyService->getAllBuys();
        return response()->json($buys, Response::HTTP_OK);
    }

    public function show($id)
    {
        $buy = $this->buyService->getBuyById($id);

        if (!$buy) {
            return response()->json(['error' => 'Compra no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($buy, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'total' => 'required|numeric|min:0',
            'payment_id' => 'nullable|exists:payments,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        $buyDTO = new BuyDTO($validated);
        $buy = $this->buyService->createBuy($buyDTO);

        return response()->json($buy, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'payment_id' => 'nullable|exists:payments,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        $buyDTO = new BuyDTO($validated);
        $updatedBuy = $this->buyService->updateBuy($id, $buyDTO);

        if (!$updatedBuy) {
            return response()->json(['error' => 'Compra no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($updatedBuy, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $deleted = $this->buyService->deleteBuy($id);

        if (!$deleted) {
            return response()->json(['error' => 'Compra no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Compra eliminada'], Response::HTTP_OK);
    }
}
