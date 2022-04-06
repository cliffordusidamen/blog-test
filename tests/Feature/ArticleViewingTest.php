<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleViewingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User can view articles directory.
     *
     * @test
     * @return void
     */
    public function user_can_view_articles_directory()
    {
        Article::factory(20)->create();
        $response = $this->get(route('articles.index'));

        $responseData = $response->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals(10, count($responseData['data']));
        $this->assertArrayHasKey('links', $responseData);
    }

    /**
     * User can view article.
     *
     * @test
     * @return void
     */
    public function user_can_view_article()
    {
        $article = Article::factory()->create();
        $response = $this->get(route('articles.show', $article));

        $responseData = $response->json();

        $response->assertStatus(200);
        $response->assertJsonFragment($article->toArray());
        $this->assertEquals($article->id, $responseData['id']);
    }

    /**
     * Not found status code is returned if article not found.
     *
     * @test
     * @return void
     */
    public function not_found_status_code_is_returned_if_article_not_found()
    {
        $response = $this->get(route('articles.show', 999));
        $response->assertNotFound();
    }

}
