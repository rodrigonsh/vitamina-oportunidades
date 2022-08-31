<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovaOportunidadeRequest extends FormRequest
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'cliente_id' => 'required|integer',
      'produto_id' => 'required|integer',
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
      'cliente_id' => "ID do Cliente",
      'produto_id' => "ID do Produto",
    ];
  }
}
