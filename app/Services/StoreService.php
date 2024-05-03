<?php

namespace App\Services;

use App\Models\Store;

class StoreService
{
    public function getAllStores()
    {
        return Store::all();
    }

    public function getStoreById($id)
    {
        return Store::findOrFail($id);
    }

    public function createStore($data)
    {
        return Store::create($data);
    }

    public function updateStore($id, $data)
    {
        $store = Store::findOrFail($id);
        $store->update($data);
        return $store;
    }

    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return $store;
    }
    
    public function getBooksForStore($storeId)
    {
        $store = Store::findOrFail($storeId);
        return $store->books;
    }
}
