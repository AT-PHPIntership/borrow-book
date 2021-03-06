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
                ->click('.button-search-user')
                ->assertSee('List Users');
            $elements = $browser->elements('#table-index tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test show result of search with data input, has records return
     *
     * @return void
     */
    public function testSearchUserHasRecordReturn()
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

    /**
     * Test show result of search with data input, no record return
     *
     * @return void
     */
    public function testSearchUserNoRecordReturn()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->assertSee('List Users')
                ->type('search', 'hahaha')
                ->click('.button-search-user')
                ->assertSee('List Users');
            $elements = $browser->elements('#table-index tbody tr');
            $this->assertCount(0, $elements);
        });
    }

    /**
     * Test pagination of search
     *
     * @return void
     */
    public function testSearchPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->assertSee('List Users')
                ->type('search', 'a')
                ->click('.button-search-user')
                ->assertSee('List Users');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
            $browser->clicklink('2')
                ->visit('/admin/users?search=a&page=2');
            $elements = $browser->elements('.table tbody tr');
            $this->assertTrue($elements != 0);
        });
    }
}
