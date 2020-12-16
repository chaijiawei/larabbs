<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReplyRequest extends FormRequest
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
            'content' => [
                'required',
                'string',
                'max:255',
            ],

            'topic_id' => [
                'required',
                'integer',
                Rule::exists('topics', 'id'),
            ]
        ];
    }

    public function attributes()
    {
        return [
            'content' => '回复内容',
            'topic_id' => '话题',
        ];
    }
}
