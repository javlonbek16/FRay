<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'artist_id' => 'nullable',
            'venue_id' => 'nullable',
            'start_date' => 'required|date_format:"Y-m-d H:i"',
            'end_date' => 'required|date_format:"Y-m-d H:i"|after_or_equal:start_date',
        ];
    }
}
