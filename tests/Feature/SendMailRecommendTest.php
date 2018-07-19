<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecommendBookMail;
use App\Models\User;
use Artisan;
use Carbon\Carbon;

class SendMailRecommendTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * This function is called before testcase
     */
    public function setUp()
    {
        parent::setUp();
        factory(User::class, 2)->create([
            'date_recommend' => Carbon::parse(Carbon::today())->dayOfWeek,
            'flag_recommend' => User::TURN_ON
        ]);
    }

    /**
     * Test send mail queue success
     */
    public function testSendMailRecommendSuccess()
    {
        Mail::fake();
        Artisan::call('recommend-book:users');
        Mail::assertSent(RecommendBookMail::class);
    }

    /**
     * Test send mail queue success
     */
    public function testSendMailRecommendFail()
    {
        Carbon::setTestNow(Carbon::today()->addDay());
        Mail::fake();
        Artisan::call('recommend-book:users');
        Mail::assertNotSent(RecommendBookMail::class);
    }
}
