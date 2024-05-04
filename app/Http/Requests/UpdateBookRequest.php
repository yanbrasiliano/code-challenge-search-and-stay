<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'sometimes|string|max:255',
      'isbn' => 'sometimes|string|max:255',
      'value' => 'sometimes|numeric|min:0',
    ];
  }
}
