<?php

namespace App\Http\Requests;

use App\Models\City;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'state_id' => [
                'integer',
                'required'
            ]
        ];
    }
}
