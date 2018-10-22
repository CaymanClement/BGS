<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\limit;
use App\Models\BlimitModel;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;
use Auth;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/users';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:users',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $CreatedUser = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'title' => $data['title'],
            'branch_id_' => $data['branch_name'],
            'status' => 'created',
            'balance' => '0',
            'password' => bcrypt($data['password']),
        ]);

    $created_id = DB::getPdo()->lastInsertId();

   // $limits_count = DB::table('limits')->where('user_id', $created_id )->count();
    $limits_admin = DB::table('limits')->join('users', 'users.id', '=' , 'limits.user_id')->where('users.title', '=', 'System Admin' )->select('*')->first();

   

            limit::create([
            'user_id' => $CreatedUser->id,
            'market_cost' => $limits_admin->market_cost,
            'travelling_cost'     =>  $limits_admin->travelling_cost,
            'fuel_cost'     => $limits_admin->fuel_cost,
            'postage_cost'     =>  $limits_admin->postage_cost,
            'fax_cost'     =>  $limits_admin->fax_cost,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ]);

        return BlimitModel::create([
            'user_id' => $CreatedUser->id,
            'market_cost' => '0',
            'travelling_cost'     =>  '0',
            'fuel_cost'     => '0',
            'postage_cost'     =>  '0',
            'fax_cost'     =>  '0',
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        ]);


/*
    return DB::table('limits')->insert( array(

            'user_id' => Auth::user()->id,
            'market_cost' => $limits_admin->market_cost,
            'travelling_cost'     =>  $limits_admin->travelling_cost,
            'fuel_cost'     => $limits_admin->fuel_cost,
            'postage_cost'     =>  $limits_admin->postage_cost,
            'fax_cost'     =>  $limits_admin->fax_cost,
            'created_at'     =>   Carbon::now(),
            'updated_at'     =>  Carbon::now(),
        )); */



    }
}
