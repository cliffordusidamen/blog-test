<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a guest cannot make comment
     *
     * @test
     * @return void
     */
    public function guest_cannot_make_comment()
    {
        $this->seed();
        $response = $this->postJson('/api/articles/1/comment', [
            'subject' => 'Test subject',
            'body' => 'Test body',
        ]);

        $response->assertUnauthorized();
    }

    /**
     * Test that validation response is returned
     * when data for comment is not valid
     * 
     * @test
     * @return void
     */
    public function validation_response_when_request_has_invalid_data(): void
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '',
        ]);

        $response1 = $this->actingAs($user)->postJson('/api/articles/1/comment', [
            'body' => 'Test body',
        ]);
        $response1->assertJsonValidationErrors('subject');

        $response2 = $this->actingAs($user)->postJson('/api/articles/1/comment', [
            'subject' => 'Test subject',
        ]);
        $response2->assertJsonValidationErrors('body');
        
    }
}
