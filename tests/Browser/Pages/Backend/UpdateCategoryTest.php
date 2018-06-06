<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use DB;
use Faker\Factory as Faker;
use App\Models\User;

class UpdateCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        factory(Category::class)->create([
            'name' => 'Title of Category',
        ]);

    }

    /**
     * Test Url Edit Category.
     *
     * @return void
     */
    public function  testUrlEditCategory()
    {
        $Category = Category::find(1);
        $this->browse(function (Browser $browser) use ($Category) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->click('.button-edit-category')
                ->assertSee('Update Category')
                ->assertSee('Title of Category');
        });
    }

    /**
     * Test Category Edit Success.
     *
     * @return void
     */
    public function testEditCategorysSuccess()
    {
        $Category = Category::find(1);
        $this->browse(function (Browser $browser) use ($Category) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->click('.button-edit-category')
                ->type('categoryName', 'Title')
                ->press('Update')
                ->pause(500)
                ->assertSee('Update category Success!')
                ->assertPathIs('/admin/categories');
        });
        $this->assertDatabaseHas('categories', ['name' => 'Title']);
    }

    /**
     * Dusk test validate for input
     *
     * @param string $Category    get value in table Category
     *
     * @return void
     */
    public function testValidateForInput()
    {
        $Category = Category::find(1);
        $this->browse(function (Browser $browser) use ($Category) {
            $browser->loginAs($this->user)
                ->visit('/admin/categories')
                ->click('.button-edit-category')
                ->type('categoryName', '');
            $browser->press('Update')
               ->pause(1000)
               ->assertSee('The name field is required.');
       });
    }
}
