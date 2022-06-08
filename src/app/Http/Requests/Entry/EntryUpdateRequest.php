<?php

namespace App\Http\Requests\Entry;

use Illuminate\Foundation\Http\FormRequest;

class EntryUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'tour' => 'numeric|max:5000000|min:0',
            'date' => 'required|date|date_format:Y-m-d',
            'time' => 'required|date_format:H:i:s',
            'description' => 'required|string'
        ];
    }


    public function persist()
    {
        $user = auth()->user();
        $user->updateEntry($this);
        return true;
    }
}
