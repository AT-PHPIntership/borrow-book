<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowListUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testShowList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/users')
                    ->assertSee('List Users');
        });
    }
}
