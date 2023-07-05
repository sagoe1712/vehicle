<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSearch()
    {
        $response = $this->post('/api/vehicles',['make'=>'ford', 'model'=>'explorer', 'registration'=>'ky23lpd']);

        $response->assertStatus(200);
    }

    public function testNoBodyParameters()
    {
        $response = $this->post('/api/vehicles',['make'=>'', 'model'=>'', 'registration'=>'']);

        $response->assertStatus(422);
    }

    public function testWrongMethod()
    {
        $response = $this->get('/api/vehicles');

        $response->assertStatus(405);
    }
}
