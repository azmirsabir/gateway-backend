<?php


namespace App;


use Illuminate\Support\Facades\Mail;

class Helper
{
    public static function sendMail() {
        //kindly put your mail info
        try {
            $data = array('name'=>"Gateway");
            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to('azmirsabir1@gmail.com', 'Azmir Sabir')->subject
                ('Daily process');
                $message->from('azmirsabir@gmail.com','Azmir');
            });
            return "sent";
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
