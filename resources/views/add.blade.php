@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


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

            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;"><b>Add Request:</b></div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" id="inst_form" method="POST" action="{{ url('/add/post') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }} - {{ Auth::user()->title }}" required autofocus disabled>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Location:</label>

                            <div class="col-md-6">
                                @foreach($branch_details as $branch_details)
                                <p>{{ $branch_details->b_name }} -- {{ $branch_details->b_region}} -- {{ $branch_details->b_zone }}</p>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                            <label for="month" class="col-md-4 control-label">Month</label>

                            <div class="col-md-6">
                                 <select name="month" class="form-control" id="month" required autofocus>
                                   <option value="{{ old('month') }}">{{ old('month') }}</option>
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

                        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                            <label for="place" class="col-md-4 control-label">Place</label>

                            <div class="col-md-6">
                                <input id="place" type="text" name="place" class="form-control" value="{{ old('place') }}">

                                @if ($errors->has('place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<div id="container">

                        <div class="form-group{{ $errors->has('market_cost') ? ' has-error' : '' }}">
                            <label for="market_cost" class="col-md-4 control-label">Market Cost</label>

                            <div class="col-md-6">
                                <input placeholder="Maximum limit {{ $limits->market_cost }}" id="market_cost" type="text" class="inst_amount form-control" name="market_cost" pattern="[0-9]{*}" value="{{ old('market_cost') }}" required>

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
                                <input placeholder="Maximum limit {{ $limits->travelling_cost }}" id="travelling_cost" type="text" class="inst_amount form-control" name="travelling_cost" pattern="[0-9]{*}" value="{{ old('travelling_cost') }}" required>

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
                                <input placeholder="Maximum limit {{ $limits->fuel_cost }}" id="fuel_cost" type="text" class="inst_amount form-control" name="fuel_cost" pattern="[0-9]{*}" value="{{ old('fuel_cost') }}" required>

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
                                <input placeholder="Maximum limit {{ $limits->postage_cost }}" id="postage_cost" type="text" class="inst_amount form-control" name="postage_cost" pattern="[0-9]{*}" value="{{ old('postage_cost') }}" required>

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
                                <input placeholder="Maximum limit {{ $limits->fax_cost }}" id="fax_cost" type="text" class="inst_amount form-control" name="fax_cost" pattern="[0-9]{*}" value="{{ old('fax_cost') }}" required>

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
                        <input type="text" class="form-control" id="total_amount" name="total_cost" value="{{ old('total_cost') }}" required disabled>

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
                                <textarea id="output_description" class="form-control" name="output_description" required>{{ old('output_description') }}</textarea>

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
                                <input id="expected_premium" type="text" class="form-control" name="expected_premium" pattern="[0-9]{*}" value="{{ old('expected_premium') }}" required>

                                @if ($errors->has('expected_premium'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expected_premium') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reviewer') ? ' has-error' : '' }}">
                            <label for="reviewer" class="col-md-4 control-label">Choose Reviewer</label>

                            <div class="col-md-6">
                                 <select name="reviewer" class="form-control" id="reviewer" required autofocus>
                                   <option value="{{ old('reviewer') }}">{{ old('reviewer') }}</option>
                                    @foreach($reviewer_list as $reviewer)
                                    <option value="{{ $reviewer->name }}">{{ $reviewer->name }} - {{ $reviewer->title }}</option>
                                    @endforeach
                                 </select>
                                
                                @if ($errors->has('reviewer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reviewer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-4 control-label">File Uploaded:</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required>

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    Request
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
