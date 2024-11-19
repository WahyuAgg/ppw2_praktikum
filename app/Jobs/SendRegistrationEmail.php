<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationNotification;
use Illuminate\Mail\Mailable;
use App\Mail\SendEmail;

class SendRegistrationEmail implements ShouldQueue
{
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function handle()
    {
        Mail::to($this->user->email)->send(new RegistrationNotification($this->user));
    }
}
