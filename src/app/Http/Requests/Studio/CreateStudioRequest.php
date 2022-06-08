<?php

namespace App\Http\Requests\Studio;

use Illuminate\Foundation\Http\FormRequest;
use App\Studio;

class CreateStudioRequest extends FormRequest
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
            'name_ru' => 'required|string|min:4|max:50|unique:studios,name_ru',
            'name_eng' => 'required|string|min:4|max:50|unique:studios,name_eng',
            'order' => 'required|numeric|min:0',
            'rng_id' => 'required|numeric|min:0',
        ];
    }

    public function persist(){

       Studio::create([
            'name_ru' => $this->name_ru,
            'name_eng' => $this->name_eng,
            'order' => $this->order,
            'rng_id' => $this->rng_id,
        ]);

        return 'ok';
    }
}
