<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use App\User;
use App\FileModel; //testing
use App\limit;
use App\Models\ApprovalsModel;
use App\Models\BudgetModel;
use App\Models\RemarksModel; 
use App\Models\BalanceModel;
use App\Models\UpdatesModel;
use App\Models\BlimitModel;
use App\Models\ImplementationModel;
use App\graph;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Response;

use App\Mail\ApprovedMail;
use App\Mail\ApproveBudgetMail;
use App\Mail\RejectedMail;
use App\Mail\RemarkSubmittedMail;
use App\Mail\ReturnedMail;
use Illuminate\Support\Facades\Mail;

//for file ---------------------
use Session;
use Excel;
//--------------------------------



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $amount = graph::where('created_at', '>=', Carbon::now()->firstOfYear())
                    ->selectRaw('MONTH as month, sum(market_cost) as market_cost')
                    ->groupBy('month')
                    ->pluck('market_cost', 'month');


        $balance1 = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->count();

        $balance = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->orderBy('budget.updated_at', 'desc')->first();

        $limits = DB::table('limits')->where('user_id', Auth::user()->id)->first();

        $balancey = $limits->market_cost+$limits->travelling_cost+$limits->fuel_cost+$limits->fax_cost+$limits->postage_cost;

        if($balance1<1){
        $balance = new BalanceModel;
        $balance->resultant_balance = '0';
         return view('home', compact('balance','amount'));
        }

        $count_unsettled = DB::table('budget')->where('user_id', Auth::user()->id )->where('budget_status','=','Approved')->count();

        $count_unsettled_activities = DB::table('implementation')->join('budget', 'budget.budget_id', '=', 'implementation.budget_id')->join('users', 'budget.user_id', '=', 'users.id')->where('implementation.status', '=', 'Not Settled')->where('budget.user_id', Auth::user()->id )->count();

        $count_pushed = DB::table('implementation')->join('budget', 'budget.budget_id', '=', 'implementation.budget_id')->join('users', 'budget.user_id', '=', 'users.id')->where('implementation.status', '=', 'Pushed Forward')->where('budget.user_id', Auth::user()->id )->count();

        $count_unapproved = DB::table('budget')->where('user_id', Auth::user()->id )->where('budget_status','!=','Approved')->count();


        return view('home', compact('balance','amount','count_pushed','count_unsettled','count_unsettled_activities', 'count_unapproved','balancey'));
    }

    public function add()
    {
        $limits = DB::table('limits')->where('user_id', Auth::user()->id )->first();

        $balance1 = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->count();

        $balance = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->orderBy('budget.updated_at', 'desc')->first();


        $branch_details = DB::table('branches')->where('branch_id', Auth::user()->branch_id_)->get();
        $reviewer_list = DB::table('users')->where( 'title','=','HFA' )->orWhere('title','=','PFA')->get();

       if($balance1<1){
        $balance = new BalanceModel;
        $balance->resultant_balance = '0';
          return view('add', compact('branch_details','reviewer_list','balance','limits'));
        }

        return view('add', compact('branch_details','reviewer_list','balance','limits'));
    }






    public function add_post(Request $request)
    {




    $limits = DB::table('limits')->where('user_id', Auth::user()->id )->first();

         $this->validate($request, [
            'market_cost' => 'required|numeric',
            'travelling_cost' => 'required|numeric',
            'fuel_cost' =>'required|numeric',
            'postage_cost' => 'required|numeric',
            'fax_cost' => 'required|numeric',
            'expected_premium' => 'required|numeric',
         ]);  


  
    $branch_details = DB::table('branches')->where('branch_id', Auth::user()->branch_id_)->get();


    $budget_record = DB::table('budget')->where('user_id', Auth::user()->id )->where('business_status','=','Not settled')->orWhere('business_status','=','Pushed Forward')->count();

    if($budget_record>'1'){

        return redirect()->back()->withInput(Input::all())->withInput(Input::all())->with('failure','Sorry you still have an Unsettled Business. Navigate to "My Requests" to see.');
    }

    if(Input::get('market_cost')>$limits->market_cost){

        return redirect()->back()->withInput(Input::all())->with('failure','Sorry the market cost exceeds the limit of '.$limits->market_cost);
    }

    if(Input::get('travelling_cost')>$limits->travelling_cost){

        return redirect()->back()->withInput(Input::all())->with('failure','Sorry the Travelling cost exceeds the limit of '.$limits->travelling_cost);
    }

    if(Input::get('fuel_cost')>$limits->fuel_cost){

        return redirect()->back()->withInput(Input::all())->with('failure','Sorry the Fuel cost exceeds the limit of '.$limits->fuel_cost);
    }

    if(Input::get('postage_cost')>$limits->postage_cost){

        return redirect()->back()->withInput(Input::all())->with('failure','Sorry the Postage cost exceeds the limit of '.$limits->postage_cost);
    }

    if(Input::get('fax_cost')>$limits->fax_cost){

        return redirect()->back()->withInput(Input::all())->with('failure','Sorry the Fax cost exceeds the limit of '.$limits->fax_cost);
    }

   $balance = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->orderBy('budget.updated_at', 'desc')->first();

  $balance_count = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('balance_id')->orderBy('budget.updated_at', 'desc')->groupBy('balance.budget_id')->count();


//store file

$file = $request['file'];
$mime = $file->getClientOriginalExtension();
$now = Carbon::now();
$filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
$file->storeAs('\files',$filename_renamed);

if($mime != 'xls'){
        return redirect()->back()->withInput(Input::all())->with('failure','Please check File Format. Only Excel "xls" format allowed');
}


   if(Input::get('month')=='January' || Input::get('month')=='February' || Input::get('month')=='March'){


    DB::table('budget')->insert( array(

            'user_id' => Auth::user()->id,
            'month' => Input::get('month'),
            'place' => Input::get('place'),
            'market_cost' => Input::get('market_cost'),
            'travelling_cost' => Input::get('travelling_cost'),
            'fuel_cost' => Input::get('fuel_cost'),
            'postage_cost' => Input::get('postage_cost'),
            'fax_cost' => Input::get('fax_cost'),
            'budget_status' => 'created',
            'business_status' => 'Not settled',
            'description' => Input::get('output_description'),
            'expected_premium' => Input::get('expected_premium'),
            'carry_over_balance' => '0',
            'first_approval' => Input::get('reviewer'),
            'file_name' => $filename_renamed ,
            'file_name' => $filename_renamed ,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
            'quarter' => '1'   ));


            }


        elseif(Input::get('month')=='April' || Input::get('month')=='May' || Input::get('month')=='June'){
/*
        $file = $request['file'];
        $mime = $file->getClientOriginalExtension();
        $now = Carbon::now();
        $filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
        $file->storeAs('\files',$filename_renamed);

*/

        DB::table('budget')->insert( array(

            'user_id' => Auth::user()->id,
            'month' => Input::get('month'),
            'place' => Input::get('place'),
            'market_cost' => Input::get('market_cost'),
            'travelling_cost' => Input::get('travelling_cost'),
            'fuel_cost' => Input::get('fuel_cost'),
            'postage_cost' => Input::get('postage_cost'),
            'fax_cost' => Input::get('fax_cost'),
            'budget_status' => 'created',
            'business_status' => 'Not settled',
            'description' => Input::get('output_description'),
            'expected_premium' => Input::get('expected_premium'),
            'carry_over_balance' => '0',
            'first_approval' => Input::get('reviewer'),
            'file_name' => $filename_renamed ,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
            'quarter' => '2'   ));
            }
            elseif(Input::get('month')=='July' || Input::get('month')=='August' || Input::get('month')=='September'){
/*
        $file = $request['file'];
        $mime = $file->getClientOriginalExtension();
        $now = Carbon::now();
        $filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
        $file->storeAs('\files',$filename_renamed);

*/

        DB::table('budget')->insert( array(

            'user_id' => Auth::user()->id,
            'month' => Input::get('month'),
            'place' => Input::get('place'),
            'market_cost' => Input::get('market_cost'),
            'travelling_cost' => Input::get('travelling_cost'),
            'fuel_cost' => Input::get('fuel_cost'),
            'postage_cost' => Input::get('postage_cost'),
            'fax_cost' => Input::get('fax_cost'),
            'budget_status' => 'created',
            'business_status' => 'Not settled',
            'description' => Input::get('output_description'),
            'expected_premium' => Input::get('expected_premium'),
            'carry_over_balance' => '0',
            'first_approval' => Input::get('reviewer'),
            'file_name' => $filename_renamed ,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),            
            'quarter' => '3'   ));
            }
            else{
/*
        $file = $request['file'];
        $mime = $file->getClientOriginalExtension();
        $now = Carbon::now();
        $filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
        $file->storeAs('\files',$filename_renamed);

*/

        DB::table('budget')->insert( array(

            'user_id' => Auth::user()->id,
            'month' => Input::get('month'),
            'place' => Input::get('place'),
            'market_cost' => Input::get('market_cost'),
            'travelling_cost' => Input::get('travelling_cost'),
            'fuel_cost' => Input::get('fuel_cost'),
            'postage_cost' => Input::get('postage_cost'),
            'fax_cost' => Input::get('fax_cost'),
            'budget_status' => 'created',
            'business_status' => 'Not settled',
            'description' => Input::get('output_description'),
            'expected_premium' => Input::get('expected_premium'),
            'carry_over_balance' => '0',
            'first_approval' => Input::get('reviewer'),
            'file_name' => $filename_renamed ,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
            'quarter' => '4'   ));
            }
      

    $created_id = DB::getPdo()->lastInsertId();

    DB::table('approvals')->insert( array(

            'budget_id' => $created_id,
            'category' => 'Reviewed by:',
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  NULL,
        ));

    DB::table('approvals')->insert( array(

            'budget_id' => $created_id,
            'category' => 'Recommended for budget by:',
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  NULL,
        ));

    DB::table('approvals')->insert( array(

            'budget_id' => $created_id,
            'category' => 'Recommended for activity by:',
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  NULL,
        ));

    DB::table('approvals')->insert( array(

            'budget_id' => $created_id,
            'category' => 'Approved by:',
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  NULL,
        ));

