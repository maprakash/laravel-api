<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerUpdateRequest extends FormRequest
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
            'firstName'=>'alpha|alpha|max:50',
            'lastName' => 'alpha|alpha|max:50',
            'playerImageURI' => 'image|mimes:jpg,jpeg,png|max:2048',
            'team_id' => 'exists:teams,id'
        ];
    }
}
