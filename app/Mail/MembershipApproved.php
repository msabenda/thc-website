<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $membershipId;

    public function __construct(Application $application, string $membershipId)
    {
        $this->application = $application;
        $this->membershipId = $membershipId;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your THC Membership Has Been Approved!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.membership-approved',
        );
    }
}