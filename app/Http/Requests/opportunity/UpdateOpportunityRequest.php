<?php

namespace App\Http\Requests\opportunity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpportunityRequest extends FormRequest
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
            'company_name' => 'required',
            'interview_date' => 'required',
            'location' => 'required',
            'criteria' => 'required',
            'overview' => 'required|url',
        ];
    }
}
