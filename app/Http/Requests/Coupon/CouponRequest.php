<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $id = $this->route('coupon');

        return [
            'name' => ["required", "string", "min:3", "max:50", Rule::unique('coupons', 'name')->ignore($id)],
            'code' => ['required'],
            'max_uses' => ['required'],
            'max_uses_user' => ['required'],
            'discount_amount' => ['required', 'numeric'],
            'min_amount' => ['required', 'numeric'],
            'status' => ['required', 'in:1,0'],
            'type' => ['required', 'in:fixed,percent'],
            'starts_at' => ['required', 'date'],
            'expires_at' => ['required', 'date'],
        ];
    }


}
