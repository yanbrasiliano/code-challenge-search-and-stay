<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    
    public function index()
    {
        $books = $this->bookService->getAllBooks();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = $this->bookService->getBookById($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $book = $this->bookService->createBook($request->all());
        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $book = $this->bookService->updateBook($id, $request->all());
        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = $this->bookService->deleteBook($id);
        return response()->json($book);
    }

    public function attachStore(Request $request, $bookId, $storeId)
    {
        $book = $this->bookService->attachStore($bookId, $storeId);
        return response()->json($book);
    }

    public function detachStore($bookId, $storeId)
    {
        $book = $this->bookService->detachStore($bookId, $storeId);
        return response()->json($book);
    }

    public function getStores($bookId)
    {
        $stores = $this->bookService->getStoresForBook($bookId);
        return response()->json($stores);
    }
}
