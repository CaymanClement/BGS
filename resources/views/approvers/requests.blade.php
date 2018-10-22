@extends('layouts.approvers')

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
                            <th>Name:</th>
                            <th>Date of Request:</th>
                            <th>Place:</th>
                            <th>Month</th>
                            <th>Total Cost</th>
                            <th>Budget Status</th>
                            <th>Approve</th>
                            <th>Details</th>
                            <th>View</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($requests as $requests)
                          <tr>
                            <td>{{ $requests->name }}</td>
                            <td>{{ $requests->created_at }}</td>
                            <td>{{ $requests->place }}</td>
                            <td>{{ $requests->month }}</td>
                            <td>{{ $requests->market_cost+$requests->travelling_cost+$requests->fuel_cost+$requests->postage_cost+$requests->fax_cost }}</td>

                            @if($requests->budget_status == 'Approved')
                            <td class="success">
{{ $requests->budget_status }}
                            </td>
                            <td><button class="btn btn-success disabled">Approve</button></td>


                            @else
                            <td class="danger">
{{ $requests->budget_status }}
                            </td>
                            <td><a href="/approve/329382329383293823983238{{ $requests->budget_id }}874393239328923982378923782739237" class="btn btn-success">Approve</a></td>
                            @endif
                            <td> <a href="/view-file-738283873764671737{{ $requests->budget_id }}93624163535261" class="btn btn-warning">View File</a></td>
                            <td><a href="/approver/view/32789{{ $requests->budget_id }}43789721" class="btn btn-default">Details</a></td>
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
