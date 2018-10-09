@extends('layouts.admin')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading"  style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Branches</div>
                <div class="panel-body">
<a href="#" class="btn btn-success btn-block">Register Branch</a>

					<table id="clemtable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Branch Name:</th>
                            <th>Branch Region:</th>
                            <th>Branch Zone:</th>
                            <th>Created At:</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($branches as $branches)
                          <tr>
                            <td>{{ $branches->b_name }}</td>
                            <td>{{ $branches->b_region }}</td>
                            <td>{{ $branches->b_zone }}</td>
                            <td>{{ $branches->created_at }}</td>
                            @endforeach
                        </tbody>
                      </table>


                </div>
            </div>

@endsection
