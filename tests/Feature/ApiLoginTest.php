<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Laravel\Passport\ClientRepository;

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
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, config('app.name'), 'http://192.168.10.10'
        );
        \DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
        ]);        
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
        $data = json_decode($response->getContent());
        $arrayCompare = [
            'name' => $data->user->name,
            'identity_number' => $data->user->identity_number,
            'email' => $data->user->email,
            'dob' => $data->user->dob,
            'address' => $data->user->address,
            'role' => $data->user->role
        ];
        $this->assertDatabaseHas('users', $arrayCompare);    
    }
}
