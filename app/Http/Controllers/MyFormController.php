<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class MyFormController extends Controller
{
    public function store(Request $request){

        $validated = validator(request()->post(), [
            'name' => ['required', 'string', 'max:100'],
            'tel' => ['required', 'numeric', 'min:10'],
        ])-> validate();

        $name = "Undefined name";

        if(isset($validated['name'])){
            $name = $validated['name'];
        }

        if(isset($validated['tel'])){
            $tel = $validated['tel'];
        }

        $message = "<p>Hi!</p>";
        $message .= "<p>I`m $name</p>";
        $message .= "<p>Call me to $tel</p>";

        $to_email = 'test@mail.ru';
        $subject = 'Recall me';

        Mail::html($message, function ($message) use($to_email, $subject) {
            $message->to($to_email)
              ->subject($subject);
        });

    }

}
