@extends('layouts.app')

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
                            <th>Open</th>
                            <th>Follow</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($list_requests as $list)
                          <tr>
                            <td>{{ $list->created_at }}</td>
                            <td>{{ $list->quarter }}</td>
                            <td>{{ $list->month }}</td>
                            
                            @if($list->business_status == 'Settled')
                            <td class="success">{{ $list->business_status }}</td>
                            @else
                            <td class="danger">{{ $list->business_status }}</td>
                            @endif

                            @if($list->budget_status == 'Approved')
                            <td class="success">{{ $list->budget_status }}</td>
                            @else
                            <td class="danger">{{ $list->budget_status }}</td>
                            @endif

                            <td>{{ $list->market_cost+$list->travelling_cost+$list->fuel_cost+$list->postage_cost+$list->fax_cost }}</td>

<td> <a href="/view-file-738283873764671737{{ $list->budget_id }}93624163535261" class="btn btn-warning">Get File</a></td>


                            <td> <a href="/requests/follow-up/32789{{ $list->budget_id }}43789721" class="btn btn-success">Follow-up</a></td>
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
