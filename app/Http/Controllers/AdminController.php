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
//use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $admins = admin::all();
        return view('admin.index')->with('admins', $admins);
        
        
    }
   
     public function create()
    {
        //To show the required create page when its clicked
        return view('admin.create');
        
        
    }     


 public function store(Request $request)
    {
        //
        //Validate goods_received forms
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'branch_id_' => 'required',
            'password' => 'required',
            ]);


        //creation
        return admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'title' => $data['title'],
            'branch_id_' => $data['branch_id_'],

            ]);

         return redirect('/admin')->with('success', 'User have been Registered');
            
    }




       public function add_user(Request $request)
    
    {


 	DB::table('users')->insert(
        array(
            'name' => Input::get('name'),
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'title' => Input::get('title'),
            'branch_id_' => Input::get('branch_name'),
            'status' => 'created',
            'password' => Hash::make($request['password']),
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now()
        ));
        
        return redirect('/')->with('success', 'User has been Registered Successfully!');

    }

    public function edit($id)
    {
        //
        $admin =  admin::find($id);
        return view('admin.edit')->with('admin', $admin);
    }

  	public function create_user()
    {
    	$list_branches = DB::table('branches')->get();

    	return view('auth.register',compact('list_branches'));
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
        //
        $admin = Admin::find($id);
        $admin->delete();
        return redirect('/admin')->with('success', 'User Removed');
    }

}
