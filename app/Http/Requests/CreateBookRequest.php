<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => 'required|string',
            'title' => 'required|string',
            'release_date' => 'required|date',
            'description' => 'required|string',
            'isbn' => 'required|string',
            'format' => 'required|string',
            'number_of_pages' => 'required|numeric'
        ];
    }

    public function data()
    {
        return [
            'author' => [
                'id' => (int) $this->get('author')
            ],
            'title' => $this->get('title'),
            'release_date' => $this->get('release_date'),
            'description' => $this->get('description'),
            'isbn' => $this->get('isbn'),
            'format' => $this->get('format'),
            'number_of_pages' => (int) $this->get('number_of_pages'),
        ];
    }
}
