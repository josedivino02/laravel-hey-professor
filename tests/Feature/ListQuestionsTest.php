<?php

use App\Models\{Question, User};

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
