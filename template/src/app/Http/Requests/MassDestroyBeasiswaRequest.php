<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBeasiswaRequest extends FormRequest
/root/uts/pemweb/template/src/app/Http/Requests{
    public function authorize()
    {
        abort_if(Gate::denies('beasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:beasiswas,id',
        ];
    }
}
