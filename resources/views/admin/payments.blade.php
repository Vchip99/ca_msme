@extends('admin.master')
@section('header-title')
    <title>Payments</title>
@endsection
@section('header-css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/docstyle.css')}}">
<style type="text/css">
	.results-panel{
		padding: 20px 20px;
		margin-top: 40px;
		box-shadow: 0px 0px 15px #a8a8a8;
	}
	table{
		margin-top: 20px;
		border:1px solid #abb2b9;
	}
	th,td{
		padding: 5px 5px;
		width:9%;
	}
	td:hover{
		cursor: pointer;
	}
	.btn{
		font-size: 15px;
	}
	span{
		font-size: 17px;
		color: #000;
	}
	.rmv{
	   color: #fff;
	   font-size: 13px;
	}
	.btn-close{
		width: 25px;
		height: 25px;
   		padding: 3px 1px;
   		background-color: #ff0000;
	}
	.btn-close:hover{
   		background-color: #ff0000;
   		opacity: 0.8;
	}
	.heading{
		margin-top: 100px;
		font-size: 30px;
		color: #003d99;
	}

	.add-on .input-group-btn > .btn {
  		left:-2px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }
    .add-on .form-control:focus {
        box-shadow:none;
       -webkit-box-shadow:none;
        border-color:#cccccc;
    }
</style>
@stop
@section('content')
  @include('admin.header')
  	<div class="container-fluid" style="padding: 10px 40px;">
	    @if(Session::has('message'))
	      	<div class="alert alert-success" id="message">
	        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	          	{{ Session::get('message') }}
	      	</div>
	    @endif
	    <hr>
	    <div class="container-fluid results-panel table-responsive div-style">
	    	<center><h3 class=""><a>All Payments</a></h3></center>
	    	<table border="1">
	    		<thead>
	    		<tr>
	    			<th style="width: 5%;">Sr no.</th>
	    			<th>Date</th>
	    			<th>Order ID</th>
	    			<th>Payment Id</th>
	    			<th>Payment Request Id</th>
	    			<th>Payment Status</th>
	    			<th>Payment Done By</th>
	    			<th>Service Price</th>
	    		</tr>
	    		</thead>
	    		<tbody id="all_records" class="">
	    		@if(count($allPayments) > 0)
	    			@foreach($allPayments as $index => $allPayment)
	    				<tr>
		    				<td style="width: 5%;">{{ $index +1 }}</td>
			    			<td>{{ $allPayment->created_at}}</td>
			    			<td>{{ $allPayment->order_id}}</td>
			    			<td>{{ $allPayment->payment_id}}</td>
			    			<td>{{ $allPayment->payment_request_id}}</td>
			    			<td>{{ $allPayment->status}}</td>
			    			<td>{{ $allPayment->done_by}}</td>
			    			<td><b>Rs</b> {{ $allPayment->service_price}}</td>
			    			@php
			    				$totalAmount = $totalAmount + $allPayment->service_price;
			    			@endphp
			    		</tr>
	    			@endforeach
	    		@endif
	    			<tr>
			    		<td colspan="6"></td>
			    		<td><b>Total:</b></td>
			    		<td ><b>Rs</b> {{ $totalAmount }}</td>
			    	</tr>
    			</tbody>
	    	</table>
	    </div>
    </div>
@stop

