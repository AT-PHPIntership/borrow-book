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
     * Test status code
     *
     * @return void
     */
    public function testStatusResetPassword()
    {
        $email = $this->user->email;
        $this->json('POST', '/api/password/reset', ['email' => $email])
            ->assertStatus(200);
        $token = $this->broker()->createToken($this->user);
        $reset = [
            'email' => $email,
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertStatus(200);
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
     * Test structure of json response.
     *
     * @return void
     */
    public function testStructureJsonSuccess()
    {
        $email = $this->user->email;
        $this->json('POST', '/api/password/reset', ['email' => $email])
            ->assertJsonStructure($this->jsonStructure());
        $token = $this->broker()->createToken($this->user);
        $reset = [
            'email' => $email,
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertJsonStructure($this->jsonStructure());
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
     * Test structure of json when not find email.
     *
     * @return void
     */
    public function testStructureJsonErrorNotFoundEmail()
    {
        $email = $this->user->email;
        $this->json('POST', '/api/password/reset', ['email' => $email.'a'])
            ->assertJsonStructure($this->jsonStructureErrorNotFound());
        $token = $this->broker()->createToken($this->user);
        $reset = [
            'email' => $email.'a',
            'token' => $token,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('PUT', 'api/password/reset', $reset)
            ->assertJsonStructure($this->jsonStructureErrorNotFound());
    }

    /**
     * Test structure of json when error token.
     *
     * @return void
     */
    public function testStructureJsonErrorToken()
    {
        $token = $this->broker()->createToken($this->user);
        $reset = [
            'email' => $this->user->email,
            'token' => $token.'a',
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
