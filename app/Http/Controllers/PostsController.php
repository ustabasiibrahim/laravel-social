<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct(public PostService $post_service)
    {
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
    }

    public function show(Post $post)
    {
    }

    public function update(Request $request, Post $post)
    {
    }

    public function destroy(Post $post)
    {
    }
}
