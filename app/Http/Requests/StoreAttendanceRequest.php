<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'group_id' => ['required', 'integer', 'exists:groups,id'],
            'date' => ['required', 'date'],
            'entries' => ['required', 'array'],
            'entries.*.status' => ['required', 'in:present,absent,late'],
            'entries.*.notes' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.required' => 'يرجى اختيار مجموعة',
            'date.required' => 'يرجى اختيار تاريخ',
            'entries.required' => 'يرجى تحديد حالات الحضور للطلاب',
        ];
    }
}
