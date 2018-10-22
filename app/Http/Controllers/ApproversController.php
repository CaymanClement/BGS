<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use DB;

use App\graph;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

use App\Models\RemarksModel; 
use App\Models\BalanceModel;
use App\Models\UpdatesModel;
use App\Models\BlimitModel;
use App\Models\BudgetModel;
use App\Models\ApprovalsModel;
use App\Models\BtrackModel;
use App\Models\ImplementationModel;
use App\limit;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Response;

use App\Mail\ApprovedMail;
use App\Mail\ApproveBudgetMail;
use App\Mail\RejectedMail;
use App\Mail\ReturnedMail;
use Illuminate\Support\Facades\Mail;

//for file ---------------------
use Session;
use Excel;
//--------------------------------



class ApproversController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $count_unsettled = DB::table('budget')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->where('remark_status','=','Remark Submitted')->count();

        $count_approved = DB::table('budget')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->where('approving_user_id', Auth::user()->id)->where('budget_status','=','Approved')->count();

        $count_returned = DB::table('budget')->where('budget_status', 'LIKE', '%'.Auth::user()->name.'%')->count();

        $count_unapproved = DB::table('budget')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->where('approving_user_id', Auth::user()->id)->where('budget_status','!=','Approved')->count();

        $requests = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->where('budget_status','!=','Approved')->select('*')->orderBy('budget.created_at', 'DESC')->get();

        $remarks = DB::table('budget')->join('users', 'users.id', '=', 'budget.user_id')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->where('remark_status','=','Remark Submitted')->get();




        $amount = graph::where('created_at', '>=', Carbon::now()->firstOfYear())
                    ->selectRaw('MONTH as month, sum(market_cost) as market_cost')
                    ->groupBy('month')
                    ->pluck('market_cost', 'month');

        return view('approvers.home', compact('amount','count_unapproved','count_returned','count_approved','count_unsettled','requests','remarks'));
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

$file = $request['file'];
$mime = $file->getClientOriginalExtension();
$now = Carbon::now();
$filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
$file->storeAs('\files',$filename_renamed);

if($mime != 'xls'){
        return redirect()->back()->withInput(Input::all())->with('failure','Please check File Format. Only Excel "xls" format allowed');
}
    

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

//Enter data from file to DB

DB::table('implementation')->where('budget_id',$id)->delete();

$mime = $file->getClientOriginalExtension();
$path = $request->file->getRealPath();
$results=Excel::load($path)->get();

foreach ($results as $rows) {
foreach ($rows as $row) {

    if($row->date == ''){
         
    return redirect('/approve/329382329383293823983238'.$id.'874393239328923982378923782739237')->with('success','Request Updated Successfully!');
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

}




    public function view($id)
    {
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->get();
        
        return view('approvers.view', compact('show_budget_details'));
    }



    public function settle()
    {
        $remarks = DB::table('budget')->join('users', 'users.id', '=', 'budget.user_id')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->where('remark_status','=','Remark Submitted')->orWhere('remark_status','=','Business Settled')->get();

        return view('approvers.settle', compact('remarks'));
    }

    public function settle_view($id)
    {
        $implementation = DB::table('implementation')->where('budget_id', $id )->get();

        return view('approvers.settle_view', compact('implementation'));
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

       return redirect()->back()->with('success','Congratulations, Business Settled Successfully');


    }


    public function budget_requests()
    { 

        $requests = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->select('*')->orderBy('budget.created_at', 'DESC')->get();
        return view('approvers.requests', compact('requests'));   
    
    }



    public function report()
    {
        return view('approvers.reports');
    }


//------------------------------------------------------------------------------------------------------





    public function approve($id)
    {
        $reviewer_list_1 = DB::table('users')->where( 'title','=','HFA' )->get();
        $reviewer_list_2 = DB::table('users')->where( 'title','=','DGM' )->get();
        $reviewer_list_3 = DB::table('users')->where( 'title','=','GM' )->get();
        $reviewer_list_2r = DB::table('users')->where('title','=','PFA')->get();
        $reviewer_list_3r = DB::table('users')->where('title','=','HFA')->get();
        $reviewer_list_4r = DB::table('users')->where( 'title','=','DGM' )->orWhere('title','=','HFA')->orWhere('title','=','PFA')->get();

        $show_budget_details = DB::table('budget')->where('budget_id', $id )->first();
        $show_reviewer = DB::table('approvals')->join('users', 'users.id', '=', 'approvals.approving_user_id')->where('budget_id', $id )->select('name', 'approvals.updated_at', 'approvals.status', 'comment', 'category','users.id', 'approvals.approving_user_id')->get();


        $name = DB::table('users')->where('id', $show_budget_details->user_id )->first();
       
        $branch = DB::table('branches')->where('branch_id', $name->branch_id_ )->first();
        $total = DB::table('balance')->where('budget_id', $id )->first();

        $reviewer1 = DB::table('users')->where( 'title','=','HFA' )->first();
        $reviewer2 = DB::table('users')->where( 'title','=','DGM' )->first();
        $reviewer3 = DB::table('users')->where('title','=','PFA')->first();

        return view('approve', compact('show_budget_details','show_reviewer','show_status','total','name','branch','reviewer_list_1', 'reviewer_list_2', 'reviewer_list_3','reviewer_list_2r','reviewer_list_3r','reviewer_list_4r','reviewer1','reviewer2','reviewer3'));
    }





    public function approve_post($id)
    {
    
    $count_record = DB::table('approvals')->where('budget_id', $id )->where('approving_user_id', Auth::user()->id )->where('status','=','Approved')->count();

     if($count_record>'1'){

        return redirect()->back()->with('failure','Sorry! You already approved this budget');
        
        }


        elseif(Auth::user()->title == 'PFA' ){
       
          $budget = BudgetModel::where('budget_id',$id)->first();
          $budget->budget_status = 'On Approval';
          $budget->save();


        $approve = ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Reviewed';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Reviewed',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));


//Sends a mail to approver 
        Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail($id));

        return redirect('approved')->with('success','Budget approved Successfully!');
        }


