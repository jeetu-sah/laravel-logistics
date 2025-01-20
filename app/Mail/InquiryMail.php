<?php
namespace App\Mail;
use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;

    /**
     * Create a new message instance.
     *
     * @param array $inquiry
     */
    public function __construct($inquiry)
    {
        // Store the inquiry data
        $this->inquiry = $inquiry;
        // echo "<pre>";print_r($inquiryData);exit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Check if the inquiry data exists
        if (is_null($this->inquiry)) {
            throw new \Exception('Inquiry data is null');
        }

        // Pass the data to the view
        return $this->view('email.inquiryMail')
            ->with(['name' => $this->inquiry['name'], 'email' => $this->inquiry['email']]) // Pass the inquiry data to the view
            ->subject('Thank You for Your Submission');
    }
}
