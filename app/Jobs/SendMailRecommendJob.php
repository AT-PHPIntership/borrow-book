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
use Carbon\Carbon;
use App\Mail\RecommendBookMail;
use Mail;

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
        $today = Carbon::parse(Carbon::today());
        $users = User::with('borrowes.borrowDetails')->whereNotNull('date_recommend')
            ->where('date_recommend', $today->dayOfWeek)
            ->where('flag_recommend', User::TURN_ON)
            ->get();
        \Log::info('Schedule send mail to recommend book for you');
        foreach ($users as $user) {
            $bookBorrowed = BorrowDetail::with(['book'])
                        ->whereIn('borrow_id', Borrow::where('user_id', $user->id)->get()->pluck('id'))
                        ->get()->unique('book_id')->pluck('book_id');
            $categoryIds = Book::whereIn('id', $bookBorrowed)->get()->pluck('category_id');
            $bookRecommend = Book::with('category', 'imageBooks')->whereNotIn('id', $bookBorrowed)
                        ->whereIn('category_id', $categoryIds)
                        ->orWhereYear('publishing_year', $today->year)
                        ->orWhereBetween('total_rate', [3, 5])
                        ->get();
            Mail::to($user->email)->send(new RecommendBookMail($user, $bookRecommend));
            \Log::info($bookRecommend);
        }
    }
}
