<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

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
            $element = $browser->elements('#table-index tbody tr');
            $this->assertCount(1, $element);
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
            $browser->visit('/admin/users');
            $elements = $browser->elements('#table-index tbody tr');
            $this->assertCount(1, $elements);
            $browser->press('Delete')
                ->assertDialogOpened('Are you sure?')
                ->acceptDialog()
                ->assertSee('Successfully deleted user!');
            $elements = $browser->elements('#table-index tbody tr');
            $this->assertCount(0, $elements);
        });
    }

}