//use update method 
if($balance_count>1){
$total =  Input::get('market_cost')+Input::get('travelling_cost')+Input::get('fuel_cost')+Input::get('postage_cost')+Input::get('fax_cost')-$balance->resultant;

    DB::table('balance')->insert( array(

            'budget_id' => $created_id,
            'total_cost' => $total,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));
}

else{
$total_cst =  Input::get('market_cost')+Input::get('travelling_cost')+Input::get('fuel_cost')+Input::get('postage_cost')+Input::get('fax_cost');

    DB::table('balance')->insert( array(

            'budget_id' => $created_id,
            'total_cost' => $total_cst,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));
}

//Update Limits
        $limits = limit::where('user_id', Auth::user()->id )->first();
        $limits->market_cost = $limits->market_cost-Input::get('market_cost');
        $limits->travelling_cost = $limits->travelling_cost-Input::get('travelling_cost');
        $limits->fuel_cost = $limits->fuel_cost-Input::get('fuel_cost');
        $limits->fax_cost = $limits->fax_cost-Input::get('fax_cost');
        $limits->postage_cost = $limits->postage_cost-Input::get('postage_cost');
        $limits->save();

//Enter data from file to DB

$mime = $file->getClientOriginalExtension();
$path = $request->file->getRealPath();
$results=Excel::load($path)->get();

