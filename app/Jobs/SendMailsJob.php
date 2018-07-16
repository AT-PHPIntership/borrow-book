<?php

namespace App\Jobs;

use Mail;
use Carbon\Carbon;
use App\Models\Borrow;
use App\Mail\BorrowedBookMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailsJob implements ShouldQueue
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
        $borrows = Borrow::with('borrowDetails.book', 'user')
            ->where('status', Borrow::BORROWING)
            ->whereDate('to_date', '<=', Carbon::today())
            ->whereNull('date_send_mail')->get();
        \Log::info("Schedule sent mail to remined borrow book");
        foreach ($borrows as $borrow) {
            try {
                \Log::info("Start send mail to: " . $borrow->user->email . ', id: ' . $borrow->id);
                Mail::to($borrow->user->email)->send(new BorrowedBookMail($borrow));
                $borrow->date_send_mail = Carbon::now();
                $borrow->save();
                \Log::info("Complete Send Mail");
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                continue;
            }
        }
    }
}
