<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovoItemRequest extends FormRequest
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'nome' => 'required|string',
    ]; 
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
    return [
      'nome' => "ID do Item",
    ];
  }
}