foreach ($results as $rows) {
foreach ($rows as $row) {

    if($row->date == ''){
         
    return redirect('/requests')->with('success', 'Budget Submitted Successfully!');

    }

    ImplementationModel::create([
        'budget_id' => $created_id,
        'date_of_visit'  => $row->date,
        'activities'  => $row->activities, 
        'place'  => $row->place,
        'total_cost'  => $row->total,
        'description'  => $row->description,
        'expected_premium'  => $row->expected_premium,
        'bgen_date'  => $row->business_generation_date,
    ]);
 }
 }

 
    return redirect('/requests')->with('success', 'Budget Submitted Successfully...........');

    }





    public function requests()
    {
        $list_requests = DB::table('budget')->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

        return view('requests', compact('list_requests'));
    }


        public function add_validate()
    {


    $budget_record = DB::table('budget')->where('user_id', Auth::user()->id )->where('business_status','=','Not settled')->orWhere('business_status','=','Pushed Forward')->count();

        if($budget_record>'1'){

            return redirect('/requests')->with('failure','Sorry you still have an Unsettled Business');
        }

    else{


        $limits = DB::table('limits')->where('user_id', Auth::user()->id )->first();

        $balance1 = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->count();

        $balance = DB::table('balance')->join('budget', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id)->select('*')->orderBy('budget.updated_at', 'desc')->first();


        $branch_details = DB::table('branches')->where('branch_id', Auth::user()->branch_id_)->get();
        $reviewer_list = DB::table('users')->where( 'title','=','HFA' )->orWhere('title','=','PFA')->get();

    /*   if($balance1<1){
        $balance = new BalanceModel;
        $balance->resultant_balance = '0';
          return view('add', compact('branch_details','reviewer_list','balance','limits'));
        } */

        return redirect('/add-view')->with('limits', $limits)->with('balance1', $balance1)->with('balance', $balance)->with('branch_details', $branch_details)->with('reviewer_list', $reviewer_list);
  }
    }



    public function reports()
    {
         //$budget_details = DB::table('budget')->where('user_id', Auth::user()->id )->get();

         $budget_details = DB::table('budget')->join('balance', 'balance.budget_id', '=' , 'budget.budget_id')->where('budget.user_id', Auth::user()->id )->get();

         return view('report', compact('budget_details'));
    }




    public function follow($id)
    {
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->get();
        
        $show_reviewer = DB::table('approvals')->join('users', 'users.id', '=', 'approvals.approving_user_id')->where('budget_id', $id )->select('*')->get();
       
        $show_status = DB::table('approvals')->where('budget_id', $id )->where('category','=','Approved by:')->where('status','=','Approved')->orWhere('status','=','On Approval')->count();
        $total = DB::table('balance')->where('budget_id', $id )->first();

        $remarks_details = DB::table('remarks')->where('budget_id', $id )->first();

    $approvals_details_count = DB::table('approvals')->where('budget_id', $id )->where('status','=','Approved')->count();

        $budget_id = $id;

        $implementation = DB::table('implementation')->where('budget_id', $id )->get();
     
    $impl_count = DB::table('implementation')->where('budget_id', $id )->where('status','=','Not Settled')->orWhere('status','=','Pushed Forward')->count();
     
        $branch = DB::table('branches')->where('branch_id', Auth::user()->branch_id_ )->first();
        return view('follow', compact('show_budget_details','show_reviewer','show_status','total','branch','budget_id','remarks_details','approvals_details_count','implementation','impl_count'));
    }






    public function edit_budget($id)
    {
        $branch_details = DB::table('branches')->where('branch_id', Auth::user()->branch_id_)->get();
        $budget_details = DB::table('budget')->where('budget_id', $id )->first();
        return view('edit_budget', compact('budget_details','branch_details'));
    } 




    public function update_budget(Request $request, $id)
    {

    $limits = DB::table('limits')->where('user_id', Auth::user()->id )->first();
    $budget = DB::table('budget')->where('budget_id', $id )->first();


         $this->validate($request, [
            'market_cost' => 'required|numeric',
            'travelling_cost' => 'required|numeric',
            'fuel_cost' =>'required|numeric',
            'postage_cost' => 'required|numeric',
            'fax_cost' => 'required|numeric',
            'expected_premium' => 'required|numeric'
         ]);      

$file = $request['file'];
$mime = $file->getClientOriginalExtension();
$now = Carbon::now();
$filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
$file->storeAs('\files',$filename_renamed);

if($mime != 'xls'){
        return redirect()->back()->withInput(Input::all())->with('failure','Please check File Format. Only Excel "xls" format allowed');
}

        $older_limits = BlimitModel::where('user_id', Auth::user()->id )->first();
        $older_limits->market_cost =  $limits->market_cost+$budget->market_cost;
        $older_limits->travelling_cost = $limits->travelling_cost+$budget->travelling_cost;
        $older_limits->fuel_cost = $limits->fuel_cost+$budget->fuel_cost;
        $older_limits->postage_cost = $limits->fax_cost+$budget->fax_cost;
        $older_limits->fax_cost = $limits->postage_cost+$budget->postage_cost;
        $older_limits->save();

    $old_limits = DB::table('old_limits')->where('user_id', Auth::user()->id )->first();

        $limits = limit::where('user_id', Auth::user()->id )->first();
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
        $budget->expected_premium = Input::get('expected_premium');
        $budget->file_name = $filename_renamed ;
        $budget->budget_status = 'Edited';
        $budget->save();

    $budget = DB::table('budget')->where('budget_id', $id )->first();

    
    $total = $budget->market_cost+$budget->travelling_cost+$budget->fuel_cost+$budget->postage_cost+$budget->fax_cost;

        $balance = BalanceModel::where('budget_id',$id)->first();
        $balance->total_cost = $total;
        $balance->save();

//Enter data from file to DB

DB::table('implementation')->where('budget_id',$id)->delete();

$mime = $file->getClientOriginalExtension();
$path = $request->file->getRealPath();
$results=Excel::load($path)->get();

foreach ($results as $rows) {
foreach ($rows as $row) {

    if($row->date == ''){
         
    return redirect('/requests/follow-up/32789'.$id.'43789721')->with('success', 'Plan Updated Successfully!');

    }

    ImplementationModel::create([
        'budget_id' => $id,
        'date_of_visit'  => $row->date,
        'activities'  => $row->activities, 
        'place'  => $row->place,
        'total_cost'  => $row->total,
        'description'  => $row->description,
        'expected_premium'  => $row->expected_premium,
        'bgen_date'  => $row->business_generation_date,
    ]);
 }
 }



    return redirect('requests')->with('success','Request Updated Successfully!');

    }



    public function download_file($id)
    {

        $fyl = new BudgetModel;

        $file_ob = $fyl->find($id);
    
        $filename= $file_ob->file_name;

        $path = storage_path().'\\app\\files\\'.$filename;
/*
        $file = Storage::disk('local')->get('/files/'.$filename);
      
        return Response::download($file); */ 

        return response()->download($path);        

    }


    public function implementation($id)
    {

    $impl_count = DB::table('implementation')->where('implementation_id', $id )->where('status','=','Settled')->count();

    $impl_details = DB::table('implementation')->where('implementation_id', $id )->first();

    //$budget_id = DB::table('implementation')->where('implementation_id', $id )->first();

    $budget_details = DB::table('budget')->where('budget_id', $impl_details->budget_id )->first();


        return view('implementation', compact('impl_count', 'budget_details', 'impl_details'));
    }


    public function implementation_post($id)
    {
        
        $impl = ImplementationModel::where('implementation_id', $id)->first();
        $impl->remarks = Input::get('remarks');
        $impl->actual_cost = Input::get('actual_cost');
        $impl->status = 'Settled';
        $impl->save();


       return redirect()->back()->with('success','Congratulations Remark Updated Successfully');

    }



    public function settle($id)
    {
        $balance = DB::table('balance')->where('budget_id', $id )->first();
        $budget = DB::table('budget')->where('budget_id', $id )->first();
        $actual_cost = DB::table('implementation')->where('budget_id', $id )->sum('actual_cost');
        $reviewer_list = DB::table('users')->where( 'title','=','DGM' )->orWhere('title','=','GM')->orWhere('title','=','HFA')->get();    
        return view('settle', compact('balance','reviewer_list','actual_cost','budget'));
    }




    public function push_forward_post($id)
    {
        $implementation = ImplementationModel::where('budget_id', $id)->first();
        $implementation->reason = Input::get('reason');
        $implementation->bgen_date = Input::get('extended_date');
        $implementation->status = 'Pushed Forward';
        $implementation->save();

       return redirect()->back()->with('success','Business Generation Date has been extended to '.Input::get('extended_date'));

    }



    public function remarks_post(Request $request, $id)
    {

        $balance = DB::table('balance')->where('budget_id', $id )->first();
        $budget = DB::table('budget')->where('budget_id', $id )->first();
        $actual_cost = DB::table('implementation')->where('budget_id', $id )->sum('actual_cost');




        $remarks =  RemarksModel::where('budget_id', $id)->first();
        $remarks->final_remarks = Input::get('final_remarks');
        $remarks->reviewer = Input::get('reviewer');
        $remarks->remark_status = 'Remark Submitted';
        $remarks->save();

        $approve =  BudgetModel::where('budget_id', $id)->first();
        $approve->business_status = 'On Settlement';
        $approve->save();
 
        $balance =  BalanceModel::where('budget_id', $id)->first();
        $balance->total_cost = $balance->total_cost;
        $balance->actual_cost = $actual_cost;
        $balance->resultant_balance = $balance->total_cost-$actual_cost;
        $balance->save();        

        $user =  User::where('id', Auth::user()->id )->first();
        $user->balance = $balance->total_cost+Auth::user()->balance-$actual_cost;
        $user->save();

        Mail::to(Input::get('reviewer'))->send(new RemarkSubmittedMail($id));

       return redirect('/requests')->with('success','Congratulations Remarks Submitted. Wait for Approval.');
    }





