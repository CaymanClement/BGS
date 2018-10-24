@extends('layouts.auditor')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
         
                <div class="panel-heading"  style="background:url('/img/bg2.jpg'); background-size:cover; color: white;">User Balance</div>

                <div class="panel-body">

                              @if (session('success'))
                             <div class="alert alert-success alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('success') }}
                             </div>
                             @elseif (session('failure'))
                             <div class="alert alert-danger alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('failure') }}
                             </div>
                             @elseif (session('warning'))
                             <div class="alert alert-warning alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('warning') }}
                             </div>
                             @endif

<table id="clemtable" class="table table-striped">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Branch</th>
        <th>Region</th>
        <th>Zone</th>
        <th>User Status</th>
        <th>Balance</th>
    </tr>

    @foreach($users as $user)
    <tr>
    <td>{!!$user->name!!}</td>
    <td>{!!$user->email!!}</td>
    <td>{!!$user->b_name!!}</td>
    <td>{!!$user->b_region!!}</td>
    <td>{!!$user->b_zone!!}</td>
    <td>{!!$user->status!!}</td>
    <td>{!!$user->balance!!}</td>
    </tr>
    
    @endforeach
</table>
        </div>
    </div>
</div>
</div>


@endsection


     
