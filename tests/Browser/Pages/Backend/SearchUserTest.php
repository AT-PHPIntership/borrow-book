<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class SearchUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    const NUMBER_RECORD_CREATE = 20;
    const RECORD_LIMIT = 15;

    /**
    * Override function setUp() for make user login
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        
        factory(User::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * A Dusk test show list user.
     *
     * @return void
     */
    public function testButtonSearch()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->assertPathIs('/admin/users')
                ->assertSee('List Users')
                ->click('.button-search-user')
                ->assertSee('List Users');
            $elements = $browser->elements('#table-index tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test show result of search with data input
     *
     * @return void
     */
    public function testSearchUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->assertSee('List Users')
                ->type('search', 'Hay Tran')
                ->click('.button-search-user')
                ->assertSee('List Users');
            $elements = $browser->elements('#table-index tbody tr');
            $this->assertCount(1, $elements);
        });
    }
}
