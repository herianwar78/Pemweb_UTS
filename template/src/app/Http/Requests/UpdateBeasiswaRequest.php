<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBeasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('beasiswa_edit');
    }

    public function rules()
    {
        return [
            'beasiswaname' => [
                'string',
                'required',
            ],
            'nim' => [
                'string',
                'required',
            ],
        ];
    }
}
