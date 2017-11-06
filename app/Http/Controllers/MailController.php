<?php
namespace App\Http\Controllers;

use Mail;

class MailController
{
    /**
     * 全局发送最新链接
     * @param $email
     * @param $title
     * @param $link
     * @return bool
     */
    public function sendLink($email,$title,$link)
    {
        $date = date('Y年m月d日');
        $result = Mail::send('Mail.link',['link' => $link,'date' => $date],function($message) use($email,$title) {
            $message->subject($title);
            $message->to($email);
        });

        if (count(Mail::failures()) < 1) {
            return true;
        }else{
            return false;
        }
    }
}