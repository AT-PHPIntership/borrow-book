<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use DB;
use Faker\Factory as Faker;
use Facebook\WebDriver\WebDriverBy;

class UpdateUserTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        factory(User::class, 2)->create();

    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function  testEditUserSuccess()
    {
        $user = User::findOrFail(1);
        // dd($user->id);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('route(admin.users.edit, ["user" => $user->id])')
                    ->assertSee('Update users');
        });
    }
    /**
     *List case for test validation Edit Users
     *
     *@return array
     */
    
}
