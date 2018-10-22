@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
   
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Implementation of Activities</div>
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

           
                   <div class="col-md-offset-2">   
                         <div class="row">
                            <div class="col-md-2"><b>Date of Visit:</b></div>
                            <div class="col-md-8">
                                {{ $impl_details->date_of_visit }}
                            </div>
                        </div>
                         <br><div class="row">
                            <div class="col-md-2"><b>Activities: </b></div>
                            <div class="col-md-8">
                                {{ $impl_details->activities }}
                            </div>
                        </div>                          
                         <br><div class="row">
                            <div class="col-md-2"><b>Place: </b></div>
                            <div class="col-md-8">
                               {{ $impl_details->place }}
                            </div>
                        </div>
                         <br><div class="row">
                            <div class="col-md-2"><b>Description: </b></div>
                            <div class="col-md-8">
                                {{ $impl_details->description }}
                            </div>
                        </div>
                         <br><div class="row">
                            <div class="col-md-2"><b>Total Cost: </b></div>
                            <div class="col-md-8">
                                {{ $impl_details->total_cost }}
                            </div>
                        </div> 
                         <br><div class="row">
                            <div class="col-md-2"><b>Expected Premium: </b></div>
                            <div class="col-md-8">
                                {{ $impl_details->expected_premium }}
                            </div>
                        </div>                                                  
                         <br><div class="row">
                            <div class="col-md-2"><b>Business Generation Date: </b></div>
                            <div class="col-md-8">
                                {{ $impl_details->bgen_date }}
                            </div>
                        </div> <br>

</div>

@if( $impl_details->status == 'Settled')

            <form class="form-horizontal" action="#">
                         <div class="form-group">
                            <label class="col-md-2 control-label">Remarks:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" disabled>{{ $impl_details->remarks }}</textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-2 control-label">Actual Cost:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" disabled>{{ $impl_details->actual_cost }}</textarea>
                            </div>
                        </div>

                    </form>
@if( $budget_details->budget_status == 'Approved')
@else
                    <div align="center">
                    <button data-toggle="modal" data-target="#editModal" class="btn btn-primary">Edit</button>
                    </div>
@endif

@elseif( $impl_details->status == 'Pushed Forward')

            <form class="form-horizontal" action="#">
                         <div class="form-group">
                            <label class="col-md-2 control-label">Push Forward Date:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" disabled>{{ $impl_details->bgen_date }}</textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-2 control-label">Reason:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" disabled>{{ $impl_details->reason }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                              <button data-toggle="modal" data-target="#approveModal" class="btn btn-success btn-block">Approve Now</button>
                          </div>
                      </div>
                    </form>


@else
 
                <form class="form-horizontal" role="form" method="POST" action="/requests/follow-up/32789{{ $impl_details->implementation_id }}43789721/feedback-post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                            <label for="remarks" class="col-md-2 control-label">Remarks:</label>

                            <div class="col-md-8">
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

                            <div class="col-md-8">
                                <input id="actual_cost" type="number" class="form-control" name="actual_cost" required>

                                @if ($errors->has('actual_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('actual_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">

                                @if($impl_details->status == 'Settled')
                                <button type="reset" class="btn btn-success btn-block disabled">Submit Remarks</button>
                                @else
                                <button type="submit" class="btn btn-success btn-block">
                                    Submit Remarks
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>



                    <div class="col-md-8 col-md-offset-2">
                        <div align="center"><b>OR</b></div><br>
@if($impl_details->status == 'Pushed Forward' || $impl_details->status == 'Settled')
<button class="btn btn-warning btn-block disabled">Push Forward</button>
@else                        
<button data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-block">Push Forward</button>
@endif
                    </div> 

@endif
            </div>
        </div>
   
</div>




                    <!-- Modal for Push forward-->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Push Forward To Date</h4>
                                    </div>
                                    <div class="modal-body">

                        <form class="form-horizontal" role="form" method="POST" action="/requests/follow-up/32789{{ $impl_details->budget_id }}43789721/push/post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                            <label for="reason" class="col-md-2 control-label">Reason:</label>

                            <div class="col-md-10">
                                <textarea id="name" class="form-control" name="reason" required autofocus></textarea>

                                @if ($errors->has('reason'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('extended_date') ? ' has-error' : '' }}">
                            <label for="extended_date" class="col-md-2 control-label">Next Business Generation Date:</label>

                            <div class="col-md-10">
                                <input type="date" id="name" class="form-control" name="extended_date" required autofocus/>

                                @if ($errors->has('extended_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('extended_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Push Forward
                                </button>
                            </div>
                        </div>

                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        




    <!-- Modal for approve -->
        <div class="modal fade" id="approveModal" role="dialog">
            <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Approve Now</h4>
                    </div>
                    <div class="modal-body">


                <form class="form-horizontal" role="form" method="POST" action="/requests/follow-up/32789{{ $impl_details->implementation_id }}43789721/feedback-post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                            <label for="remarks" class="col-md-2 control-label">Remarks:</label>

                            <div class="col-md-8">
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

                            <div class="col-md-8">
                                <input id="actual_cost" type="number" class="form-control" name="actual_cost" required>

                                @if ($errors->has('actual_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('actual_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    Submit Remarks
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>



<!-- edit modal -->
        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Details</h4>
                    </div>
                    <div class="modal-body">


                <form class="form-horizontal" role="form" method="POST" action="/requests/follow-up/32789{{ $impl_details->implementation_id }}43789721/feedback-post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                            <label for="remarks" class="col-md-2 control-label">Remarks:</label>

                            <div class="col-md-8">
                                <textarea id="name" class="form-control" name="remarks" required autofocus>{{ $impl_details->remarks }}</textarea>

                                @if ($errors->has('remarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('actual_cost') ? ' has-error' : '' }}">
                            <label for="actual_cost" class="col-md-2 control-label">Actual Cost</label>

                            <div class="col-md-8">
                                <input id="actual_cost" type="number" class="form-control" value="{{ $impl_details->actual_cost }}" name="actual_cost" required>

                                @if ($errors->has('actual_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('actual_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    Submit Remarks
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>


@endsection
