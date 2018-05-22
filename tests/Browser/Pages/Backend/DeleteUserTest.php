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
        $user = factory(User::class, 1)->create();
    }

    /**
     * Test button delete book in List Users
     *
     * @return void
     */
    public function testClickButtonDeleleUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users')
                ->assertSee('List Users')
                ->press('Delete')
                ->assertDialogOpened('Are you sure?')
                ->dismissDialog();
            $this->assertDatabaseHas('users',['deleted_at' => null]);
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
            $browser->visit('/admin/users')
                ->press('Delete')
                ->assertDialogOpened('Are you sure?')
                ->acceptDialog()
                ->assertSee('Successfully deleted user!');
            $this->assertDatabaseMissing('users',['deleted_at'=>null]);
        });
    }

}
