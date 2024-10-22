<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Models\Application;

class MyAppController extends Controller
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

        if ($request->has('country')) {
            $country = $request->input('country');
        }
        if ($request->has('object')) {
            $object = $request->input('object');
        }

        $message = "<p>Hi!</p>";
        $message .= "<p>I`m $name from $country</p>";
        $message .= "<p>I`m interested in $object</p>";
        $message .= "<p>Call me to $tel</p>";

        $to_email = 'test@mail.ru';
        $subject = 'Recall me';

        Mail::html($message, function ($message) use($to_email, $subject, $country) {
            $message->to($to_email)
              ->subject($subject);
        });

        if(isset($validated['name']) && isset($validated['tel'])){

            $app = new Application();
            $app->name = $validated['name'];
            $app->tel = $validated['tel'];

            if ($request->has('country')) {
                $app->country = $request->input('country');
            }

            if ($request->has('object')) {
                $app->object = $request->input('object');
            }

            $app->save();

        }
     
    }
}
