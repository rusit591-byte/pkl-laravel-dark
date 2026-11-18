<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/login'); // Ubah dari '/' ke '/login'

        $response->assertStatus(200);
    }
}