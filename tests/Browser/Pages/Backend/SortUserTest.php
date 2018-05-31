<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class SortUserTest extends DuskTestCase
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
        factory(User::class,16)->create();
    }

     /*
     * A Dusk test for click link sort
     *
     * @return void
     */
    public function testClickLinksSort()
    { 
        $sortNames = ['name', 'email'];
        $this->browse(function (Browser $browser) use ($sortNames) {
            $browser->loginAs($this->user)
                ->visit('/admin/users');
            foreach ($sortNames as $name) {
                $browser->click("#link-sort-$name a")
                    ->assertQueryStringHas('sort', $name)
                    ->assertQueryStringHas('order', 'asc')
                    ->click("#link-sort-$name a")
                    ->assertQueryStringHas('sort', $name)
                    ->assertQueryStringHas('order', 'desc');
            }
        });
    }

    /**
     * Make cases for test.
     *
     * @return array
     */
    public function dataForTest()
    {
        return [
            ['name', 'users.name', 2],
            ['email', 'users.email', 3],
        ];
    }

    /**
     * A Dusk test data sort list user by name
     * 
     * @dataProvider dataForTest
     *
     * @return void
     */
    public function testSortListUser($name, $order, $columnIndex)
    {
        $this->browse(function (Browser $browser) use ($order, $name, $columnIndex) {
            $browser->loginAs($this->user)
                ->visit('admin/users')
                ->resize(1200,1600)
                ->click("#link-sort-$name a");
            //Test list user Desc
            $arrayAsc = DB::table('users')->orderBy($order,'asc')->pluck($name)->toArray();
            for ($i = 1; $i <= 15; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columnIndex)";
                $this->assertEquals($browser->text($selector), $arrayAsc[$i - 1]);
            }
            //Test list user Desc
            $browser->click("#link-sort-$name a");
            $arrayDesc = DB::table('users')->orderBy($order,'desc')->pluck($name)->toArray();
            for ($i = 1; $i <= 15; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columnIndex)";
                $this->assertEquals($browser->text($selector), $arrayDesc[$i - 1]);
            }
        });
    }

    /**
     * A Dusk test data when panigate.
     *
     * @dataProvider dataForTest
     *
     * @return void
     */
     public function testSortListUsersWhenPanigate($name, $order, $columnIndex)
    {
        $this->browse(function (Browser $browser) use ( $order, $name, $columnIndex) {
            $browser->loginAs($this->user)
                ->visit('admin/users')
                ->resize(1200,1600)
                ->click("#link-sort-$name a")
                ->clickLink("2");
            // Test list Asc
            $arrayAsc = DB::table('users')->orderBy($order,'asc')->pluck($name)->toArray();
            $arraySortAsc = array_chunk($arrayAsc, 15)[1];
            for ($i = 1; $i <= 2; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columnIndex)";
                $this->assertEquals($browser->text($selector), $arraySortAsc[$i - 1]);
            }
            // Test list Desc
            $browser->click("#link-sort-$name a")
                ->clickLink("2");
            $arrayDesc = DB::table('users')->orderBy($order,'desc')->pluck($name)->toArray();
            $arraySortDesc = array_chunk($arrayDesc, 15)[1];
            for ($i = 1; $i <= 2; $i++) {
                $selector = "#table-index tbody tr:nth-child($i) td:nth-child($columnIndex)";
                $this->assertEquals($browser->text($selector), $arraySortDesc[$i - 1]);
            }
        });
    }
}
