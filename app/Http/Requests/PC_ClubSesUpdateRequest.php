<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PC_ClubSesUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return auth()->check();
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
            'id_pc' => 'required|integer|exists:p_c__club_p_c_s,id',
            //'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
