<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class ShowListUserTest extends DuskTestCase
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
    public function testShowList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users')
                    ->assertPathIs('/admin/users')
                    ->assertSee('List Users');
        });
    }

    /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users')
                ->assertSee('List Users');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test view Admin List Users with pagination
     *
     * @return void
     */
    public function testListUsersPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users')
                ->assertSee('List Users');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
        });
    }
}
