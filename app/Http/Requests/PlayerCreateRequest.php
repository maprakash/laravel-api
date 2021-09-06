<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerCreateRequest extends FormRequest
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
            'firstName'=>'required|alpha|alpha|max:50',
            'lastName' => 'required|alpha|min:3|max:50',
            'playerImageURI' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'team_id' => 'required|exists:teams,id'
        ];
    }
}
