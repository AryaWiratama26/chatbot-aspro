<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'is_active' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi',
            'content.required' => 'Konten harus diisi',
            'published_at.required' => 'Tanggal publikasi harus diisi',
        ];
    }
}