<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id =$this->route('store');

        return [
            'shipping_policy' => 'required|mimes:pdf',
            'return_policy' => 'required|mimes:pdf',
            'name' => ["required", "string", "min:3", "max:255", Rule::unique('stores','name')->ignore($id) ,
             ],
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'industry' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',


        ];
    }
}
