<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorestudentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'age' => 'required|integer|min:13|max:20',
            'gender' => 'required|in:male,female',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'يجب أن يكون الاسم نصاً',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا',
            'mobile.required' => 'رقم الموبايل  مطلوب',
            'mobile.string' => 'يجب أن يكون رقم الموبايل  نصًا',
            'mobile.max' => 'يجب ألا يتجاوز رقم الموبايل  255 حرفًا',
            'age.required' => 'العمر مطلوب',
            'age.integer' => 'يجب أن يكون العمر عددًا صحيحًا',
            'age.min' => 'يجب ألا يقل العمر عن 13 سنة',
            'age.max' => 'يجب ألا يزيد العمر عن 20 سنة',
            'gender.required' => 'الجنس مطلوب',
            'gender.in' => 'الجنس المحدد غير صالح',
        ];
    }
}
