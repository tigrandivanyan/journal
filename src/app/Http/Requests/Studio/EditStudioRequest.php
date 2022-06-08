<?php

namespace App\Http\Requests\Studio;

use Illuminate\Foundation\Http\FormRequest;
use App\Studio;

class EditStudioRequest extends FormRequest
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
            'name_ru' => 'required|string|min:4|max:50',
            'name_eng' => 'required|string|min:4|max:50',
            'order' => 'required|numeric|min:0',
            'rng_id' => 'required|numeric|min:0',
        ];
    }

    public function persist(){
        $studioData = [
            'name_ru' => $this->name_ru,
            'name_eng' => $this->name_eng,
            'order' => $this->order,
            'rng_id' => $this->rng_id,
        ];

        $studio = Studio::findOrFail($this->id);
        $studio->update($studioData);
        return 'ok';
    }
}
