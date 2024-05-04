<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'sometimes|string|max:255',
      'address' => 'sometimes|string|max:500',
      'active' => 'sometimes|boolean'
    ];
  }
}
