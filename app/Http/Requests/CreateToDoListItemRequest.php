<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateToDoListItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'list_id'=>'required|exists:to_do_lists,id',
                'name'=>'required|min:5|max:255',
                'description'=>'required|string|max:1000',
                'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
