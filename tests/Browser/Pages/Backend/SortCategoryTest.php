<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;

class SortCategoryTest extends DuskTestCase
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
        factory(Category::class, 17)->create();
    }

     /*
     * A Dusk test for click link sort
     *
     * @return void
     */
    public function testClickLinksSort()
    { 
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories');
                $browser->click("#category-sort-name a")
                    ->assertQueryStringHas('sort', 'name')
                    ->assertQueryStringHas('order', 'asc')
                    ->click("#category-sort-name a")
                    ->assertQueryStringHas('sort', 'name')
                    ->assertQueryStringHas('order', 'desc');
        });
    }

    /**
     * A Dusk test data sort list category by name
     *
     * @return void
     */
    public function testSortListCategories()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('admin/categories')
                ->resize(1200, 1600)
                ->click("#category-sort-name a");
            //Test list user Desc
            $arrayAsc = Category::orderBy('name', 'asc')->pluck('name')->toArray();
            for ($i = 1; $i <= 15; $i++) {
                $selector = ".table tbody tr:nth-child($i) td:first-child";
                $this->assertEquals($browser->text($selector), $arrayAsc[$i - 1]);
            }
            //Test list user Desc
            $browser->click("#category-sort-name a");
            $arrayDesc = Category::orderBy('name', 'desc')->pluck('name')->toArray();
            for ($i = 1; $i <= 15; $i++) {
                $selector = ".table tbody tr:nth-child($i) td:first-child";
                $this->assertEquals($browser->text($selector), $arrayDesc[$i - 1]);
            }
        });
    }

     /**
     * A Dusk test sort list category when panigate.
     *
     * @return void
     */
     public function testSortListCategoriesWhenPanigate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('admin/categories')
                ->resize(1200, 1600)
                ->click("#category-sort-name a")
                ->clickLink("2");
            // Test list Asc
            $arrayAsc = Category::orderBy('name', 'asc')->pluck('name')->toArray();
            $arraySortAsc = array_chunk($arrayAsc, 15)[1];
            for ($i = 1; $i <= 2; $i++) {
                $selector = ".table tbody tr:nth-child($i) td:first-child";
                $this->assertEquals($browser->text($selector), $arraySortAsc[$i - 1]);
            }
            // Test list Desc
            $browser->click("#category-sort-name a")
                ->clickLink("2");
            $arrayDesc = Category::orderBy('name', 'desc')->pluck('name')->toArray();
            $arraySortDesc = array_chunk($arrayDesc, 15)[1];
            for ($i = 1; $i <= 2; $i++) {
               $selector = ".table tbody tr:nth-child($i) td:first-child";
                $this->assertEquals($browser->text($selector), $arraySortDesc[$i - 1]);
            }
        });
    }
}
