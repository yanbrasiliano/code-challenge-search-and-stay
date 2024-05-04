<?php

use App\Models\Book;
use App\Models\User;
use App\Services\BookService;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
  $this->user = User::factory()->create();
  $this->actingAs($this->user);

  $this->bookService = mock(BookService::class);
});

describe('BookController', function () {
  describe('Retrieving books', function () {
    it('returns all books', function () {
      $books = Book::factory()->count(3)->create();
      $this->bookService->shouldReceive('getAllBooks')->andReturn($books);

      $this->getJson('/api/v1/books')
        ->assertStatus(Response::HTTP_OK)
        ->assertJson($books->toArray());
    });

    it('returns a specific book', function () {
      $book = Book::factory()->create();
      $this->bookService->shouldReceive('getBookById')->with($book->id)->andReturn($book);

      $this->getJson("/api/v1/books/{$book->id}")
        ->assertStatus(Response::HTTP_OK)
        ->assertJson($book->toArray());
    });
  });

  describe('Managing books', function () {
    it('stores a new book', function () {
      $bookData = Book::factory()->make()->toArray();
      $this->bookService->shouldReceive('createBook')->with($bookData)->andReturn(new Book($bookData));

      $this->postJson('/api/v1/books', $bookData)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJson($bookData);
    });

    it('updates an existing book', function () {
      $book = Book::factory()->create();
      $updatedData = ['name' => 'Updated Book Name'];
      $this->bookService->shouldReceive('updateBook')->with($book->id, $updatedData)->andReturn($book->fill($updatedData));

      $response = $this->putJson("/api/v1/books/{$book->id}", $updatedData);

      $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
          'original' => $book->toArray()
        ]);
    });


    it('deletes an existing book', function () {
      $book = Book::factory()->create();
      $this->bookService->shouldReceive('deleteBook')->with($book->id)->andReturn(true);

      $this->deleteJson("/api/v1/books/{$book->id}")
        ->assertStatus(Response::HTTP_OK);
    });
  });
});
