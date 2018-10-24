@extends('layouts.auditor')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Settle Business</div>

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

           
                     <table id="clemtable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Name:</th>
                            <th>Month</th>
                            <th>Place</th>
                            <th>Output Description</th>
                            <th>Final Remarks</th>
                            <th>Approved By</th>
                            <th>Date</th>
                            <th>Business Status</th>
                            <th>Impl. Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        	@foreach($remarks as $remarks)
                        	<tr>
                            <td>{{ $remarks->name }}</td>
                            <td>{{ $remarks->month }}</td>
                            <td>{{ $remarks->place }}</td>
                            <td>{{ $remarks->description }}</td>
                            <td>{{ $remarks->final_remarks }}</td>
                            <td>{{ $remarks->approved_by }}</td>
                            <td>{{ $remarks->updated_at }}</td>
                            <td>{{ $remarks->remark_status }}</td>
                            <td><a href="/auditor/settle/view9273829{{ $remarks->budget_id }}22938292" class="btn btn-default">View</a></td>
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
