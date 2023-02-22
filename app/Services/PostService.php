<?php

namespace App\Services;

use App\Models\Post;

class PostService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new Post());
    }
}
