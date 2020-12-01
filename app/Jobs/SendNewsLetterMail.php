<?php

namespace App\Jobs;

use App\Mail\NewsLetterMail;
use App\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendNewsLetterMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subscriber;
    public $newsLetterData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscriber,$newsLetter)
    {
        $this->subscriber = $subscriber;
        $this->newsLetterData = $newsLetter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $email = new NewsLetterMail($this->newsLetterData);

        Mail::to($this->subscriber)->send($email);

        //Mail::to( $this->emailAddress)->send(new NewsLetterMail($setting->email));
    }
}