//---------------------------
        elseif(Auth::user()->title == 'HFA' ){

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'On Approval';
        $budget->save();

        $approve = ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Recommended';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Recommended',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail($id));
        return redirect('approved')->with('success','Budget approved Successfully!');
        }


//-----------------------------
        elseif(Auth::user()->title == 'DGM' ){

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'On Approval';
        $budget->save();

        $approve = ApprovalsModel::where('category','=','Recommended for activity by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Recommended';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Recommended',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));


        Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail($id));        
        return redirect('approved')->with('success','Budget approved Successfully!');
        }

//-------------------------
        elseif(Auth::user()->title == 'GM' ){
        
        $approve = ApprovalsModel::where('category','=','Approved by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Approved';
        $approve->comment = Input::get('comment');
        $approve->forward_to = NULL;
        $approve->save();

        $budget = BudgetModel::where('budget_id', $id)->first();
        $budget->budget_status = 'Approved';
        $budget->save();


//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Approved',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

//sends mail 
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->first();
        $requester = DB::table('users')->where('id', $show_budget_details->user_id )->first();
        
        Mail::to($requester->email)->send(new ApprovedMail($id));



        return redirect('approved')->with('success','Budget approved Successfully!');

        }

    else{


        return redirect('approved')->with('failure','Sorry You Are Not Authorized to Perform This Operation');
    }

    }


    public function reject_post($id)
    {
        if(Auth::user()->title == 'PFA'){
        $approve = ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Rejected';
        $approve->comment = Input::get('comment');
        $approve->forward_to = NULL;
        $approve->save();

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Rejected by '.Auth::user()->name;
        $budget->save();        

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Rejected',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        Mail::to(Input::get('reviewer'))->send(new RejectedMail($id));
        return redirect('approved')->with('failure','Budget Rejected Successfully!');
        }

        elseif(Auth::user()->title == 'HFA'){

        $approve = ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = '0';
        $approve->status = 'Rejected';
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();

        $approve = ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Rejected';
        $approve->comment = Input::get('comment');
        $approve->forward_to = NULL;
        $approve->save();

          $budget = BudgetModel::where('budget_id',$id)->first();
          $budget->budget_status = 'Rejected by '.Auth::user()->name;
          $budget->save();        
         //Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Rejected',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

          Mail::to(Input::get('reviewer'))->send(new RejectedMail($id));
        return redirect('approved')->with('success','Budget Rejected Successfully!');
        }



        elseif(Auth::user()->title == 'DGM'){

        $approve = ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = '0';
        $approve->status = 'Rejected';
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();

        $approve = ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = '0';
        $approve->status = 'Rejected';
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();

        $approve = ApprovalsModel::where('category','=','Recommended for activity by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Rejected';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Rejected by '.Auth::user()->name;
        $budget->save();   
       

       //Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Rejected',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        Mail::to(Input::get('reviewer'))->send(new RejectedMail($id));
        return redirect('approved')->with('success','Budget Rejected Successfully!');
        }

        elseif(Auth::user()->title == 'GM'){

        $approve = ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = '0';
        $approve->status = 'Rejected';
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();

        $approve = ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = '0';
        $approve->status = 'Rejected';
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();

        $approve = ApprovalsModel::where('category','=','Recommended for activity by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = '0';
        $approve->status = 'Rejected';
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();

        $approve = ApprovalsModel::where('category','=','Approved by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Rejected';
        $approve->comment = Input::get('comment');
        $approve->forward_to = NULL;
        $approve->save();

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Rejected by '.Auth::user()->name;
        $budget->save();


       //Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Rejected',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

    //Sends Mail        
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->first();
        $requester = DB::table('users')->where('id', $show_budget_details->user_id )->first();
        
        Mail::to($requester->email)->send(new RejectedMail($id));

        return redirect('approved')->with('failure','Activity Plan Rejected Successfully!');
        }



    else{

        return redirect('approved')->with('failure','Sorry You Are Not Authorized to Perform This Operation');
    }

    }







    public function return_post($id)
    
    {

    $count_record = DB::table('approvals')->where('budget_id', $id )->where('approving_user_id', Auth::user()->id )->where('status','LIKE','Returned%')->count();

    $reviewer = DB::table('users')->where('email', Input::get('reviewer'))->first();

  if(Input::get('reviewer1')=='' && Input::get('reviewer2')=='' && Input::get('reviewer3')==''){
  
  return redirect()->back()->with('failure','Please choose atleast one Recipient');

  }

    if(Input::get('reviewer')!=''){
        $approve =DB::table('approvals')->join('users', 'approvals.approving_user_id', '=', 'users.id')->where('budget_id',$id)->where('email', Input::get('reviewer'))->first();
        $approve->status = 'Returned from '.Auth::user()->name;
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();        
    Mail::to(Input::get('reviewer'))->send(new ReturnedMail($id));

    }

    if(Input::get('reviewer1')!=''){
        $approve =ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->status = 'Returned from '.Auth::user()->name;
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();        
    Mail::to(Input::get('reviewer1'))->send(new ReturnedMail($id));

    }

    if(Input::get('reviewer2')!=''){
        $approve =ApprovalsModel::where('category','=','Recommended for activity by')->where('budget_id',$id)->first();
        $approve->status = 'Returned from '.Auth::user()->name;
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();          
    Mail::to(Input::get('reviewer2'))->send(new ReturnedMail($id));
    }
    if(Input::get('reviewer3')!=''){
        $approve =ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->status = 'Returned from '.Auth::user()->name;
        $approve->comment = 'Pending';
        $approve->forward_to = NULL;
        $approve->save();           
    Mail::to(Input::get('reviewer3'))->send(new ReturnedMail($id));
    }



     if($count_record>'1'){

        return redirect()->back()->with('failure','Sorry! You already approved this budget');
        
        }


        elseif(Auth::user()->title == 'PFA' ){

        $approve =ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Returned to '.$reviewer->name;
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Returned to -  '.$reviewer->name;
        $budget->save();   

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Returned to '.$reviewer->name.' '.$reviewer->title,
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));


        return redirect('approved')->with('success','Budget Returned Successfully!');

        }


        elseif(Auth::user()->title == 'HFA' ){

        $approve = ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id ;
        $approve->status = 'Returned to '.$reviewer->name ;
        $approve->comment = Input::get('comment') ;
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

        $returned =ApprovalsModel::where('forward_to', Input::get('reviewer'))->where('budget_id',$id)->first();
        $returned->status = 'Returned';
        $returned->comment = 'Pending';
        $returned->forward_to = 'Pending';
        $returned->save();        

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Returned to - '.$reviewer->name;
        $budget->save();   

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Returned to '.$reviewer->name.' '.$reviewer->title,
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        return redirect('approved')->with('success','Budget Returned Successfully!');

        }


        elseif(Auth::user()->title == 'DGM' ){

        $approve = ApprovalsModel::where('category','=','Recommended for activity by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Returned to '.$reviewer->name;
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

        $returned = ApprovalsModel::where('approving_user_id', $reviewer->id)->where('budget_id',$id)->first();
        $returned->status = 'Returned';
        $returned->comment = 'Pending';
        $returned->forward_to = 'Pending';
        $returned->save();    

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Returned to - '.$reviewer->name;
        $budget->save();   

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Returned to '.$reviewer->name.' '.$reviewer->title,
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        return redirect('approved')->with('success','Budget Returned Successfully!');
        }

       elseif(Auth::user()->title == 'GM' ){
        
        $approve =ApprovalsModel::where('category','=','Approved by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Returned';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

    /*    $returned =ApprovalsModel::where('approving_user_id', $reviewer->id)->where('budget_id', $id)->first();
        $returned->status = 'Returned';
        $returned->comment = 'Pending';
        $returned->forward_to = 'Pending';
        $returned->save();   */ 

        $budget = BudgetModel::where('budget_id',$id)->first();
        $budget->budget_status = 'Returned';
        $budget->save(); 

//Creates a tracking record
        DB::table('budget_track')->insert( array(

            'user_id' => Auth::user()->id,
            'budget_id' => $id,
            'status_info' => 'Returned to previous Approvers',
            'comment' => Input::get('comment'),
            'created_at'     =>  Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        return redirect('approved')->with('success','Budget Returned Successfully!');

       }

    else{

        return redirect('approved')->with('failure','Sorry You are not Authorized to perform This Operation');
    }

    }  



//-------------------------------------------------------------------------------------------------------





}
