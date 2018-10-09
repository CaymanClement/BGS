<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use DB;

class ApprovedMail extends Mailable
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
        $budget_details = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->select('*')->get();
        
        return $this->view('mails.approved')
        ->with('name', $budget_details->name )
        ->with('name', $budget_details->name )
        ->with('name', $budget_details->name )
        ->with('name', $budget_details->name );
    }
}
