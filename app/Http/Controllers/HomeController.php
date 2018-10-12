<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use App\User;
use App\limit;
use App\Models\ApprovalsModel;
use App\Models\BudgetModel;
use App\Models\RemarksModel; 
use App\Models\BalanceModel;
use App\Models\UpdatesModel;
use App\Models\BlimitModel;
use App\graph;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Response;

use App\Mail\ApprovedMail;
use App\Mail\ApproveBudgetMail;
use App\Mail\RejectedMail;
use App\Mail\ReturnedMail;
use Illuminate\Support\Facades\Mail;


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


        if($balance1<1){
        $balance = new BalanceModel;
        $balance->resultant_balance = '0';
         return view('home', compact('balance','amount'));
        }


        return view('home', compact('balance','amount'));
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
            'expected_premium' => 'required|numeric'
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


            if(Input::get('month')=='January' || Input::get('month')=='February' || Input::get('month')=='March'){

//store file

$file = $request['file_uploaded'];
$mime = $file->getClientOriginalExtension();
$now = Carbon::now();
$filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
$file->storeAs('\files',$filename_renamed);


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

        $file = $request['file_uploaded'];
        $mime = $file->getClientOriginalExtension();
        $now = Carbon::now();
        $filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
        $file->storeAs('\files',$filename_renamed);



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

        $file = $request['file_uploaded'];
        $mime = $file->getClientOriginalExtension();
        $now = Carbon::now();
        $filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
        $file->storeAs('\files',$filename_renamed);



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

        $file = $request['file_uploaded'];
        $mime = $file->getClientOriginalExtension();
        $now = Carbon::now();
        $filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
        $file->storeAs('\files',$filename_renamed);



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


        $limits = limit::where('user_id', Auth::user()->id )->first();
        $limits->market_cost = $limits->market_cost-Input::get('market_cost');
        $limits->travelling_cost = $limits->travelling_cost-Input::get('travelling_cost');
        $limits->fuel_cost = $limits->fuel_cost-Input::get('fuel_cost');
        $limits->fax_cost = $limits->fax_cost-Input::get('fax_cost');
        $limits->postage_cost = $limits->postage_cost-Input::get('postage_cost');
        $limits->save();


 
    return redirect('/requests')->with('success', 'Budget Submitted Successfully!');

    }





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


        return view('approve', compact('show_budget_details','show_reviewer','show_status','total','name','branch','reviewer_list_1', 'reviewer_list_2', 'reviewer_list_3','reviewer_list_2r','reviewer_list_3r','reviewer_list_4r'));
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
        $approve->status = 'Approved';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();
        Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail());
        return redirect('approved')->with('success','Budget approved Successfully!');
        }

        elseif(Auth::user()->title == 'HFA' ){

          $budget = BudgetModel::where('budget_id',$id)->first();
          $budget->budget_status = 'On Approval';
          $budget->save();

        $approve = ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Approved';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();
        Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail());
        return redirect('approved')->with('success','Budget approved Successfully!');
        }

        elseif(Auth::user()->title == 'DGM' ){

          $budget = BudgetModel::where('budget_id',$id)->first();
          $budget->budget_status = 'On Approval';
          $budget->save();

        $approve = ApprovalsModel::where('category','=','Recommended for activity by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Approved';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();
        Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail());        
        return redirect('approved')->with('success','Budget approved Successfully!');
        }

        elseif(Auth::user()->title == 'GM' ){
        
        $approve = ApprovalsModel::where('category','=','Approved by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Approved';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();

        $budget = BudgetModel::where('budget_id', $id)->first();
        $budget->budget_status = 'Approved';
        $budget->save();

//sends mail 

      //  Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail());



        return redirect('approved')->with('success','Budget approved Successfully!');

        }

    else{

//sends mail 

  //      Mail::to(Input::get('reviewer'))->send(new ApproveBudgetMail());



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
        Mail::to(Input::get('reviewer'))->send(new RejectedMail());
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
          Mail::to(Input::get('reviewer'))->send(new RejectedMail());
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
        Mail::to(Input::get('reviewer'))->send(new RejectedMail());
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


        Mail::to(Input::get('reviewer'))->send(new RejectedMail());
        return redirect('approved')->with('failure','Budget Rejected Successfully!');
        }



    else{

        return redirect('approved')->with('failure','Sorry You Are Not Authorized to Perform This Operation');
    }

    }







    public function return_post($id)
    
    {

Mail::to(Input::get('reviewer'))->send(new ReturnedMail());

    $count_record = DB::table('approvals')->where('budget_id', $id )->where('approving_user_id', Auth::user()->id )->where('status','=','Returned')->count();

$reviewer = DB::table('users')->where('email', Input::get('reviewer') )->first();

     if($count_record>'1'){

        return redirect()->back()->with('failure','Sorry! You already approved this budget');
        
        }

        elseif(Auth::user()->title == 'PFA' ){

        $approve =ApprovalsModel::where('category','=','Reviewed by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Returned';
        $approve->comment = Input::get('comment');
        $approve->forward_to = Input::get('reviewer');
        $approve->save();


          $budget = BudgetModel::where('budget_id',$id)->first();

          $budget->budget_status = 'Returned to -  '.$reviewer->name;
          $budget->save();   

        return redirect('approved')->with('success','Budget Returned Successfully!');

        }


        elseif(Auth::user()->title == 'HFA' ){

        $approve =ApprovalsModel::where('category','=','Recommended for budget by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id ;
        $approve->status = 'Returned' ;
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

        return redirect('approved')->with('success','Budget Returned Successfully!');

        }


        elseif(Auth::user()->title == 'DGM' ){

        $approve =ApprovalsModel::where('category','=','Recommended for activity by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Returned';
        $approve->comment = Input::get('comment');
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

        return redirect('approved')->with('success','Budget Returned Successfully!');
        }

       elseif(Auth::user()->title == 'GM' ){
        $approve =ApprovalsModel::where('category','=','Approved by:')->where('budget_id',$id)->first();
        $approve->approving_user_id = Auth::user()->id;
        $approve->status = 'Returned';
        $approve->comment = Input::get('comment');
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

        return redirect('approved')->with('success','Budget Returned Successfully!');

       }

    else{

        return redirect('approved')->with('failure','Sorry You are not Authorized to perform This Operation');
    }

    }  






    public function requests()
    {
        $list_requests = DB::table('budget')->where('user_id', Auth::user()->id)->get();

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

        return redirect('/add')->with('limits', $limits)->with('balance1', $balance1)->with('balance', $balance)->with('branch_details', $branch_details)->with('reviewer_list', $reviewer_list);
  }
    }



    public function reports()
    {
        return view('report');
    }




    public function follow($id)
    {
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->get();
        
        $show_reviewer = DB::table('approvals')->join('users', 'users.id', '=', 'approvals.approving_user_id')->where('budget_id', $id )->select('*')->get();
       
        $show_status = DB::table('approvals')->where('budget_id', $id )->where('category','=','Approved by:')->where('status','=','Approved')->orWhere('status','=','On Approval')->count();
        $total = DB::table('balance')->where('budget_id', $id )->first();

        $remarks_details = DB::table('remarks')->where('budget_id', $id )->first();
        $remarks_details_count = DB::table('remarks')->where('budget_id', $id )->count();

        $budget_id = $id;
     
        $branch = DB::table('branches')->where('branch_id', Auth::user()->branch_id_ )->first();
        return view('follow', compact('show_budget_details','show_reviewer','show_status','total','branch','budget_id','remarks_details','remarks_details_count'));
    }






    public function edit_budget($id)
    {
        $branch_details = DB::table('branches')->where('branch_id', Auth::user()->branch_id_)->get();
        $budget_details = DB::table('budget')->where('budget_id', $id )->first();
        return view('edit_budget', compact('budget_details','branch_details'));
    } 





    public function remarks_post(Request $request, $id)
    {
          $this->validate($request, [
            'remarks' => 'required|max:255',
            'action_date' => 'required|max:255',
            'actual_cost' => 'required|numeric',

         ]);


        $balance = DB::table('balance')->where('budget_id', $id )->first();

        if(Input::get('actual_cost')>$balance->total_cost){

        return redirect()->back()->with('failure','Sorry, the Actual cost cannot be greater than the Total Cost');

        }

        DB::table('remarks')->insert( array(

            'budget_id' =>  $id,
            'actual_cost' => Input::get('actual_cost'),
            'expected_action_date' => Input::get('action_date'),
            'remarks' => Input::get('remarks'),
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ));

        $resultant = $balance->total_cost-Input::get('actual_cost');

        $balance = BalanceModel::where('budget_id',$id)->first();
        $balance->actual_cost = Input::get('actual_cost');
        $balance->resultant_balance = $resultant;
        $balance->save();

        return redirect()->back()->with('success','Congratulations! Remark Submitted Successfully!');
    }




    public function settle($id)
    {
        $balance = DB::table('balance')->where('budget_id', $id )->first();
        $reviewer_list = DB::table('users')->where( 'title','=','DGM' )->orWhere('title','=','GM')->get();    
        return view('settle', compact('balance','reviewer_list'));
    }






    public function settle_post($id)
    {
    

        $balance = RemarksModel::where('budget_id', $id)->first();
        $balance->final_remarks = Input::get('final_remarks');
        $balance->reviewer = NULL;
        $balance->remark_status = 'Remark Submited';
        $balance->save();

        $approve = BudgetModel::where('budget_id', $id)->first();
        $approve->business_status = 'On Settlement';
        $approve->save();

       return redirect('/requests')->with('success','Congratulations Remark Submitted. Wait for Approval.');

    }






    public function forward_post($id)
    {
        $remarks = RemarksModel::where('budget_id', $id)->first();
        $remarks->reason = Input::get('reason');
        $remarks->push_forward_date = Input::get('extended_date');
        $remarks->save();


        $budget = BudgetModel::where('budget_id', $id)->first();
        $budget->business_status = 'Pushed Forward';
        if($budget->quarter == '1'){
        $budget->quarter = '2';
        }
        elseif($budget->quarter == '2'){
        $budget->quarter = '3';
        }
        elseif($budget->quarter == '3'){
        $budget->quarter = '4';
        }
        else{
        $budget->quarter = '1';
        }
        $budget->save();

       return redirect('/requests')->with('success','Business Output Date has been extended to the next Quarter');

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

$file = $request['file_uploaded'];
$mime = $file->getClientOriginalExtension();
$now = Carbon::now();
$filename_renamed = Auth::user()->username.'_'.$now->day.'_'.$now->month.'_'.$now->year.'_.'.$mime;
$file->storeAs('\files',$filename_renamed);

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

}

