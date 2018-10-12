<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

use Auth;
use DB;

class ApproveBudgetMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
//sends mail
   // $b_details = DB::table('budget')->join('users', 'users.id', '=', 'budget.user_id')->select('*')->where('budget_id', $id)->first();
/*
        $details = new \stdClass();
        $details->owner_name = $b_details->name;
        $details->id = $id;
        $details->approver = Auth::user()->name; */


        return $this->view('mails.approve_budget')
       // ->with('name', Auth::user()->name );
      //  ->with('owner_name', $b_details->name )
        //->with('b_id', $b_details->budget_id )
        ->with('prev_approved', Auth::user()->name);

    }
}
