<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;

class CreateCategoryTest extends DuskTestCase
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

        factory(Category::class)->create([
            'id' => 1,
            'name' => 'A'
        ]);
    }

    /**
     * Dusk test create category success.
     *
     * @return void
     */
    public function testCreatesCategorySuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('admin/categories/')
                ->type('name', 'Title for category');         
            $browser->press('Create')
                    ->pause(1000)
                    ->assertSee('Create category Success!');
            $this->assertDatabaseHas('categories', [
                'id' => 2,
                'name' => 'Title for category',
            ]);
        });
    }

    /**
     * List case for Test validate for input Create Category
     *
     * @return array
     */
    public function testCategoryValidateForInput()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('admin/categories/')
                ->type('name', '');
            $browser->press('Create')
                ->pause(1000)
                ->assertSee('The name field is required.');
        });
    }

    /**
     * List case for Test validate Exists Create Category
     *
     * @return array
     */
    public function testCategoryValidateExists()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('admin/categories/')
                ->type('name', 'A');
            $browser->press('Create')
                ->pause(1000)
                ->assertSee('The name has already been taken.');
        });
    }
}
