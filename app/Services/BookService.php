<?php

namespace App\Services;

use App\Models\Book;
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
    $book = Book::findOrFail($id);

    if (isset($data['isbn']) && $data['isbn'] !== $book->isbn) {
      throw new AuthorizationException("The ISBN of a book cannot be changed once set due to its role as a unique identifier for cataloging and tracking purposes.");
    }
    $book->update($data);
    return $book;
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
