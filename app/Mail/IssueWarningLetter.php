<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class IssueWarningLetter extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $manager;
    public $departmentName;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $manager
     * @param  string  $departmentName
     * @return void
     */
    public function __construct(User $user, User $manager, string $departmentName)
    {
        $this->user = $user;
        $this->manager = $manager;
        $this->departmentName = $departmentName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Attendance Warning Letter')
                    ->view('emails.issue_warning_letter');
    }
}
