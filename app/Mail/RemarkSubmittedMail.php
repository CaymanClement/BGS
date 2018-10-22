<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;
use DB;


class RemarkSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id;

    public function __construct($id)
    {
       $this->id = $id;
    }


    public function build()
    {
      
//sends mail
$b_details = $requests = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->where('budget_id', $this->id)->select('*')->first();
$total = $b_details->market_cost+$b_details->travelling_cost+$b_details->fuel_cost+$b_details->postage_cost+$b_details->fax_cost;

$msg = DB::table('approvals')->where('budget_id', $this->id)->where('category', '=', 'Approved by:')->first();

          return $this->view('mails.remark_submitted')
         ->with('msg', $msg->comment )
         ->with('name', $b_details->name )
         ->with('budget_id', $b_details->budget_id )
         ->with('quatre', $b_details->quarter )
         ->with('total_cost', $total )
         ->with('place', $b_details->place )
         ->with('expected_premium', $b_details->expected_premium )
        ->with('prev_approved', Auth::user()->name);
    }
}
