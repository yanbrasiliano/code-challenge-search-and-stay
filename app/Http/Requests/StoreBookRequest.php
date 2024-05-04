<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'required|string|max:255',
      'isbn' => 'required|string|unique:books,isbn',
      'value' => 'required|numeric|min:0',
    ];
  }
}
