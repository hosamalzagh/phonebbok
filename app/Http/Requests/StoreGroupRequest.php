<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1|max:100',
            'level' => 'nullable|string|max:100',
            'section' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'teacher_id' => 'nullable|exists:teachers,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم المجموعة مطلوب',
            'name.max' => 'اسم المجموعة يجب أن يكون أقل من 255 حرف',
            'capacity.required' => 'السعة مطلوبة',
            'capacity.integer' => 'السعة يجب أن تكون رقماً صحيحاً',
            'capacity.min' => 'السعة يجب أن تكون 1 على الأقل',
            'capacity.max' => 'السعة يجب أن تكون 100 كحد أقصى',
            'level.max' => 'المستوى يجب أن يكون أقل من 100 حرف',
            'section.max' => 'الشعبة يجب أن تكون أقل من 100 حرف',
            'teacher_id.exists' => 'المعلم المحدد غير موجود',
        ];
    }
}
