<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);

        //1-  visit homepage
        $response = $this->get('/');
        //2- assert that you see something
        $response->assertSee('Laracasts');
        $response->assertSee('Laravel');
        //3 - assert the status
        $response->assertStatus(200);
    }
}
