<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $activeCategoryId = $request->query('category');

        if (!$activeCategoryId && $categories->isNotEmpty()) {
            $activeCategoryId = $categories->first()->id;
        }

        $postsQuery = Post::query()->with('category')->orderBy('created_at', 'desc');

        if ($activeCategoryId) {
            $postsQuery->where('category_id', $activeCategoryId);
        }

        $posts = $postsQuery->get();

        return view('posts.index', [
            'categories' => $categories,
            'posts' => $posts,
            'activeCategoryId' => $activeCategoryId,
        ]);
    }
}
