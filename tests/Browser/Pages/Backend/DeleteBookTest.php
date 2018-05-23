<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Rating;

class DeleteBookTest extends DuskTestCase
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
        factory(Category::class,2)->create();
        $categoryId = DB::table('categories')->pluck('id')->all();
        $faker = Faker::create();
        factory(Book::class, 1)->create([
            'id' => 1,
            'category_id' => $faker->randomElement($categoryId),
        ]);
    }
    /**
     * Test Admin click button delete book in List Books
     *
     * @return void
     */
    public function testClickButtonDeleleBook()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/books')
                    ->assertSee('List Book')
                    ->click('td button.fa-trash-o')
                    ->assertDialogOpened('Are you sure you want to deleted?')
                    ->dismissDialog();
            $this->assertDatabaseHas('books',['deleted_at' => null]);
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
            $browser->loginAs($this->user)
                    ->visit('/admin/books');
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(1, $elements);
            $browser->click('td button.fa-trash-o')
                    ->assertDialogOpened('Are you sure you want to deleted?')
                    ->acceptDialog()
                    ->assertSee('Delete Book Success!');
            $this->assertDatabaseMissing('books', ['deleted_at' => null]);
            $this->assertDatabaseMissing('posts', ['deleted_at' => null]);
            $this->assertDatabaseMissing('ratings', ['book_id'=> 1]);
            $this->assertDatabaseMissing('favorites', ['book_id'=> 1]);
            $this->assertDatabaseMissing('image_books', ['book_id'=> 1]);
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(0, $elements);
        });
    }
}
