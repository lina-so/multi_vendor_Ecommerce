<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
        return [
            'rating' => ['nullable','in:1,2,3,4,5'],
            'comment' => ['nullable','string','min:3','max:255'],
            'user_id' => ['nullable','integer','exists:users,id'],
            'product_id' => ['nullable','integer','exists:products,id'],
            'status' => ['nullable','integer'],

        ];
    }
}
