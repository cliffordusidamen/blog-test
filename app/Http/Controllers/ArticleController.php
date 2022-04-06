<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * Get paginated articles list.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $articles = Article::paginate(10);
        return response()->json($articles);
    }

    /**
     * Get article by id.
     *
     * @param  int  $id
     * @throws \Exception
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }
}
