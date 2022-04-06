<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Jobs\ProcessCommentJob;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * Get paginated list of articles, with associated tags
     * 
     * @OA\Get(
     *    path="/articles",
     *    operationId="getArticlesList",
     *    tags={"Articles"},
     *    summary="Get list of articles",
     *    description="Returns list of articles",
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/Article")
     *    ),
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $articles = Article::with(['tags'])->paginate(10);
        return response()->json($articles);
    }

    /**
     * Get article by id.
     * 
     * @OA\Get(
     *     path="/articles/{id}",
     *     operationId="getArticleById",
     *     tags={"Articles"},
     *     summary="Get article information",
     *     description="Returns article data",
     *     @OA\Parameter(
     *         name="id",
     *         description="Article ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Article")
     *     ),
     * 
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     * 
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     * )
     * @param  string  $id
     * @throws \Exception
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $article = Article::findOrFail((int) $id);
        return response()->json($article);
    }

    /**
     * Store new comment for a user on a particular article
     *
     * @param  int  $id
     * @param  CommentRequest  $request
     * @return void
     */
    public function comment(int $id, CommentRequest $request)
    {
        $article = Article::findOrFail((int) $id);

        $comment = $request->user()->comments()->make([
            'subject' => $request->subject,
            'body' => $request->body,
            'article_id' => $article->id,
        ]);

        ProcessCommentJob::dispatch($comment->toArray());
        return response()->json("Your message has been successfully sent");
    }
}
