<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\limit;
use App\User;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use Carbon\Carbon;

use App\Mail\ApprovedMail;
use Illuminate\Support\Facades\Mail;

class LimitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $limits = DB::table('limits')->join('users', 'users.id', '=' , 'limits.user_id')->where('users.title', '=', 'System Admin' )->select('*')->first();

        return view('limits.index')->with('limits', $limits);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                //To show the required create page when its clicked
                return view('limits.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate goods_received forms
        $this->validate($request, [
            'limits_id' => 'required',
            'user_id' => 'required',
            'market_cost' => 'required',
            'travelling_cost' => 'required',
            'fuel_cost' => 'required',
            'postage_cost' => 'required',
            'fax_cost' => 'required',

            ]);


        //creation
        return limit::create([
            'limits_id' => $data['limits_id'],
            'user_id' => $data['user_id'],
            'market_cost' => bcrypt($data['market_cost']),
            'travelling_cost' => $data['travelling_cost'],
            'fuel_cost' => $data['fuel_cost'],
            'postage_cost' => $data['postage_cost'],
            'fax_cost' => $data['fax_cost'],


            ]);

         return redirect('/admin')->with('success', 'User have been Registered');
            
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $limits =  DB::table('limits')->first();
        return view('limits.edit', compact('limits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
        $limits = limit::where('limits_id',$id)->first();
        $limits->market_cost = Input::get('market_cost');
        $limits->travelling_cost = Input::get('travelling_cost');
        $limits->fuel_cost = Input::get('fuel_cost');
        $limits->postage_cost = Input::get('postage_cost');
        $limits->fax_cost = Input::get('fax_cost');
        $limits->save();


         return redirect('/admin/limits')->with('success', 'Amount Limits have been updated successfully');
         
    
    }


    public function reset()
    {


      $limit = DB::table('limits')->join('users', 'users.id', '=' , 'limits.user_id')->where('users.title', '=', 'System Admin' )->select('*')->first();

    DB::table('limits')->update(['market_cost' => $limit->market_cost ]);

    DB::table('limits')->update(['travelling_cost' => $limit->travelling_cost ]);

    DB::table('limits')->update(['fuel_cost' => $limit->fuel_cost ]);     

    DB::table('limits')->update(['postage_cost' => $limit->postage_cost ]);

    DB::table('limits')->update(['fax_cost' => $limit->fax_cost ]);

    DB::table('limits')->update(['updated_at' => Carbon::now() ]);


    DB::table('old_limits')->update(['market_cost' => '0' ]);

    DB::table('old_limits')->update(['travelling_cost' => '0' ]);

    DB::table('old_limits')->update(['fuel_cost' => '0' ]);     

    DB::table('old_limits')->update(['postage_cost' => '0' ]);

    DB::table('old_limits')->update(['fax_cost' => '0' ]);

    DB::table('old_limits')->update(['updated_at' => Carbon::now() ]);


    return redirect()->back()->with('success', 'Amount Limits Reset Successfully');
         
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
