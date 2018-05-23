<?php

namespace Tests\Browser\Pages\Backend;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteUserTest extends DuskTestCase
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
        factory(User::class)->create([
            'id' => 2,
            'email' => 'alone.hht@gmail.com',
            'name' => 'Ha',
            'identity_number' => 111,
            'dob' => '2018-12-12',
            'address' => 'da nang',
            'role' => User::ROLE_USER
        ]);
    }

    /**
     * Test button delete book in List Users
     *
     * @return void
     */
    public function testClickButtonDeleleUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->assertSee('List Users')
                ->press('Delete')
                ->assertDialogOpened('Are you sure?')
                ->dismissDialog();
            $this->assertDatabaseHas('users', ['deleted_at' => null]);
        });
    }

    /**
     * Test click button Delete
     *
     * @return void
     */
    public function testConfirmDeleteOnPopup()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->click('#table-index tbody tr:nth-child(2) form > button')
                ->assertDialogOpened('Are you sure?')
                ->acceptDialog()
                ->assertSee('Successfully deleted user!');
            $this->assertDatabaseMissing('users', ['id' => 2, 'deleted_at' => null]);
        });
    }

}
