@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
   
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;"><b>Follow up: </b>Budget Request Details</div>

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

           
                      
                      <table class="table table-responsive table-bordered table-hover table-striped">
                            <th colspan="2" style="text-align: center;">Budget Details</th>

@foreach($show_budget_details as $show)                          
                            <tr><td>Name:</td><td>{{ Auth::user()->name }}</td></tr>
                            <tr><td>Title</td><td>{{ Auth::user()->title }} - {{ $branch->b_name }} -- {{ $branch->b_region }} -- {{ $branch->b_zone }}</td></tr>
                            <tr><td>Place of Visit:</td><td>{{ $show->place }}</td></tr>
                            <tr><td>Month</td><td>{{ $show->month }}</td></tr>
                            <tr><td>Market Cost</td><td>{{ $show->market_cost }}</td></tr>
                            <tr><td>Travelling Local Cost</td><td>{{ $show->travelling_cost }}</td></tr>
                            <tr><td>M/V Fuel & Lubricants Cost</td><td>{{ $show->fuel_cost }}</td></tr>
                            <tr><td>Postage Cost</td><td>{{ $show->postage_cost }}</td></tr>
                            <tr><td>Fax Cost</td><td>{{ $show->fax_cost }}</td></tr>
                            <tr><td>Expected Output Description:</td><td>{{ $show->description }}</td></tr>
                            <tr><td>Expected Premium</td><td>{{ $show->expected_premium }}</td></tr>
 @endforeach          

                            <tr><td>Total Cost</td><td>{{ $show->market_cost+$show->travelling_cost+$show->fuel_cost+$show->postage_cost+$show->fax_cost }}</td></tr>  
@if(  $impl_count == '0' && $approvals_details_count != '0' )
                            <tr><td>Settle Business</td><td><a href="/requests/follow-up/32789{{ $total->budget_id }}43789721/settle" class="btn btn-success btn-block">Settle Business</a></td></tr>

@else
                            <tr><td>Settle Business</td><td><button class="btn btn-success btn-block disabled">Settle Business</button></td></tr>
@endif



@if( $show->budget_status =='created' && $show_status == 0 )
                            <tr><td>Edit:</td><td><a href="/requests/follow-up/32789{{ $show->budget_id }}43789721/edit" class="btn btn-warning btn-block">Edit Details</a></td></tr>
@elseif( $show->budget_status =='Edited' && $show_status == 0  )
                            <tr><td>Edit:</td><td><a href="/requests/follow-up/32789{{ $show->budget_id }}43789721/edit" class="btn btn-warning btn-block">Edit Details</a></td></tr>
@elseif( $show->budget_status =='Rejected' && $show_status == 0  )
                            <tr><td>Edit:</td><td><a href="/requests/follow-up/32789{{ $show->budget_id }}43789721/edit" class="btn btn-warning btn-block">Edit Details</a></td></tr>

@else
                            <tr><td>Edit:</td><td><button class="btn btn-warning btn-block disabled">Edit Details</button></td></tr>
@endif
                      </table>  



<h4>Approvals:</h4>
<div class="row">
                        <div class="col-lg-12">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Reviewed by:</th>
                                        <th>Name:</th>
                                        <th>Comment:</th>
                                        <th>Status:</th>
                                        <th>Date:</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($show_reviewer as $reviewer)
                                      <tr>
                                        <td>{{ $reviewer->category }}</td>
                                        <td>
                                        @if( $reviewer->approving_user_id == 0)
                                         Pending
                                        @else
                                        {{ $reviewer->name }}
                                        @endif
                                        </td>
                                        <td>{{ $reviewer->comment }}</td>
                                        <td>{{ $reviewer->status }}</td>
                                        <td>{{ $reviewer->updated_at }}</td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                              </div>
                          </div>





<hr>
 <b>Implementation Status of Activities</b>

 @if( $approvals_details_count != '0')
<table class="table table-dark" id="clemtable">
    
    <thead>
        <tr>
            <th>Date of Visit</th>
            <th>Place</th>
            <th>Activities</th>
            <th>Cost</th>
            <th>Business Generation Date</th>
            <th>Status</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
            @foreach($implementation as $impl)
            <tr>
            <td>{{ $impl->date_of_visit }}</td>
            <td>{{ $impl->place }}</td>
            <td>{{ $impl->activities }}</td>
            <td>{{ $impl->total_cost }}</td>
            <td>{{ $impl->bgen_date }}</td>
            
            @if($impl->status == 'Settled')
            <td class="success">{{ $impl->status }}</td>
            @elseif($impl->status == 'Pushed Forward')
            <td class="warning">{{ $impl->status }}</td>
            @else
            <td class="danger">{{ $impl->status }}</td>
            @endif

            <td>
            <a href="/requests/follow-up/32789{{ $impl->implementation_id }}43789721/feedback" class="btn btn-block btn-success">Details</a>
            </td>
            </tr>
            @endforeach
    </tbody>
</table>
@else
<br>
<i>Waiting for Approval</i>
@endif
            </div>
        </div>
   
</div>
@endsection
