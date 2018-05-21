<?php

namespace Tests\Browser\Pages\Backend;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
    * Override function set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        factory(User::class)->create();
    }

    /**
     * Test url create user
     *
     * @return void
     */
    public function testCreateUserUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users')
                ->clickLink('Manage users')
                ->clickLink('Create users')
                ->assertPathIs('/admin/users/create')
                ->assertSee('Create users');
        });
    }

     /**
     * List case for Test validate for input Create User
     *
     * @return array
     */
    public function listCaseTestValidateForInput()
    {
        return [
            ['name', '', 'The name field is required.'],
            ['email', '', 'The email field is required.'],
            ['identity_number', '', 'The identity number field is required.'],
            ['dob', '', 'The dob does not match the format Y-m-d.'],
            ['address', '', 'The address must be a string.'],
        ];
    }

    /**
     * Dusk test validate for input
     *
     * @param string $name    name of field
     * @param string $content content
     * @param string $message message show when validate
     *
     * @dataProvider listCaseTestValidateForInput
     *
     * @return void
     */
    public function testValidateForInput($name, $content,$message)
    {
        $this->browse(function (Browser $browser) use ($name, $content, $message) {
            $browser->visit('admin/users/create')
                ->type('name', '')
                ->type('email', '')
                ->type('identity_number', '')
                ->keys('#dob', '')
                ->type('address', '');
            $browser->press('Submit')
                ->assertSee($message);
        });
    }

    /**
     * Dusk test create book success.
     *
     * @return void
     */
    public function testCreatesUserSuccess()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('admin/users/create')
                ->type('name', 'Ha')
                ->type('email', 'alone.hht@gmail.com')
                ->type('identity_number', '111')
                ->keys('#dob', '12/12/2018')
                ->type('address', 'da nang');
            $browser->press('Submit')
                ->assertSee('Successfully created user!');
            $this->assertDatabaseHas('users', [
                'id' => 2,
                'email' => 'alone.hht@gmail.com',
                'name' => 'Ha',
                'identity_number' => 111,
                'dob' => '2018-12-12',
                'address' => 'da nang'
            ]);
        });
    }
}
