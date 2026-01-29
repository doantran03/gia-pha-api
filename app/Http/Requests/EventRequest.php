<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'start'            => 'required|date',
            'end'              => 'nullable|date|after_or_equal:start',
            'all_day'          => 'nullable|boolean',
            'background_color' => 'nullable|hex_color',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tên sự kiện.',
            'title.max' => 'Tên sự kiện không được vượt quá 255 ký tự.',
            'start.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start.date' => 'Ngày bắt đầu không đúng định dạng.',
            'end.date' => 'Ngày kết thúc không đúng định dạng.',
            'end.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'all_day.boolean' => 'Giá trị tất cả ngày không hợp lệ.',
            'background_color.hex_color' => 'Màu nền không đúng định dạng mã màu.',
        ];
    }
}
