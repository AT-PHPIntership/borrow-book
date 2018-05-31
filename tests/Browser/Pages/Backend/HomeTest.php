<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Post;
use App\Models\BorrowDetail;
use DB;
use Faker\Factory as Faker;

class HomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    const NUMBER_RECORD_CREATE = 20;
    const RECORD_LIMIT = 15;

    /**
    * Override function setUp() for make book login
    *
    * @return void
    */
    public function setUp()
    {
        $languages = ['English', 'VietNamese'];
        parent::setUp();
        
        factory(Category::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Book::class, self::NUMBER_RECORD_CREATE)->create();
        factory(User::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Post::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Borrow::class, self::NUMBER_RECORD_CREATE)->create();
        $borrowIds = DB::table('borrowes')->pluck('id')->all();
        $faker = Faker::create();
        factory(BorrowDetail::class, self::NUMBER_RECORD_CREATE)->create([
            'borrow_id' => $faker->randomElement($borrowIds),
        ]);
    }

    /**
     * Test URL Home Page.
     *
     * @return void
     */
    public function testURLHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/admin')
                ->clickLink('AdminLTE')
                ->assertSee('TOTAL');
        });
    }

    /**
     * Test value show on page.
     *
     * @return void
     */
    public function testValueOnHomePage()
    {
        $names = ['books', 'posts', 'borrowes'];
        $classes = ['total', 'last-week', 'last-month'];
        $this->browse(function (Browser $browser) use($names, $classes) {
            $browser->loginAs($this->user)
                ->visit('/admin');
            foreach ($classes as $class) {
                $browser->assertSeeIn(".$class-users", self::NUMBER_RECORD_CREATE + 1);
            }
            foreach ($classes as $class) {
                foreach ($names as $name) {
                    $browser->assertSeeIn(".$class-$name", self::NUMBER_RECORD_CREATE);
                }
            }
        });
    }
}
