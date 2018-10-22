@extends('layouts.approvers')
@section('content')

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-success">
                            <div class="panel-heading">Approval Status</div>

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


                             <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"><h4 style="color: green;">Log Out Now................................</h4></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection