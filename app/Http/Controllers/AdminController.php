<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use DB;
//use Auth; 
use Hash;
use App\User;
use Illuminate\Support\Facades\Input;
use App\admin;
use App\graph;

use App\Mail\ApprovedMail;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users()
    {
        $admins = admin::all();
        return view('admin.users')->with('admins', $admins);
    }

    public function home(){

    //Fetch amount
    $amount = graph::where('created_at', '>=', Carbon::now()->firstOfYear())
            ->selectRaw('MONTH as month, sum(market_cost) as market_cost')
            ->groupBy('month')
            ->pluck('market_cost', 'month');

    //Load the page and pass the data
    return view('admin.dash', compact('amount'));

    }

    public function create_user(){

        $list_branches =  DB::table('branches')->get();
        
         return view('auth.register', compact('list_branches'));
    }

     public function create()
    {
        //To show the required create page when its clicked
        return view('admin.create');
    }     


    public function store(Request $request, $data)
    {
        //Validate goods_received forms
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'branch_id_' => 'required',
            'password' => 'required',
            ]);


        //creation
        return admin::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'title' => $data['title'],
            'branch_id_' => $data['branch_id_'],

            ]);

         return redirect('/admin/users')->with('success', 'User have been Registered');
            
    }

    public function edit($id)
    {

        $admin = admin::find($id);
        return view('admin.edit')->with('admin', $admin);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'branch_id_' => 'required',
            'password' => 'required',
            ]);

            // creation
            $admin = admin::find($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = $request->input('password');
            $admin->title = $request->input('title');
            $admin->branch_id_ = $request->input('branch_id_');
            $admin->save();   
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect('/admin')->with('success', 'User Removed');
    }

    public function branches()
    {
        $branches = DB::table('branches')->get();
        return view('admin.branches', compact('branches'));
    }

    public function requests()
    {
        $requests = DB::table('budget')->get();
       
        return view('admin.requests', compact('requests'));
    }

    public function reports()
    {
        return view('admin.reports');
    }

}

