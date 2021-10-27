<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
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
            'name' => [
                'alpha',
                'max:25',
                'nullable'
            ],
            'surname' => [
                'alpha',
                'max:25',
                'nullable'
            ],
            'birthdate' => [
                'nullable'
            ],
            'height' => [
                'nullable'
            ],
            'club_member' => [
                'nullable'
            ],
        ];
    }
}
