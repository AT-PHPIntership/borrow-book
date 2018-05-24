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

        factory(User::class)->create([
            'id' => 2,
            'email' => 'alone.hht@gmail.com',
            'name' => 'Ha',
            'identity_number' => 111,
            'dob' => '2018-12-12',
            'address' => 'da nang',
            'role' => User::ROLE_USER
        ]);

    }

      /**
     * Test Url Admin Edit Users.
     *
     * @return void
     */
    public function  testUrlEditUsers()
    {
        $user = User::find(2);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($this->user)
                    ->visit('/admin/users')
                    ->click('#table-index tbody tr:nth-child(2) .button-edit')
                    ->assertSee('Update users')
                    ->assertPathIs('/admin/users/'.$user->id.'/edit');
        });
    }
     /**
     * Test Users Edit Success.
     *
     * @return void
     */
    public function testEditUsersSuccess()
    {
        $user = User::find(2);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($this->user)
                ->visit('/admin/users/'.$user->id.'/edit')
                ->resize(900, 1000)
                ->assertSee('Update users')
                ->type('name',$user->name)
                ->press('Submit')
                ->assertSee('Successfully updated user!')
                ->assertPathIs('/admin/users');
        });
        $this->assertDatabaseHas('users', [
                        'name' => $user->name]);
    }
    /**
     * List case for Test validate for input Update User
     *
     * @return array
     */
   public function listCaseTestValidateForInput()
   {
       return [
           ['name', '', 'The name field is required.'],
           ['identity_number', '', 'The identity number field is required.'],
           ['dob', '', 'The dob does not match the format Y-m-d.'],
           ['address', '', 'The address must be a string.'],
           ['avatar', '','The avatar must be an image'],
           ['avatar', '','The avatar must be a file of type: png, jpg, jpeg'],
       ];
   }

   /**
    * Dusk test validate for input
    *
    * @param string $name    name of field
    * @param string $content content
    * @param string $message message show when validate
    * @param string $user    get value in table user
    *
    * @dataProvider listCaseTestValidateForInput
    *
    * @return void
    */
   public function testValidateForInput($name, $content,$message)
   {
        $user = User::find(1);
        $this->browse(function (Browser $browser) use ($name, $content, $message ,$user) {
            $browser->loginAs($this->user)
                ->visit('/admin/users/'.$user->id.'/edit')
                ->keys('#dob', '1996/02/09')
                ->pause(1000)
                ->attach('avatar', __DIR__.'/testing_file/ahihi.txt')
                ->type('identity_number', '')
                ->type('name', '')
                ->type('address', '');
            $browser->press('Submit')
               ->pause(3000)
               ->assertSee($message);
       });
   }

    
}
