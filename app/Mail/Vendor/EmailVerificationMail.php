<?php

namespace App\Mail\Vendor;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\VendorEmailVerify;
use App\Vendor;
class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $vendor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VendorEmailVerify $data, Vendor $vendor)
    {
        //
        $this->data = $data;
        $this->vendor = $vendor;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('assets.mail.vendor.EmailVerification');
    }
}
