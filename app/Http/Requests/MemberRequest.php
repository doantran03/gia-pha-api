<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar'      => 'nullable|image|max:2048',
            'full_name'   => 'required|string',
            'other_name'  => 'nullable|string',
            'birth_date'  => 'required|date',
            'death_date'  => 'nullable|date|after_or_equal:birth_date',
            'gender'      => 'required|in:male,female,other',
            'order'       => 'required|integer|min:1',
            'generation'  => 'nullable|integer|min:1',
            'address'     => 'nullable|string',
            'biography'   => 'nullable|string',
            'fid'         => 'nullable|exists:members,id',
            'mid'         => 'nullable|exists:members,id',
            'pids'        => 'nullable|array',
            'pids.*'      => 'exists:members,id',
        ];
    }

    /**
     * Custom messages
     */
    public function messages(): array
    {
        return [
            'avatar.image'      => 'Ảnh đại diện phải là file hình ảnh.',
            'avatar.max'        => 'Ảnh đại diện không được vượt quá 2MB.',

            'full_name.required'=> 'Họ và tên là bắt buộc.',
            'full_name.string'  => 'Họ và tên phải là chuỗi ký tự.',

            'birth_date.required' => 'Ngày sinh là bắt buộc.',
            'birth_date.date'     => 'Ngày sinh không đúng định dạng.',

            'death_date.date'     => 'Ngày mất không đúng định dạng.',
            'death_date.after_or_equal' =>
                'Ngày mất phải lớn hơn hoặc bằng ngày sinh.',

            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.in'       => 'Giới tính không hợp lệ.',

            'order.required' => 'Thứ tự là bắt buộc.',
            'order.integer'  => 'Thứ tự phải là số nguyên.',
            'order.min'      => 'Thứ tự phải lớn hơn hoặc bằng :min.',

            'generation.integer' => 'Đời phải là số nguyên.',
            'generation.min'     => 'Đời phải lớn hơn hoặc bằng :min.',

            'fid.exists' => 'Cha được chọn không tồn tại.',
            'mid.exists' => 'Mẹ được chọn không tồn tại.',

            'pids.array'   => 'Danh sách vợ/chồng không hợp lệ.',
            'pids.*.exists'=> 'Vợ/chồng được chọn không tồn tại.',
        ];
    }
}
