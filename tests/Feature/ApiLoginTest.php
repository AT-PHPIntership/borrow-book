<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class ApiLoginTest extends TestCase
{
	use DatabaseMigrations;

	/**
    * Set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
	 factory(User::class)->create();
      
	}

    /**
     * A basic test login api.
     *
     * @return void
     */
    public function testLoginAPI()
    {
        Mockery::mock('\App\Http\Controllers\Api\LoginController')
           ->shouldReceive('login')
           ->andReturn(Response::HTTP_OK)
           ->atLeast();
    }
}
