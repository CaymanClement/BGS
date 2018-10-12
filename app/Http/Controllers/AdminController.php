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
use Auth;

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
        $admins = DB::table('branches')->join('users', 'users.branch_id_', '=', 'branches.branch_id')->orderBy('users.updated_at', 'DESC')->get();

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
       $list_branches =  DB::table('branches')->get();

       $user =  DB::table('users')->where('id', $id)->first();

        $branch =  DB::table('branches')->where('branch_id', $user->branch_id_ )->first();

        $admin = admin::find($id);
        return view('admin.edit', compact('admin', 'list_branches','branch'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            ]);

            // creation
            $admin = User::where('id',$id)->first();
            $admin->name =   Input::get('name');
            $admin->email =  Input::get('email');
            $admin->branch_id_ =  Input::get('branch_name');
            $admin->password =  bcrypt(Input::get('password'));
            $admin->title =  Input::get('title');
            $admin->status = 'created';
            $admin->save();   

return redirect('/admin/users')->with('success','User Updated Successfully');

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


    public function change_password()
    {
        return view('auth.passwords.change_password');
    }

    public function change_password_post(Request $request)
    {
         $this->validate($request, [
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/',
         ]);  

        $user = User::where('id', Auth::user()->id )->first();
        $user->username = Auth::user()->username;
        $user->name = Auth::user()->name;
        $user->password =  bcrypt(Input::get('password'));
        $user->status = 'Active';
        $user->save();
        Auth::logout();


        return redirect('/login')->with('success','Password Changed Successfully Login to Continue');
    }

}

