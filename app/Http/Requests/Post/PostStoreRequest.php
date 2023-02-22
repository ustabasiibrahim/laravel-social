<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => ['required', 'string', 'in:published,draft'],
            'user_id' => ['required', 'integer', 'exists:users,id'], // 'exists:users,id
            'channel_id' => ['required', 'integer', 'exists:channels,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_nsfw' => ['nullable', 'boolean'],
            'is_spoiler' => ['nullable', 'boolean'],
            'is_locked' => ['nullable', 'boolean'],
            'is_pinned' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.required' => 'The status field is required.',
            'status.string' => 'The status field must be a string.',
            'status.in' => 'The status field must be either published or draft.',
            'channel_id.required' => 'The channel id field is required.',
            'channel_id.integer' => 'The channel id field must be an integer.',
            'channel_id.exists' => 'The channel id field must be an existing channel id.',
            'user_id.required' => 'The user id field is required.',
            'user_id.integer' => 'The user id field must be an integer.',
            'user_id.exists' => 'The user id field must be an existing user id.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must be less than 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'is_nsfw.boolean' => 'The is nsfw field must be a boolean.',
            'is_spoiler.boolean' => 'The is spoiler field must be a boolean.',
            'is_locked.boolean' => 'The is locked field must be a boolean.',
            'is_pinned.boolean' => 'The is pinned field must be a boolean.',
        ];
    }
}
