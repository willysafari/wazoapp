<?php

namespace Tests\Feature;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdeaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_an_idea_with_links(): void
    {
        $user = User::factory()->create();
        $links = ['https://example.com', 'http://laravel.com'];

        $response = $this->actingAs($user)->post(route('ideas.store'), [
            'title' => 'An idea with links',
            'status' => 'pending',
            'links' => $links,
        ]);

        $response->assertRedirect(route('ideas.index'));

        $idea = Idea::query()->where('title', 'An idea with links')->firstOrFail();
        $this->assertSame($links, $idea->links->getArrayCopy());
    }

    public function test_idea_creation_rejects_links_without_an_http_scheme(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from(route('ideas.index'))->post(route('ideas.store'), [
            'title' => 'An idea with an invalid link',
            'status' => 'pending',
            'links' => ['javascript:alert(1)'],
        ]);

        $response->assertRedirect(route('ideas.index'));
        $response->assertSessionHasErrors('links.0');
        $this->assertDatabaseMissing('idea', ['title' => 'An idea with an invalid link']);
    }
}
