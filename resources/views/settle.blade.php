@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Settle Business (Submit Remarks)</div>

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
                <form class="form-horizontal" role="form" method="POST" action="/requests/follow-up/32789{{ $balance->budget_id }}43789721/remarks/post">

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('final_remarks') ? ' has-error' : '' }}">
                            <label for="final_remarks" class="col-md-2 control-label">Final Remark:</label>

                            <div class="col-md-10">
                                <textarea id="final_remarks" class="form-control" name="final_remarks" required autofocus></textarea>

                                @if ($errors->has('final_remarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('final_remarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                             <div class="form-group">
                                <label class="col-md-2 control-label">Total Cost</label>
                                <div class="col-md-10">
                                    <input type="text" name="total_cost" class="form-control" disabled value="{{ $balance->total_cost }}">
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-2 control-label">Actual Cost</label>
                                <div class="col-md-10">
                                    <input type="text" name="actual_cost" class="form-control" disabled value="{{ $actual_cost }}">
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-2 control-label">Remaining Balance</label>
                                <div class="col-md-10">
                                    <input type="text" name="resultant_balance" class="form-control" disabled value="{{ $balance->total_cost-$actual_cost }}">
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-2 control-label">Real Balance</label>
                                <div class="col-md-10">
                                    <input type="text" name="real_balance" class="form-control" disabled value="{{ $balance->total_cost+Auth::user()->balance-$actual_cost }}">
                                </div>
                            </div>                            

                        <div class="form-group{{ $errors->has('reviewer') ? ' has-error' : '' }}">
                            <label for="reviewer" class="col-md-2 control-label">Choose Reviewer: </label>

                            <div class="col-md-10">
                                 <select name="reviewer" class="form-control" value="{{ old('reviewer') }}" id="reviewer" required autofocus>
                                   <option value="">Choose Reviewer: </option>
                                    @foreach($reviewer_list as $reviewer)
                                    <option value="{{ $reviewer->email }}">{{ $reviewer->name }} - {{ $reviewer->title }}</option>
                                    @endforeach
                                 </select>
                                
                                @if ($errors->has('reviewer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reviewer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
@if($actual_cost>$balance->total_cost)
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="reset" class="btn btn-success btn-block disabled">
                                    Submit Remarks
                                </button>
                                    <span class="help-block" style="color: red;">
                                        <strong>The Actual Cost cannot be greater than Total Cost. Please review Implementation Status of Activities</strong>
                                    </span>
                            </div>
                        </div>
@else
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-success btn-block">
                                    Submit Remarks
                                </button>
                            </div>
                        </div>
@endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
