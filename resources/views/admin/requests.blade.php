@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

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
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">My Requests</div>

                <div class="panel-body">
                    
                     <table id="clemtable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Date of Request:</th>
                            <th>Quarter:</th>
                            <th>Month</th>
                            <th>Business Status</th>
                            <th>Budget Status</th>
                            <th>Total Cost</th>
                            <th>View</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($requests as $requests)
                          <tr>
                            <td>{{ $requests->created_at }}</td>
                            <td>{{ $requests->quarter }}</td>
                            <td>{{ $requests->month }}</td>
                            
                            @if($requests->business_status == 'Settled')
                            <td class="success">{{ $requests->business_status }}</td>
                            @else
                            <td class="danger">{{ $requests->business_status }}</td>
                            @endif

                            @if($requests->budget_status == 'Approved')
                            <td class="success">{{ $requests->budget_status }}</td>
                            @else
                            <td class="danger">{{ $requests->budget_status }}</td>
                            @endif

                            <td>{{ $requests->market_cost+$requests->travelling_cost+$requests->fuel_cost+$requests->postage_cost+$requests->fax_cost }}</td>
                            <td><a href="#" class="btn btn-default">View</a></td>
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
