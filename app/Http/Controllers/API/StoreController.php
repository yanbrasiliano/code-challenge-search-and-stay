<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Http\Controllers\Controller;


class StoreController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        $stores = $this->storeService->getAllStores();
        return response()->json($stores);
    }

    public function show($id)
    {
        $store = $this->storeService->getStoreById($id);
        return response()->json($store);
    }

    public function store(Request $request)
    {
        $store = $this->storeService->createStore($request->all());
        return response()->json($store, 201);
    }

    public function update(Request $request, $id)
    {
        $store = $this->storeService->updateStore($id, $request->all());
        return response()->json($store);
    }

    public function destroy($id)
    {
        $store = $this->storeService->deleteStore($id);
        return response()->json($store);
    }

    public function getBooks($storeId)
    {
        $books = $this->storeService->getBooksForStore($storeId);
        return response()->json($books);
    }
}
