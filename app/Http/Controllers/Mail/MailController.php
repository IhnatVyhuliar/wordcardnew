<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    public function main($email, $hash){
        $content=[
            'title'=>'Wordcard verifiaction mail',
            'body'=> 'Click the button below to verify your email address.',
            'url'=>$hash,
        ];
        Mail::to($email)->send(new VerificationMail($content));

        //dd('mail sent');
    }
    
}
