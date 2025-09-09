<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreteacherRequest extends FormRequest
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
            'email' => 'required|email|unique:teachers,email',
            'mobile' => 'required|string|max:20',
            'age' => 'required|integer|min:22|max:70',
            'gender' => 'required|in:male,female',
            'subject' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0|max:999999.99',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم المعلم مطلوب',
            'name.max' => 'اسم المعلم يجب أن يكون أقل من 255 حرف',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل',
            'mobile.required' => 'رقم الجوال مطلوب',
            'age.required' => 'العمر مطلوب',
            'age.integer' => 'العمر يجب أن يكون رقماً صحيحاً',
            'age.min' => 'العمر يجب أن يكون 22 سنة على الأقل',
            'age.max' => 'العمر يجب أن يكون 70 سنة كحد أقصى',
            'gender.required' => 'الجنس مطلوب',
            'gender.in' => 'يرجى اختيار جنس صحيح',
            'subject.required' => 'المادة مطلوبة',
            'salary.required' => 'الراتب مطلوب',
            'salary.numeric' => 'الراتب يجب أن يكون رقماً',
            'salary.min' => 'الراتب يجب أن يكون أكبر من صفر',
        ];
    }
}
