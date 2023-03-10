<?php

namespace App\Services;

use App\Models\Post;

class PostService extends BaseService
{
    public function __construct(public Post $post)
    {
        parent::__construct($post);
    }
}
