<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it("should list all the questiosn", function () {
    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    actingAs($user);

    $response = get(route('dashboard'));

    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});

it("should paginate the result", function () {
    $user = User::factory()->create();
    Question::factory()->count(20)->create();

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator);
});
