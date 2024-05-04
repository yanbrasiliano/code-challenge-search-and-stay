<?php

namespace App\Services;

use App\Models\Book;
use Dotenv\Exception\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;

class BookService
{
  public function getAllBooks()
  {
    return Book::all();
  }

  public function getBookById($id)
  {
    return Book::findOrFail($id);
  }

  public function createBook($data)
  {
    return Book::create($data);
  }

  public function updateBook($id, $data)
  {
    try {
      $book = Book::findOrFail($id);
      $book->update($data);
      return response()->json($book, 200);
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->getMessage()], 422);
    }
  }



  public function deleteBook($id)
  {
    $book = Book::findOrFail($id);
    $book->delete();
    return $book;
  }

  public function attachStore($bookId, $storeId)
  {
    $book = Book::findOrFail($bookId);
    $book->stores()->syncWithoutDetaching([$storeId]);
    return $book;
  }

  public function detachStore($bookId, $storeId)
  {
    $book = Book::findOrFail($bookId);
    $book->stores()->detach($storeId);
    return $book;
  }

  public function getStoresForBook($bookId)
  {
    $book = Book::findOrFail($bookId);
    return $book->stores;
  }
}
