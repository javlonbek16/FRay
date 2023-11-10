<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_type' => 'required|string|in:artist,venue',
            'venue_name' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'city_state' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'genres_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            'facebook_link' => 'nullable|string|max:255',
            'image' => 'required|file|image|max:2048|mimes:jpeg,png',
            'website_link' => 'nullable|string|max:255',
            'looking_for_concert' => 'nullable|string|max:255',
        ];

        if ($this->input('role_type') !== 'artist') {
            unset($rules['artist_name']);
        }

        if ($this->input('role_type') !== 'venue') {

            unset($rules['venue_name']);
            unset($rules['address']);

        }

        return $rules;
    }

}
