@extends('layouts.approvers')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Dashboard</div>

                <div class="panel-body">
                   <br>

                       <div class="row">
       
 <div class="card col-md-3">
<a href="/approver/requests" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_approved }}</b></h4>
    <p>Approved Activity Plans</p>
  </div>
  </a>
</div> 

 <div class="card col-md-3">
<a href="/approver/settle" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_unsettled }}</b></h4>
    <p>Submitted Remarks</p>
  </div>
  </a>
</div> 

 <div class="card col-md-3">
<a href="/approver/requests" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_returned }}</b></h4>
    <p>Returned Requests</p>
  </div>
  </a>
</div> 

 <div class="card col-md-3">
<a href="/approver/requests" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_unapproved }}</b></h4>
    <p>Pending Activity Plan Approvals</p>
  </div>
  </a>
</div> 

                    </div>
<br>

<div class="panel panel-success">
                <div class="panel-heading">Activity Plans Waiting for Approval</div>
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
<br>


<div class="panel panel-success">
                <div class="panel-heading">Remarks Submitted for Approval</div>
                    <div class="panel-body">
                    
                     <table id="clemtable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Name:</th>
                            <th>Month</th>
                            <th>Place</th>
                            <th>Output Description</th>
                            <th>Final Remarks</th>
                            <th>Impl. Status</th>
                            <th>Approve</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($remarks as $remarks)
                            <tr>
                            <td>{{ $remarks->updated_at }}</td>
                            <td>{{ $remarks->name }}</td>
                            <td>{{ $remarks->month }}</td>
                            <td>{{ $remarks->place }}</td>
                            <td>{{ $remarks->description }}</td>
                            <td>{{ $remarks->final_remarks }}</td>
                            <td><a href="/approver/settle/view9273829{{ $remarks->budget_id }}22938292" class="btn btn-default">View</a></td>
                            @if($remarks->remark_status == 'Business Settled')
                            <td><button class="btn btn-success disabled">Approve</button></td>
                            @else
                            <td><a href="/approver/remarks/approve/83921283{{ $remarks->remark_id }}83930293" class="btn btn-success">Approve</a></td>
                            @endif
                        </tr>
                            @endforeach
                        </tbody>
                      </table>
                  </div>
              </div>


                   <br>
                   <p align="center"> <b>Budget Total Cost to Total Amount in Current Quarter</b></p>
            <graph :keys="{{ $amount->keys() }}"  :values="{{ $amount->values() }}"></graph>

            <script src ="/js/main.js"> </script>
        </div>
    </div>
</div>
</div>
</div>
    

@endsection