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
     * Test return json true
     * 
     * @return void
     */
    public function testReturnJson()
    {
        $user = User::find(1);
        $response = $this->jsonUser('GET', '/api/users/profile');
        $response->assertJsonFragment([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'identity_number' => $user->identity_number,
            'avatar' => $user->avatarUrl,
            'dob' => $user->dob,
            'address' => $user->address,
            'role' => $user->role,
        ]);
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
