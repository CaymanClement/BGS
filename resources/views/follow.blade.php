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
@if( $show->business_status == 'Not settled' && $show->budget_status=='Approved' && $remarks_details>'1')
                            <tr><td>Settle Business</td><td><a href="/requests/follow-up/32789{{ $total->budget_id }}43789721/settle" class="btn btn-success btn-block">Settle Business</a></td></tr>
@elseif( $show->business_status == 'Pushed Forward' && $show->budget_status=='Approved' && $remarks_details>'1')
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
                            <tr><td>Edit:</td><td><a href="#" class="btn btn-warning btn-block disabled">Edit Details</a></td></tr>
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
 @if( $show_status<1 )
            <p><b>Implementation status of Activities:</b></p>
            <form class="form-horizontal" action="#">
                         <div class="form-group">
                            <label class="col-md-2 control-label">Remarks:</label>
                            <div class="col-md-10">
                                <textarea id="name" class="form-control" name="remarks" disabled></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Actual Cost</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="actual_cost" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Expected Action Date:</label>

                            <div class="col-md-10">
                                <input class="form-control" name="action_date" disabled/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-success btn-block disabled" disabled>
                                    Submit Remarks
                                </button>
                            </div>
                        </div>
                    </form>

@elseif( $remarks_details>'1' )

            <p><b>Implementation status of Activities:</b></p>
            <form class="form-horizontal" action="#">
                         <div class="form-group">
                            <label class="col-md-2 control-label">Remarks:</label>
                            <div class="col-md-10">
                                <textarea id="name" class="form-control" name="remarks" disabled>{{ $remarks_details->remarks }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Actual Cost</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="actual_cost" value="{{ $remarks_details->actual_cost }}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Expected Action Date:</label>

                            <div class="col-md-10">
                                <input class="form-control" name="action_date" value="{{ $remarks_details->expected_action_date }}" disabled/>
                            </div>
                        </div>
                    </form>

@else
 
            <p><b>Implementation status of Activities:</b></p>
                <form class="form-horizontal" role="form" method="POST" action="/requests/follow-up/32789{{ $total->budget_id }}43789721/remarks/post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                            <label for="remarks" class="col-md-2 control-label">Remarks:</label>

                            <div class="col-md-10">
                                <textarea id="name" class="form-control" name="remarks" required autofocus></textarea>

                                @if ($errors->has('remarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('actual_cost') ? ' has-error' : '' }}">
                            <label for="actual_cost" class="col-md-2 control-label">Actual Cost</label>

                            <div class="col-md-10">
                                <input id="actual_cost" type="text" class="form-control" name="actual_cost" required>

                                @if ($errors->has('actual_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('actual_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('action_date') ? ' has-error' : '' }}">
                            <label for="action_date" class="col-md-2 control-label">Expected Action Date:</label>

                            <div class="col-md-10">
                                <input type="date" id="name" class="form-control" name="action_date" required autofocus/>

                                @if ($errors->has('action_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('action_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    Submit Remarks
                                </button>
                            </div>
                        </div>
                    </form>
@endif
            </div>
        </div>
   
</div>
@endsection
