<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;

class StudentMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $student;

    // public function __construct(Student $student)
    // {
    //     $this->student = $student;
    // }

    public function build()
    {
        return $this->subject('Welcome to Our Platform')
                    ->view('emails.student_mail')  // Make sure this path is correct
                    ->with(['student' => "jih"]);
    }
}
