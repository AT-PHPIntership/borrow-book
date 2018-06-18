<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

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

        Artisan::call('passport:install');
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureLogin()
    {
        return [
            "status",
            "token",
            "user" => [
                "id",
                "name",
                "email",
                "identity_number",
                "avatar",
                "dob",
                "address",
                "role", 
            ]
        ];
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonLogin()
    {
        $user = User::find(1);
        $body = [
            'email' => $user->email,
            'password' => 'secret'
        ];
        $this->json('POST', '/api/login', $body, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructureLogin());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $user = User::find(1);
        $body = [
            'email' => $user->email,
            'password' => 'secret'
        ];
        $response = $this->json('POST', '/api/login', $body, ['Accept' => 'application/json']);
        $data = json_decode($response->getContent())->user;
        $arrayCompare = [
            'name' => $data->name,
            'identity_number' => $data->identity_number,
            'email' => $data->email,
            'dob' => $data->dob,
            'address' => $data->address,
            'role' => $data->role
        ];
        $this->assertDatabaseHas('users', $arrayCompare);    
    }
}
