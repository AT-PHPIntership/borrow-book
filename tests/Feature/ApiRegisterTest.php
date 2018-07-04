<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class ApiRegisterTest extends TestCase
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
        factory(User::class);
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureRegister()
    {
        return [
            'token',
            'user' => [
                'id',
                'name',
                'email',
                'identity_number',
                'avatar',
                'dob',
                'address',
                'role'
            ]
        ];
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonRegister()
    {
        $body = [
            "email" => "hayes@example.com",
            "name" => "Mr. Fabian Rippin PhD",
            "password" => '123456',
            "password_confirmation" => '123456',
            "identity_number" => 9562,
        ];
        $response = $this->json('POST', 'api/register', $body);
        $response->assertJsonStructure($this->jsonStructureRegister());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $body = [
            "email" => "hayes@example.com",
            "name" => "Mr. Fabian Rippin PhD",
            "identity_number" => 9562,
            "password" => '123456',
            "password_confirmation" => '123456',
        ];
        $response = $this->json('POST', 'api/register', $body);
        $data = json_decode($response->getContent())->user;
        $arrayCompare = [
            'email' => $data->email,
            'identity_number' => $data->identity_number,
        ];
        $this->assertDatabaseHas('users', $arrayCompare);
    }

    /**
     * Test message validate.
     *
     * @return void
     */
    public function testValidate()
    {
        $body = [
            "name" => "Mr. Fabian Rippin PhD",
            "identity_number" => 9562,
            "password" => '123456',
            "password_confirmation" => '123456',
        ];
        $response = $this->json('POST', 'api/register', $body);
        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "email" => [
                    "The email field is required."
                ]
            ]
        ]);
    }
}
