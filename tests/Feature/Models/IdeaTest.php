<?php

namespace Tests\Feature\Models;

use App\IdeaStatus;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class IdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_counts_returns_counts_for_each_status_and_all_ideas(): void
    {
        $user = User::factory()->create();
        Idea::factory()->for($user)->create(['status' => IdeaStatus::PENDING]);
        Idea::factory()->for($user)->count(2)->create(['status' => IdeaStatus::COMPLETED]);

        $statusCounts = Idea::statusCounts($user);

        $this->assertInstanceOf(Collection::class, $statusCounts);
        $this->assertSame(1, $statusCounts->get(IdeaStatus::PENDING->value));
        $this->assertSame(0, $statusCounts->get(IdeaStatus::IN_PROGRESS->value));
        $this->assertSame(2, $statusCounts->get(IdeaStatus::COMPLETED->value));
        $this->assertSame(3, $statusCounts->get('all'));
    }
}
