<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateUserTest extends DuskTestCase
{

    use DatabaseMigrations;

    protected $user;

    /**
     * Override function setUp()
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function  testEditUserSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users/'.$this->user->id.'/edit')
                    ->resize(900,1000)
                    ->assertSee('Update users')
                    ->type('name',$this->user->name)
                    ->press('Submit')
                    ->assertSee('Successfully updated user!')
                    ->assertPathIs('/admin/users');
        });
    }
    /**
     *List case for test validation Edit Users
     *
     *@return array
     */
    public function listCaseTestForEditUsers()
    {
        return [
            ['name', '','The name field is required.'],
            ['identity_number', '', 'The identity number field is required.'],
            ['avatar', '', 'The avatar must be a file of type: png, jpg, jpeg.'],
            ['dob','12345', 'The dob does not match the format Y.'],
            ['address', '', 'The address must be a string.'],
        ];
    }
     /**
     * @dataProvider listCaseTestForEditUsers
     *
     */
    public function testValidateEditUsers($name, $content, $msg)
    {
        $this->browse(function (Browser $browser) use ($name, $content, $msg) {
            $browser->visit('/admin/users/'.$this->user->id.'/edit')
                    ->resize(900,1000)
                    ->type($name, $content)
                    ->press('Submit')
                    ->assertSee($msg)
                    ->assertPathIs('/admin/users/'.$this->user->id.'/edit');
        });
    }



}