public function import(Request $request){
     //validate the xls file
  $this->validate($request, array(
   'file'      => 'required'
  ));

  if($request->hasFile('file')){
   $extension = File::extension($request->file->getClientOriginalName());
   if ($extension == "xls") {

    $path = $request->file->getRealPath();



$results=Excel::load($path)->get();

  foreach ($results as $rows) {

  foreach ($rows as $row) {


    if($row->date == ''){
        return back();
    }

    ImplementationModel::create([
        'budget_id' => '78523',
        'date_of_visit'  => $row->date,
        'activities'  => $row->activities, 
        'place'  => $row->place,
        'total_cost'  => $row->total,
        'description'  => $row->description,
        'expected_premium'  => $row->expected_premium,
        'bgen_date'  => $row->business_generation_date,

    ]);

 }
 }

}

   else {
   // Session::flash
    return redirect()->back()->with('failure', 'File is a '.$extension.' file.!! Please upload a valid xls file..!!');
  }

}







/*   $data = Excel::load($path, function($reader) {
    })->get();

    if(!empty($data) && $data->count()){

     foreach ($data as $key => $value) {
      $insert[] = [
      'name' => $value->name,
      'email' => $value->email,
      'phone' => $value->phone,  
      ];
     }

     if(!empty($insert)){

      $insertData = DB::table('file')->insert($insert);



      if ($insertData) {
       Session::flash('success', 'Your Data has successfully imported');
      }else {                        
       Session::flash('error', 'Error inserting the data..');
       return back();
      }
     }
    }

    return back();

   }else {
    Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
    return back();*/




 }

 







}


