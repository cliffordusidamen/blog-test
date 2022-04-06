<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleViewingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * User can view articles directory.
     *
     * @test
     * @return void
     */
    public function user_can_view_articles_directory()
    {
        foreach (range(1, 10) as $index) {
            Article::factory()
                ->has(Tag::factory())
                ->create();
        }
        $response = $this->get('api/articles');

        $responseData = $response->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals(10, count($responseData['data']));
        $this->assertArrayHasKey('links', $responseData);

        $this->assertArrayHasKey('tags' , $responseData['data'][0]);
        $this->assertTrue(count($responseData['data'][0]['tags']) > 0);
        $this->assertArrayHasKey('name' , $responseData['data'][0]['tags'][0]);
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
        $response = $this->get('/api/articles/' . $article->id);

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
        $response = $this->get('/api/articles/' . 999);
        $response->assertNotFound();
    }

}
