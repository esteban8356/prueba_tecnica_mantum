<?php

namespace App\Services;

use App\DTOs\BuyDTO;
use App\Repositories\BuyRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuyService
{
    protected BuyRepository $buyRepository;

    public function __construct(BuyRepository $buyRepository)
    {
        $this->buyRepository = $buyRepository;
    }

    public function createBuy(BuyDTO $buyDTO)
    {
        return DB::transaction(function () use ($buyDTO) {
            Log::info("Iniciando transacción para crear compra", ['data' => $buyDTO]);

            $buy = $this->buyRepository->create([
                'user_id' => $buyDTO->user_id,
                'total' => $buyDTO->total,
                'payment_id' => $buyDTO->payment_id
            ]);

            if (!$buy) {
                Log::error("Error al crear la compra");
                throw new \Exception("No se pudo crear la compra.");
            }

            Log::info("Compra creada con ID: " . $buy->id);

            foreach ($buyDTO->products as $product) {
                Log::info(" Asociando producto a la compra", [
                    'buy_id' => $buy->id,
                    'product_id' => $product['id'],
                    'amount' => $product['amount']
                ]);

                $buy->products()->attach($product['id'], ['amount' => $product['amount']]);
            }

            Log::info("Compra y productos asociados correctamente");

            return $buy->load('products');
        });
    }

    public function updateBuy(int $id, BuyDTO $buyDTO)
    {
        return DB::transaction(function () use ($id, $buyDTO) {
            Log::info("Iniciando actualización de compra", ['buy_id' => $id, 'data' => $buyDTO]);

            $buy = $this->buyRepository->update($id, [
                'total' => $buyDTO->total,
                'payment_id' => $buyDTO->payment_id
            ]);

            if (!$buy) {
                Log::error("Compra no encontrada");
                return null;
            }

            Log::info("Compra actualizada con ID: " . $buy->id);

            $buy->products()->detach();
            foreach ($buyDTO->products as $product) {
                Log::info("Asociando producto a la compra actualizada", [
                    'buy_id' => $buy->id,
                    'product_id' => $product['id'],
                    'amount' => $product['amount']
                ]);

                $buy->products()->attach($product['id'], ['amount' => $product['amount']]);
            }

            Log::info("Compra y productos actualizados correctamente");

            return $buy->load('products');
        });
    }

    public function deleteBuy(int $id)
    {
        Log::info("Iniciando eliminación de compra con ID: " . $id);

        return DB::transaction(function () use ($id) {
            $deleted = $this->buyRepository->delete($id);

            if (!$deleted) {
                Log::error("No se pudo eliminar la compra (ID: " . $id . ")");
                return false;
            }

            Log::info("Compra eliminada correctamente con ID: " . $id);
            return true;
        });
    }
}
