<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use DB;

use App\graph;
use Carbon\Carbon;
use App\Models\BudgetModel;
use Illuminate\Support\Facades\Input;

use App\Models\RemarksModel; 
use App\Models\BalanceModel;
use App\Models\UpdatesModel;
use App\Models\BlimitModel;
use App\limit;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Response;


use App\Mail\ApprovedMail;
use Illuminate\Support\Facades\Mail;

class ApproversController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {


        $amount = graph::where('created_at', '>=', Carbon::now()->firstOfYear())
                    ->selectRaw('MONTH as month, sum(market_cost) as market_cost')
                    ->groupBy('month')
                    ->pluck('market_cost', 'month');

        return view('approvers.home', compact('amount'));
    }




    public function edit_budget($id)
    {
        $branch_details = DB::table('branches')->where('branch_id', Auth::user()->branch_id_)->get();
        $budget_details = DB::table('budget')->where('budget_id', $id )->first();
        return view('approvers.edit', compact('budget_details','branch_details'));
    }




    public function edit_budget_post(Request $request, $id)
    { 
         $this->validate($request, [
            'market_cost' => 'required|numeric',
            'travelling_cost' => 'required|numeric',
            'fuel_cost' =>'required|numeric',
            'postage_cost' => 'required|numeric',
            'fax_cost' => 'required|numeric',
            'expected_premium' => 'required|numeric'
         ]);  
//store file

$file = $request['file_uploaded'];
$mime = $file->getClientOriginalExtension();
$now = Carbon::now();
$filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
$file->storeAs('\files',$filename_renamed);

    

    $user = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->select('*')->where('budget.budget_id', $id)->first();

    $limits = DB::table('limits')->where('user_id', $user->id )->first();

    $budget = DB::table('budget')->where('budget_id', $id )->first(); 


        $older_limits = BlimitModel::where('user_id', $user->id )->first();
        $older_limits->market_cost =  $limits->market_cost+$budget->market_cost;
        $older_limits->travelling_cost = $limits->travelling_cost+$budget->travelling_cost;
        $older_limits->fuel_cost = $limits->fuel_cost+$budget->fuel_cost;
        $older_limits->postage_cost = $limits->fax_cost+$budget->fax_cost;
        $older_limits->fax_cost = $limits->postage_cost+$budget->postage_cost;
        $older_limits->save();

    $old_limits = DB::table('old_limits')->where('user_id', $user->id )->first();

        $limits = limit::where('user_id', $user->id )->first();
        $limits->market_cost = $old_limits->market_cost-Input::get('market_cost');
        $limits->travelling_cost = $old_limits->travelling_cost-Input::get('travelling_cost');
        $limits->fuel_cost = $old_limits->fuel_cost-Input::get('fuel_cost');
        $limits->postage_cost = $old_limits->postage_cost-Input::get('postage_cost');
        $limits->fax_cost = $old_limits->fax_cost-Input::get('fax_cost');
        $limits->save();



        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->month = Input::get('month');
        $budget->market_cost = Input::get('market_cost');
        $budget->travelling_cost = Input::get('travelling_cost');
        $budget->fuel_cost = Input::get('fuel_cost');
        $budget->postage_cost = Input::get('postage_cost');
        $budget->fax_cost = Input::get('fax_cost');
        $budget->description =Input::get('output_description');
        $budget->file_name = $filename_renamed ;
        $budget->expected_premium = Input::get('expected_premium');
        $budget->budget_status = 'Edited by '.Auth::user()->name;
        $budget->save();

    $budget = DB::table('budget')->where('budget_id', $id )->first();

    
    $total = $budget->market_cost+$budget->travelling_cost+$budget->fuel_cost+$budget->postage_cost+$budget->fax_cost;

        $balance = BalanceModel::where('budget_id',$id)->first();
        $balance->total_cost = $total;
        $balance->save();



    return redirect('/approve/329382329383293823983238'.$id.'874393239328923982378923782739237')->with('success','Request Updated Successfully!');

    }




    public function view($id)
    {
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->get();
        
        return view('approvers.view', compact('show_budget_details'));
    }



    public function settle()
    {
        $remarks = DB::table('budget')->join('users', 'users.id', '=', 'budget.user_id')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->where('push_forward_date', NULL)->get();
        return view('approvers.settle', compact('remarks'));
    }

    public function settle_post($id)
    {

        $remarks = RemarksModel::where('remark_id', $id)->first();
        $remarks->reviewer = Auth::user()->name;
        $remarks->remark_status = 'Business Settled';
        $remarks->save();

        $b_id = DB::table('remarks')->where('remark_id', $id)->first();

        $approve = BudgetModel::where('budget_id', $b_id->budget_id )->first();
        $approve->business_status = 'Settled';
        $approve->save();

       return redirect()->back()->with('success','Congratulations, Business Settled');


    }


    public function budget_requests()
    { 

        $requests = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->select('*')->orderBy('budget.created_at', 'DESC')->get();
       
        return view('approvers.requests', compact('requests'));
        
    }



    public function report()
    {
        return view('approvers.reports');
    }
}
