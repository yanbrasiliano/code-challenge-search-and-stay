<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UpdateStoreRequest;
use App\Services\StoreService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreateRequest;
use Symfony\Component\HttpFoundation\Response;

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

  public function store(StoreCreateRequest $request)
  {
    $store = $this->storeService->createStore($request->validated());
    return response()->json($store, Response::HTTP_CREATED);
  }

  public function update(UpdateStoreRequest $request, $id)
  {
    $store = $this->storeService->updateStore($id, $request->validated());
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

  public function getActiveStores()
  {
    $activeStores = $this->storeService->getActiveStores();
    return response()->json($activeStores);
  }

  public function getInactiveStores()
  {
    $inactiveStores = $this->storeService->getInactiveStores();
    return response()->json($inactiveStores);
  }
}
