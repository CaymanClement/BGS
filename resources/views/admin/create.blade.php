@extends('layouts.admin')
@section('content')
    <h2>Register Users</h2>
<a href="/Admin" class="btn btn-default">Back</a><br></br>


{!! Form::open(['action' => 'AdminsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    
<div class="form-group">
            {{Form::label('id', 'ID')}}
            {{Form::password('id', '', ['class' => 'form-control', 'placeholder' => 'Enter the Quantity'])}}
                 </div>


    <div class="form-group">
            {{Form::label('username', 'Name')}}
            {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Enter the  Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::password('title', '', ['class' => 'form-control', 'placeholder' => 'Enter the Quantity'])}}
                 </div>

                 
        <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter the Department'])}}
            </div>

            <div class="form-group">
                {{Form::label('branch_id_', 'Branch ID')}}
                {{Form::text('branch_id_', '', ['class' => 'form-control', 'placeholder' => 'Enter the Department'])}}
            </div>
        
         <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter the Quantity'])}}
             </div>

             {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
             {!! Form::close() !!}


             @endsection
