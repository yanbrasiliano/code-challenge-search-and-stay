<?php

use App\Models\Book;
use App\Services\BookService;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
  $this->bookService = $this->mock(BookService::class);
  $this->user = \App\Models\User::factory()->create();
  $this->actingAs($this->user);
});

describe('BookController', function () {

  it('returns all books', function () {
    $books = Book::factory()->count(3)->create();

    $this->bookService->shouldReceive('getAllBooks')->andReturn($books);

    $this->get('/api/v1/books')
      ->assertStatus(Response::HTTP_OK)
      ->assertJson($books->toArray());
  });

  it('returns a specific book', function () {
    $book = Book::factory()->create();

    $this->bookService->shouldReceive('getBookById')->with($book->id)->andReturn($book);

    $this->get("/api/v1/books/{$book->id}")
      ->assertStatus(Response::HTTP_OK)
      ->assertJson($book->toArray());
  });

  it('stores a new book', function () {
    $bookData = Book::factory()->raw();
    $book = new Book($bookData);

    $this->bookService->shouldReceive('createBook')->with($bookData)->andReturn($book);

    $this->post('/api/v1/books', $bookData)
      ->assertStatus(Response::HTTP_CREATED)
      ->assertJson($book->toArray());
  });

  it('updates an existing book', function () {
    $book = Book::factory()->create();
    $updatedData = ['name' => 'Updated Book Name'];

    $this->bookService->shouldReceive('updateBook')->with($book->id, $updatedData)->andReturn($book->refresh());

    $this->put("/api/v1/books/{$book->id}", $updatedData)
      ->assertStatus(Response::HTTP_OK)
      ->assertJson($book->toArray());
  });

  it('deletes an existing book', function () {
    $book = Book::factory()->create();

    $this->bookService->shouldReceive('deleteBook')->with($book->id)->andReturn($book);

    $this->delete("/api/v1/books/{$book->id}")
      ->assertStatus(Response::HTTP_OK)
      ->assertJson($book->toArray());
  });
})->group('controller');
