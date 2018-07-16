<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Borrow;
use Carbon\Carbon;

class SendMailReminderTest extends DuskTestCase
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

        factory(User::class)->create();
        factory(Borrow::class)->create([
            'id' => 1,
            'status' => Borrow::BORROWING,
            'to_date' => Carbon::today()->subDay(),
        ]);
        factory(Borrow::class)->create([
            'id' => 2,
            'status' => Borrow::GIVE_BACK,
            'to_date' => Carbon::today()->subDay(),
        ]);
        Artisan::call('remind-borrow-expire:users');
    }

    /**
     * Dusk test send mail reminder
     *
     * @return void
     */
    public function testSendMailReminder()
    {   
        $this->assertDatabaseHas('borrowes', [
            'id' => 1,
            'date_send_mail' => Carbon::today()
        ]);
        $this->assertDatabaseHas('borrowes', [
            'id' => 2,
            'date_send_mail' => null
        ]);
    }
}
