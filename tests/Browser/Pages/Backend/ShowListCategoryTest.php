<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;

class ShowListCategoryTest extends DuskTestCase
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

        factory(Category::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * A Dusk test show list category.
     *
     * @return void
     * 
     */
    public function testShowList()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->assertPathIs('/admin/categories')
                ->assertSee('List Category');
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
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->assertSee('List Category');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::RECORD_LIMIT, $elements);
        });
    }

    /**
     * Test view Admin List Category with pagination
     *
     * @return void
     */
    public function testListCategoriesPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->assertSee('List Category');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == ceil((self::NUMBER_RECORD_CREATE) / (self::RECORD_LIMIT)));
        });
    }
}
