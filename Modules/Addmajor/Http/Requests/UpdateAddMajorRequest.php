<?php

namespace Modules\Addmajor\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateAddMajorRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
