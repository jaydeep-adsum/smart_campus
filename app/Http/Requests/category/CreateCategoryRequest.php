<?php

namespace App\Http\Requests\category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
        return Category::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Category Field is Required',
        ];
    }
}
