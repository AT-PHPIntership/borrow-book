<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowDetail;

class SendMailRecommendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::with('borrowes.borrowDetails')->whereNotNull('date_recommend')
            ->where('status_recommend', User::TURN_ON)
            ->get();
        \Log::info("Schedule sent mail to remined asdasd book");
        foreach ($users as $user) {
            $borrow = Borrow::where('user_id', $user->id)
                        ->get();
            $bookBorrowed = BorrowDetail::whereIn('borrow_id', $borrow->pluck('id'))->get()->implode('book_id', ', ')->toArray();
            \Log::info($bookBorrowed);
        }
    }
}
