<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostUpdateRequest extends PostStoreRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', Post::findOrFail($this->route('post')));
    }
}
