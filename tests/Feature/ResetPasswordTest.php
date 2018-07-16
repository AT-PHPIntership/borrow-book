<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Response;

class ResetPasswordTest extends TestCase
{
    use DatabaseMigrations;
    use SendsPasswordResetEmails;

    /**
     * Test structure json
     *
     * @return void
     */
    public function  testStructureJson()
    {
        $email = $this->user->email;
        $this->json('POST', '/api/password/reset', ['email' => $email])
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructure());
        $token = $this->broker()->createToken($this->user);
        $reset = [
            'email' => $email,
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertStatus(200)
            ->assertJsonStructure($this->jsonStructure());
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructure()
    {
        return [
            "message",
        ];
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureValidate()
    {
        return [
            "message",
            "errors" => []
        ];
    }

    /**
     * List case for test validate
     *
     * @return array
     */
    public function listCaseTestValidate()
    {
        return [
            ['email', ''],
            ['email', '    '],
            ['email', 'admin'],
            ['email', 'admin@'],
            ['email', '@test.co'],
        ];
    }

    /**
     * Test validate send email
     * 
     * @param string $email   email for validate
     * @param string $content content
     *
     * @dataProvider listCaseTestValidate
     * 
     * @return void
     */
    public function testValidate($name, $content)
    {
        $this->json('POST', 'api/password/reset', [$name => $content])
            ->assertJsonStructure($this->jsonStructureValidate());
        $token = $this->broker()->createToken($this->user);
        $reset = [
            $name => $content,
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertJsonStructure($this->jsonStructureValidate());
    }

    /**
     * Return structure of json error not found
     *
     * @return array
     */
    public function jsonStructureErrorNotFound()
    {
        return [
            "error" => [
                "message",
                "request" => []
            ],
            "code",
        ];
    }

    /**
     * Test case
     *
     * @return array
     */
    public function listCaseTestNotFound()
    {
        return [
            ['abc@gmail.com', 'c62399583f85268b1dfbee5f527139c67cd5abd1f2e83550de45bc98720e8f26sds'],
        ];
    }

    /**
     * Test structure
     * 
     * @dataProvider listCaseTestNotFound
     * 
     * @return void
     */
    public function testStructureJsonErrorNotFound($email, $token)
    {
        $this->json('POST', '/api/password/reset', [ 'email' => $email])
            ->assertJsonStructure($this->jsonStructureErrorNotFound());
        $reset = [
            'email' => $this->user->email,
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertJsonStructure($this->jsonStructureErrorNotFound());
    }

    /**
     * Test vaidate password confirm
     *
     * @return void
     */
    public function testValidatePasswordConfirm()
    {
        $token = $this->broker()->createToken($this->user);
        $reset = [
            'email' => $this->user->email,
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '1234561',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertJsonStructure($this->jsonStructureValidate());
    }
}
