<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOportunidadeStatusRequest extends FormRequest
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'status' => 'required|string',
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
      'status' => "Status",
    ];
  }
}
