@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:url(/img/bg2.jpg); background-size:cover; color: white;">Dashboard</div>

                <div class="panel-body">
                 <h4>  <b>&nbsp Account Balance:</b> {{ Auth::user()->balance }} TZS </h4>
                   <br>
                       <div class="row">
       
 <div class="card col-md-3">
<a href="#" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_unapproved }}</b></h4>
    <p>Unapproved Activity Plans</p>
  </div>
  </a>
</div> 

 <div class="card col-md-3">
<a href="#" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_unsettled }}</b></h4>
    <p>Unsettled Business</p>
  </div>
  </a>
</div> 

 <div class="card col-md-3">
<a href="#" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_unsettled_activities }}</b></h4>
    <p>Unsettled Activities</p>
  </div>
  </a>
</div> 

 <div class="card col-md-3">
<a href="#" style="color: black;">
  <span class="fa fa-cloud"></span>
  <div class="container">
    <h4><b>{{ $count_pushed }}</b></h4>
    <p>Pushed Forward Activities </p>
  </div>
  </a>
</div> 

<br>
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
