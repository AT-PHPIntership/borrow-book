<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStatusBorrowMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Http\Controllers\Admin\BorrowController $data data
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.borrows.mails')
            ->with(
                [
                    'name' => $this->data['name'],
                    'from_date' => $this->data['from_date'],
                    'to_date' => $this->data['to_date'],
                    'status' => $this->data['status'],
                    'borrow_details' => $this->data['borrow_details']
                ]
            );
    }
}
