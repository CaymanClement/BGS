@extends('layouts.auditor')

@section('content')

<div class="container">
    <div class="row">
   
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Budget Request Details</div>

                <div class="panel-body">
                      
                      <table class="table table-responsive table-bordered table-hover table-striped">
                            <th colspan="2" style="text-align: center;">Budget Details</th>

@foreach($show_budget_details as $show)                       
                            <tr><td>Month</td><td>{{ $show->month }}</td></tr>
                            <tr><td>Place of Visit:</td><td>{{ $show->place }}</td></tr>
                            <tr><td>Market Cost</td><td>{{ $show->market_cost }}</td></tr>
                            <tr><td>Travelling Local Cost</td><td>{{ $show->travelling_cost }}</td></tr>
                            <tr><td>M/V Fuel & Lubricants Cost</td><td>{{ $show->fuel_cost }}</td></tr>
                            <tr><td>Postage Cost</td><td>{{ $show->postage_cost }}</td></tr>
                            <tr><td>Fax Cost</td><td>{{ $show->fax_cost }}</td></tr>
                            <tr><td>Expected Output Description:</td><td>{{ $show->description }}</td></tr>
                            <tr><td>Expected Premium</td><td>{{ $show->expected_premium }}</td></tr>
 @endforeach          

                            <tr><td>Total Cost</td><td>{{ $show->market_cost+$show->travelling_cost+$show->fuel_cost+$show->postage_cost+$show->fax_cost }}</td></tr>  
                      </table>  



@endsection
