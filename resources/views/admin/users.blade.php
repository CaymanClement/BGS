@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
         
                <div class="panel-heading"  style="background:url('/img/bg2.jpg'); background-size:cover; color: white;">User Management</div>

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

<a href="/admin/register-user" class="btn btn-success btn-block">Create User</a><br>

<table id="clemtable" class="table">
    <tr>
        <th>Name</th>
        <th>User ID</th>
        <th>Email</th>
        <th>Title</th>
        <th>Branch ID</th>
        <th>Status</th>

        <th>Edit</th>
        
    </tr>
    @foreach($admins as $admin)
    <tr>
    <td>{!!$admin->name!!}</td>
    <td>{!!$admin->username!!}</td>
    <td>{!!$admin->email!!}</td>
    <td>{!!$admin->title!!}</td>
    <td>{!!$admin->branch_id_!!}</td>
    <td>{!!$admin->status!!}</td>

    <td><a href="/admin/{{$admin->id}}/edit" class="btn btn-success btn-block">Edit</a></td>

    </tr>
    @endforeach
</table>
        </div>
    </div>
</div>
</div>


@endsection


     
