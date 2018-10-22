@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Reports</div>

                <div class="panel-body">

                	<p>Monthly Usage Report</p>
						<table id="clemtable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Month:</th>
                            <th>Quarter:</th>
                            <th>Total Cost</th>
                            <th>Actual Cost</th>
                            <th>Carry Over Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          	@foreach($budget_details as $bd)
                          	<tr>
                          	<td>{{ $bd->month }}</td>
                          	<td>{{ $bd->quarter }}</td>
                          	<td>{{ $bd->total_cost }}</td>
                          	<td>{{ $bd->actual_cost }}</td>
                          	<td>{{ $bd->carry_over_balance }}</td>
                            </tr>
                          	@endforeach

                        </tbody>
                      </table>        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
