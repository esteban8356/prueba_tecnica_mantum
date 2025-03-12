<?php

namespace App\Repositories;

use App\Models\Buy;

class BuyRepository
{
    public function create(array $data)
    {
        return Buy::create($data);
    }

    public function findById(int $id)
    {
        return Buy::with('products')->find($id);
    }

    public function update(int $id, array $data)
    {
        $buy = Buy::find($id);
        if (!$buy) {
            return null;
        }
        $buy->update($data);
        return $buy;
    }

    public function delete(int $id)
    {
        $buy = Buy::find($id);
        if (!$buy) {
            return false;
        }
        return $buy->delete();
    }
}
