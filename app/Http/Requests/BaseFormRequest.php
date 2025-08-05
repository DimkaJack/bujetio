<?php

namespace App\Http\Requests;

use App\Contracts\DtoContract;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    abstract public function getDto(): DtoContract;
}
