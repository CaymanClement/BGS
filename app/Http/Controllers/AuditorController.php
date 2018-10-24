<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\graph;
use Carbon\Carbon;
class AuditorController extends Controller
{
 public function home(){

        $count_unsettled = DB::table('budget')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->where('remark_status','=','Remark Submitted')->count();

        $count_approved = DB::table('budget')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->where('budget_status','=','Approved')->count();

        $count_returned = DB::table('budget')->where('budget_status', 'LIKE', '%Returned%')->count();

        $count_unapproved = DB::table('budget')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->where('budget_status','!=','Approved')->count();

        $requests = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->where('budget_status','!=','Approved')->select('*')->orderBy('budget.created_at', 'DESC')->get();

        $remarks = DB::table('budget')->join('users', 'users.id', '=', 'budget.user_id')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->where('remark_status','=','Remark Submitted')->get();




        $amount = graph::where('created_at', '>=', Carbon::now()->firstOfYear())
                    ->selectRaw('MONTH as month, sum(market_cost) as market_cost')
                    ->groupBy('month')
                    ->pluck('market_cost', 'month');

        return view('auditor.home', compact('amount','count_unapproved','count_returned','count_approved','count_unsettled','requests','remarks'));

    } 

    public function budget_requests()
    { 

        $requests = DB::table('users')->join('budget', 'users.id', '=', 'budget.user_id')->join('approvals', 'approvals.budget_id', '=', 'budget.budget_id')->select('*')->orderBy('budget.created_at', 'DESC')->get();
        return view('auditor.requests', compact('requests'));   
    
    }


    public function settle()
    {
        $remarks = DB::table('budget')->join('users', 'users.id', '=', 'budget.user_id')->join('remarks', 'remarks.budget_id', '=', 'budget.budget_id')->select('*')->get();

        return view('auditor.settle', compact('remarks'));
    }

    public function settle_view($id)
    {
        $implementation = DB::table('implementation')->where('budget_id', $id )->get();

        return view('auditor.settle_view', compact('implementation'));
    }


     public function view($id)
    {
        $show_budget_details = DB::table('budget')->where('budget_id', $id )->get();
        
        return view('auditor.view', compact('show_budget_details'));
    }

     public function balance()
    {
        $users = DB::table('branches')->join('users', 'users.branch_id_', '=', 'branches.branch_id')->orderBy('users.updated_at', 'DESC')->get();
        
        return view('auditor.balance', compact('users'));
    }

    public function report()
    {
       
         $budget_details = DB::table('budget')->join('balance', 'balance.budget_id', '=' , 'budget.budget_id')->get();

         return view('report', compact('budget_details'));
    }

}
