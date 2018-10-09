@extends('layouts.approvers')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Update Request:</div>
                <div class="panel-body">
                    

                    <form class="form-horizontal" role="form" id="inst_form" method="POST" action="/approver/32789{{ $budget_details->budget_id }}43789721/edit/post">
                        {{ csrf_field() }}
      

                        <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                            <label for="month" class="col-md-4 control-label">Month</label>

                            <div class="col-md-6">
                                 <select name="month" class="form-control" value="{{ $budget_details->month }}" id="month" required autofocus>
                                   <option value="{{ $budget_details->month }}">{{ $budget_details->month }}</option>
                                   <option value="January">January</option>
                                   <option value="February">February</option>
                                   <option value="March">March</option>
                                   <option value="April">April</option>
                                   <option value="May">May</option>
                                   <option value="June">June</option>
                                   <option value="July">July</option>
                                   <option value="August">August</option>
                                   <option value="September">September</option>
                                   <option value="October">October</option>
                                   <option value="November">November</option>
                                   <option value="December">December</option>
                                 </select>
                                
                                @if ($errors->has('month'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<div id="container">

                        <div class="form-group{{ $errors->has('market_cost') ? ' has-error' : '' }}">
                            <label for="market_cost" class="col-md-4 control-label">Market Cost</label>

                            <div class="col-md-6">
                                <input id="market_cost" type="text" class="inst_amount form-control" name="market_cost" pattern="[0-9]{*}" value="{{ $budget_details->market_cost }}" required>

                                @if ($errors->has('market_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('market_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('travelling_cost') ? ' has-error' : '' }}">
                            <label for="travelling_cost" class="col-md-4 control-label">Travelling Local Cost</label>

                            <div class="col-md-6">
                                <input id="travelling_cost" type="text" class="inst_amount form-control" name="travelling_cost" pattern="[0-9]{*}" value="{{ $budget_details->travelling_cost }}" required>

                                @if ($errors->has('travelling_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('travelling_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fuel_cost') ? ' has-error' : '' }}">
                            <label for="fuel_cost" class="col-md-4 control-label">M/V Fuel & Lubricants Cost</label>

                            <div class="col-md-6">
                                <input id="fuel_cost" type="text" class="inst_amount form-control" name="fuel_cost" pattern="[0-9]{*}" value="{{ $budget_details->fuel_cost }}" required>

                                @if ($errors->has('fuel_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fuel_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postage_cost') ? ' has-error' : '' }}">
                            <label for="postage_cost" class="col-md-4 control-label">Postage Cost</label>

                            <div class="col-md-6">
                                <input id="postage_cost" type="text" class="inst_amount form-control" name="postage_cost" pattern="[0-9]{*}" value="{{ $budget_details->postage_cost }}" required>

                                @if ($errors->has('postage_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postage_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fax_cost') ? ' has-error' : '' }}">
                            <label for="fax_cost" class="col-md-4 control-label">Fax Cost</label>

                            <div class="col-md-6">
                                <input id="fax_cost" type="text" class="inst_amount form-control" name="fax_cost" pattern="[0-9]{*}" value="{{ $budget_details->fax_cost }}" required>

                                @if ($errors->has('fax_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fax_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('total_cost') ? ' has-error' : '' }}">
                            <label for="total_cost" class="col-md-4 control-label">Total Cost</label>

                            <div class="col-md-6">
                        <input type="text" class="form-control" id="total_amount" name="total_cost" required disabled>

                                @if ($errors->has('total_cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
</div>

                        <div class="form-group{{ $errors->has('output_description') ? ' has-error' : '' }}">
                            <label for="output_description" class="col-md-4 control-label">Expected output Description:</label>

                            <div class="col-md-6">
                                <textarea id="output_description" class="form-control" name="output_description" required>{{ $budget_details->description }}</textarea>

                                @if ($errors->has('output_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('output_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('expected_premium') ? ' has-error' : '' }}">
                            <label for="expected_premium" class="col-md-4 control-label">Expected Premium:</label>

                            <div class="col-md-6">
                                <input id="expected_premium" type="text" class="form-control" name="expected_premium" pattern="[0-9]{*}" value="{{ $budget_details->expected_premium }}" required>

                                @if ($errors->has('expected_premium'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expected_premium') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update Request
                                </button>
                            </div>
                        </div>
     
                    </form>
                
            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function sumIt() {
  var total = 0, val;
  $('.inst_amount').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  $('#total_price').html(Math.round(total));
  $('#total_amount').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","inst_amount").val(0))
      .before("<br/>");
    sumIt();  
  });


  $(document).on('input', '.inst_amount', sumIt);
  sumIt() // run when loading
});
</script>

@endsection