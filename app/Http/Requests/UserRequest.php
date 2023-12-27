<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('user.login')) {
            return [
                'email'    => 'required|string|email|max:255',
                'password' => 'required|min:8',
            ];
        } elseif (request()->routeIs('user.store')) {
            return [
                'firstname' => 'required|string|max:255',
                'lastname'  => 'required|string|max:255',
                'role'      => 'nullable|string',
                'email'     => 'required|string|email|unique:App\Models\User,email|max:255',
                'password'  => 'required|min:8|confirmed',
            ];
        } elseif (request()->routeIs('user.update')) {
            return [
                'name' => 'required|string|max:255', // Assuming the field to update is 'name'
            ];
        } elseif (request()->routeIs('user.email')) {
            return [
                'email' => 'required|string|email|max:255',
            ];
        } elseif (request()->routeIs('user.password')) {
            return [
                'password' => 'required|confirmed|min:8',
            ];
        } elseif (request()->routeIs('user.image') || request()->routeIs('profile.image') || request()->routeIs('ocr.image')) {
            return [
                'image' => 'nullable|image|mimes:jpg,bmp,png|max:2048',
            ];
        }

        // Add a default case to return an empty array if none of the conditions are met
        return [];
    }

}
