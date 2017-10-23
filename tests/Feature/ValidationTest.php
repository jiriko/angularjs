<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_returns_200_if_field_is_valid()
    {
        $this->withExceptionHandling();
        $user = create(User::class);

        $this->json('GET', 'api/validation?type=email,unique&t=1&q=' . $user->email . '&id=' . $user->id . '&field=email')
            ->assertStatus(200);

        //a request with an email that already exists
        $this->json('GET','api/validation?field=email&type=email,unique&t=1&q=' . $user->email)
            ->assertStatus(422);
    }

    /** @test */
    function it_requires_additional_fields_when_validation_is_unique()
    {
        $this->withExceptionHandling();
        $user = create(User::class);

        //request without the field key
        $this->json('GET', 'api/validation?type=email,unique&q=' . $user->email . '&t=1&id=' . $user->id)
            ->assertStatus(422);

        //request without the table key
        $this->json('GET', 'api/validation?type=email,unique&q=' . $user->email . '&id=' . $user->id . '&field=email')
            ->assertStatus(422);
    }

}
