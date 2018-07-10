<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Borrow;

class BorrowedBookMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $borrow;

    /**
     * Create a new message instance.
     *
     * @param Http\Models\Borrow $borrow borrow
     *
     * @return void
     */
    public function __construct(Borrow $borrow)
    {
        $this->borrow = $borrow;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.borrows.mailsBorrowed')
            ->with(['borrow' => $this->borrow]);
    }
}
