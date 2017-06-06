<?php

namespace guialocaliza\Http\Requests;

use guialocaliza\Http\Requests\Request;

class EmpresaRequest extends Request
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
            'name'=>'required',
            'phone1'=>'required',
            'estado_id'=>'required',
            'cidade_id'=>'required',

        ];
    }
}
