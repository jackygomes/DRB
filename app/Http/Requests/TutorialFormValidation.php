<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorialFormValidation extends FormRequest
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
            'tutorial_category_id' => 'required',
            'name'              => 'required',
            'tutorial_image'    => 'required',
            'date'              => 'required',
            'trainers'          => 'required',
            'description'       => 'required',
            'attendees'         => 'required',
            'curriculum'        => 'required',
            'requirement'       => 'required',
            'price'             => 'required',
        ];
    }
}
