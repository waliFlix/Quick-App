<?php

namespace App\Http\Controllers;

use App\Mail\TripMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Trip\Models\Trip;

class TripMailController extends Controller
{
    public function sendEmail(Trip $trip)
    {
       
       
        /**
         * To test this fetchers put your email 
         * insted of $trip->customer->email
         */
        Mail::to($trip->customer->email)->send(new TripMail($trip));

        return back()->with('success', 'تم ارسال البريد بنجاح ');
    }
}
