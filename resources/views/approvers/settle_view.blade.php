@extends('layouts.approvers')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Implementation Status</div>

                <div class="panel-body">
       

<table class="table table-dark" id="clemtable">
    
    <thead>
        <tr>
            <th>Date of Visit</th>
            <th>Place</th>
            <th>Activities</th>
            <th>Remarks</th>
            <th>Total Cost</th>
            <th>Actual Cost</th>
            <th>Business Generation Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
            @foreach($implementation as $impl)
            <tr>
            <td>{{ $impl->date_of_visit }}</td>
            <td>{{ $impl->place }}</td>
            <td>{{ $impl->activities }}</td>
            <td>{{ $impl->remarks }}</td>
            <td>{{ $impl->total_cost }}</td>
            <td>{{ $impl->actual_cost }}</td>
            <td>{{ $impl->bgen_date }}</td>
            
            @if($impl->status == 'Settled')
            <td class="success">{{ $impl->status }}</td>
            @elseif($impl->status == 'Pushed Forward')
            <td class="warning">{{ $impl->status }}</td>
            @else
            <td class="danger">{{ $impl->status }}</td>
            @endif

            <td>
            </td>
            </tr>
            @endforeach
    </tbody>
</table>



        </div>
    </div>
</div>
</div>
</div
@endsection