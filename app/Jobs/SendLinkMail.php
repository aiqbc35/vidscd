<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendLinkMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $title;
    protected $link;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$title,$link)
    {
        $this->email = $email;
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = date('Y年m月d日');
        Mail::send('Mail.link',['link' => $this->link,'date' => $date],function($message) {
            $message->subject($this->title);
            $message->to($this->email);
        });
    }
}
