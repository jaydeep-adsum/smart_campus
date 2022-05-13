<?php

namespace App\Http\Requests\fellowship;

use App\Models\Fellowship;
use Illuminate\Foundation\Http\FormRequest;

class CreateFellowshipRequest extends FormRequest
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
       return Fellowship::$rules;
    }
}
