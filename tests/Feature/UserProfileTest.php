<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Illuminate\Http\Response;

class UserProfileTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureProfileUser()
    {
        return [
            'data' => [
                "id",
                "name",
                "email",
                "identity_number",
                "avatar",
                "dob",
                "address",
                "role"
            ]
        ];
    }
    
     /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonProfileUser()
    {

        $response = $this->jsonUser('GET', '/api/users/profile');
        $response->assertJsonStructure($this->jsonStructureProfileUser());
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test compare database
     * 
     * @return void
     */
    public function testCompareDatabase()
    {
        $response = $this->jsonUser('GET', '/api/users/profile');
        $data = json_decode($response->getContent());
        $arrayCompare = [
            'id' => $data->data->id,
            'name' => $data->data->name,
            'email' => $data->data->email,
            'identity_number' => $data->data->identity_number,
            'dob' => $data->data->dob,
            'address' => $data->data->address,
            'role' => $data->data->role,
        ];
        $this->assertDatabaseHas('users', $arrayCompare);
    }

    /**
     * Test get profile of user when unauthorized
     *
     * @return void
     */
    public function testUnauthorized()
    {
        factory(User::class)->create();        
        $response = $this->json('GET', '/api/users/profile');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
