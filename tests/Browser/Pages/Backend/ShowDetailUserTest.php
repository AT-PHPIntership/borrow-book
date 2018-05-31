<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use DB;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\BorrowDetail;
use Faker\Factory as Faker;

class ShowDetailUserTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
    * Override function set up database
    *
    * @return void
    */
    public function setUp()
    {
        $faker = Faker::create();
        parent::setUp();
        factory(User::class)->create([
            'id' => 2,
            'email' => 'haytranngoc@gmail.com',
            'name' => 'Jay N',
            'address' => 'ABCXYZ A'
        ]);
        factory(Category::class, 2)->create();
        factory(Book::class, 2)->create();
        factory(Borrow::class)->create();
        $borrowId = DB::table('borrowes')->pluck('id')->all();
        $bookIds = DB::table('books')->pluck('id')->all();
        factory(BorrowDetail::class)->create([
            'borrow_id' => $faker->randomElement($borrowId),
            'book_id' => $faker->randomElement($bookIds)
        ]);

    }

    /**
     * A Dusk test click button detail user
     *
     * @return void
     */
    public function testClickButtonDetailUser()
    {
        $user = User::findOrFail(2);
        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($this->user)
                ->visit('/admin/users')
                ->click('.table tbody tr:nth-child(2) .button-info')
                ->assertPathIs('/admin/users/'.$user->id)
                ->assertSee('User Detail');
        });
    }

    /**
     * A Dusk test Show Detail User
     *
     * @return void
     */
    public function testShowDetailUser()
    {
        $user = User::findOrFail(2);
        $borrowes = Borrow::with('borrowDetails.book')
                        ->where('user_id', $user->id)
                        ->orderBy('status', 'asc')->get();
        $this->browse(function (Browser $browser) use ($user, $borrowes) {
            $browser->loginAs($this->user)
                ->visit('/admin/users/' . $user->id)
                ->pause(1000);
            $this->assertTrue($browser->text('.name') === $user->name);
            $this->assertTrue($browser->text('.email') === $user->email);
            $this->assertTrue($browser->text('.identity-number') === $user->identity_number);
            $this->assertTrue($browser->text('.dob') === $user->dob);
            $this->assertTrue($browser->text('.address') === $user->address);
            foreach ($borrowes as $borrow) {
                $this->assertTrue($browser->text('.from-date') === $borrow->form_date);
                $this->assertTrue($browser->text('.to-date') === $borrow->to_date);
            }
        });
    }
}
