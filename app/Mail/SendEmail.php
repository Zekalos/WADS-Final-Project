<?php



namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $firstname;
    public $lastname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firstname , $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('relaxchat04@gmail.com')
                   ->view('Confirmation.emailverification')
                   ->with(
                    [
                        'website' => 'RelaxnChat',
                    ]);
    }
}
