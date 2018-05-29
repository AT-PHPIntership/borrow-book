<?php

namespace Tests\Browser\Pages\Backend;

use App\Models\User;
use App\Models\Post;
use App\Models\Borrow;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\BorrowDetail;
use App\Models\Book;
use App\Models\Category;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
        factory(User::class)->create([
            'id' => 2,
            'email' => 'alone.hht@gmail.com',
            'name' => 'Ha',
            'identity_number' => 111,
            'dob' => '2018-12-12',
            'address' => 'da nang',
            'role' => User::ROLE_USER
        ]);
        factory(Category::class,2)->create();
        factory(Book::class,2)->create();
        factory(Post::class,2)->create();
        factory(Favorite::class,2)->create();
        factory(Rating::class,2)->create();
        factory(Borrow::class,2)->create();
        $borrowId = DB::table('borrowes')->pluck('id')->all();
        $faker = Faker::create();
        factory(BorrowDetail::class,2)->create([
            'borrow_id' => $faker->randomElement($borrowId),
        ]);
    }

    /**
     * Test button delete book in List Users
     *
     * @return void
     */
    public function testClickButtonDeleleUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->assertSee('List Users')
                ->click('.form-delete .button-delete')
                ->assertDialogOpened('Are you sure?')
                ->dismissDialog();
            $this->assertDatabaseHas('users', ['id' => 2, 'deleted_at' => null]);
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
                ->visit('/admin/users')
                ->click('.form-delete .button-delete')
                ->assertDialogOpened('Are you sure?')
                ->acceptDialog()
                ->assertSee('Successfully deleted user!');
            $this->assertDatabaseMissing('users', ['id' => 2, 'deleted_at' => null])
                ->assertDatabaseMissing('posts', ['user_id'=> 2, 'deleted_at' => null])
                ->assertDatabaseMissing('ratings', ['user_id'=> 2])
                ->assertDatabaseMissing('favorites', ['user_id'=> 2])
                ->assertDatabaseMissing('borrowes', ['user_id'=> 2, 'deleted_at' => null]);
        });
    }

}
