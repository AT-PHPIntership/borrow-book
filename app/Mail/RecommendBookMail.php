<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Book;

class RecommendBookMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $bookRecommend;

    /**
     * Create a new message instance.
     *
     * @param Jobs\SendMailRecommendJob $user          user
     * @param Jobs\SendMailRecommendJob $bookRecommend bookRecommend
     *
     * @return void
     */
    public function __construct($user, $bookRecommend)
    {
        $this->user = $user;
        $this->bookRecommend = $bookRecommend;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.books.mailsRecommend')
            ->with([
                'user' => $this->user,
                'books' => $this->bookRecommend
            ]);
    }
}
