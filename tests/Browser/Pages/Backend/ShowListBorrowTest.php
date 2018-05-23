<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Borrow;
use App\Models\User;

class ShowListBorrowTest extends DuskTestCase
{
    use DatabaseMigrations;

    const NUMBER_RECORD_CREATE = 20;
    const RECORD_LIMIT = 15;

    /**
    * Override function set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();

        factory(User::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Borrow::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * A Dusk test show list borrows.
     *
     * @return void
     * 
     */
    public function testShowList()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/borrows')
                    ->assertPathIs('/admin/borrows')
                    ->assertSee('List Borrow');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test view Admin List Borrow with pagination
     *
     * @return void
     */
    public function testListBorrowsPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/borrows')
                ->assertSee('List Borrow');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
        });
    }

}
