<?php

namespace Tests\Unit\Model;

use App\Models\Store;

describe('Store Model Test', function () {
  it('has correct fillable attributes', function () {
    $fillable = ['name', 'address', 'active'];
    $store = new Store();

    expect($store->getFillable())->toEqual($fillable);
  });

  it('has no hidden attributes', function () {
    $store = new Store();

    expect($store->getHidden())->toBeEmpty();
  });

  it('has correct table name', function () {
    $store = new Store();

    expect($store->getTable())->toBe('stores');
  });

  it('has correct primary key', function () {
    $store = new Store();

    expect($store->getKeyName())->toBe('id');
  });

  it('has correct timestamps', function () {
    $store = new Store();

    expect($store->usesTimestamps())->toBe(true);
  });

  it('has correct model name', function () {
    $store = new Store();

    expect($store::class)->toBe(Store::class);
  })->group('model');
})->group('model');
