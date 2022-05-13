<?php

namespace App\Http\Requests\cafeteria;

use App\Models\Cafeteria;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCafeteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Item Name Field is Required',
            'price.required' => 'Item Price Field is Required',
        ];
    }
}
