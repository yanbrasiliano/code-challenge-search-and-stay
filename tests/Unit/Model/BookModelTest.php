<?php

namespace Tests\Unit\Model;

use App\Models\Book;

describe('Book Model Test', function () {
  it('has correct fillable attributes', function () {
    $fillable = ['name', 'isbn', 'value'];
    $book = new Book();

    expect($book->getFillable())->toEqual($fillable);
  });

  it('has no hidden attributes', function () {
    $book = new Book();

    expect($book->getHidden())->toBeEmpty();
  });

  it('has correct table name', function () {
    $book = new Book();

    expect($book->getTable())->toBe('books');
  });

  it('has correct primary key', function () {
    $book = new Book();

    expect($book->getKeyName())->toBe('id');
  });

  it('has correct timestamps', function () {
    $book = new Book();

    expect($book->usesTimestamps())->toBe(true);
  });

  it('has correct model name', function () {
    $book = new Book();

    expect($book::class)->toBe(Book::class);
  })->group('model');
})->group('model');
