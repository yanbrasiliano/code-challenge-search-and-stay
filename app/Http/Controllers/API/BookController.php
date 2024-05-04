<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{

  public function __construct(protected BookService $bookService)
  {
    $this->bookService = $bookService;
  }

  /**
   * Display a listing of the books.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index()
  {
    $books = $this->bookService->getAllBooks();
    return response()->json($books);
  }

  /**
   * Display the specified book.
   *
   * @param  int  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show($id)
  {
    $book = $this->bookService->getBookById($id);
    return response()->json($book);
  }

  /**
   * Store a newly created book in storage.
   *
   * @param  \App\Http\Requests\StoreBookRequest  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(StoreBookRequest $request)
  {
    $book = $this->bookService->createBook($request->validated());
    return response()->json($book, Response::HTTP_CREATED);
  }

  /**
   * Update the specified book in storage.
   *
   * @param  \App\Http\Requests\UpdateBookRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(UpdateBookRequest $request, $id)
  {
    $book = $this->bookService->updateBook($id, $request->validated());
    return response()->json($book);
  }

  /**
   * Remove the specified book from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id)
  {
    $book = $this->bookService->deleteBook($id);
    return response()->json($book);
  }

  /**
   * Attach a store to the specified book.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $bookId
   * @param  int  $storeId
   * @return \Illuminate\Http\JsonResponse
   */
  public function attachStore(Request $request, $bookId, $storeId)
  {
    $book = $this->bookService->attachStore($bookId, $storeId);
    return response()->json($book);
  }

  /**
   * Detach the specified store from the book.
   *
   * @param  int  $bookId
   * @param  int  $storeId
   * @return \Illuminate\Http\JsonResponse
   */
  public function detachStore($bookId, $storeId)
  {
    $book = $this->bookService->detachStore($bookId, $storeId);
    return response()->json($book);
  }

  /**
   * Get all stores associated with the specified book.
   *
   * @param  int  $bookId
   * @return \Illuminate\Http\JsonResponse
   */
  public function getStores($bookId)
  {
    $stores = $this->bookService->getStoresForBook($bookId);
    return response()->json($stores);
  }
}
