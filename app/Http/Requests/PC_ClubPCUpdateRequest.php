<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PC_ClubPCUpdateRequest extends FormRequest
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
            //'PC_Name' => 'required|exists:p_c__club_p_cs,PC_Name',
            //'PC_Info' => 'required|exists:p_c__club_p_cs,PC_Info',
        ];
    }
}