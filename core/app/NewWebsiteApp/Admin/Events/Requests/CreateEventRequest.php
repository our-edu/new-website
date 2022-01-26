<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Events\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'description' => 'required',
            'event_date' => 'required',
            'start_time' => 'required ',
            'end_time' => 'required |after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'الاسم مطلوب',
            'description.required' => 'الوصف مطلوب',
            'event_date.required' => 'هذا الحقل مطلوب',
            'start_time.required' => 'هذا الحقل مطلوب',
            'end_time.required' => 'هذا الحقل مطلوب',
            'end_time.after' => 'هذا الحقل يجب ان يكون لاحقا لوقت البدء',
        ];
    }
    public function getImageData()
    {
        $directory_path = explode('/' . basename($this->input('image_url')), $this->input('image_url'))[0];
        return  basename($directory_path)."/".basename($this->input('image_url'));
    }
}
