<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191|string|unique:courses,name,' .$this->course->id,
            'category_id' => 'required',
            'description' => 'required|string',
            'imglink' => 'nullable|file|max:1500',
            'video' => 'required|string',
        ];
    }

    public function attributes(){
        return[
            'name' => 'nome',
            'category_id' => 'categoria',
            'description' => 'descricao',
            'slug' => 'slug',
            'imglink' => 'imagem',
        ];
    }
}
