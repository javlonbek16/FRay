<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShowRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required',
            'artist_id' => 'required',
            'venue_id' => 'required',
            'start_date' => 'required|date_format:"Y-m-d H:i"',
            'end_date' => 'required|date_format:"Y-m-d H:i"|after_or_equal:start_date',
        ];
    }
}
