@extends('dashboard.master')
@section('module_title')
  <section class="content-header">
    <h1> Billing </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-inr"></i> Billing</li>
      <li class="active">Billing </li>
    </ol>
  </section>
@stop
@section('dashboard_content')
	<div class="container">
		<div class="results-panel table-responsive">
      <div class="list-bar">All Records</div>
        <table border="1">
            <thead>
            <tr>
                <th>Sr no.</th>
                <th>Date</th>
                <th>Order ID</th>
                <th>Application Status</th>
                <th>Payment</th>
            </tr>
            </thead>
            <tbody id="all_records" class="">
            @if(count($allRegistrations) > 0)
                @foreach($allRegistrations as $index => $registration)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$registration->created_at->format('Y-m-d')}}</td>
                        <td><a href="{{ url('enquiry')}}/{{$registration->order_id}}">{{$registration->order_id}}</a></td>
                        <td>{{$registration->applicationStatus()}}
                        </td>
                        <td>
                          Rs. {{$registration->payment()}}
                          @php
                            $total += $registration->payment();
                          @endphp
                        </td>
                    </tr>
                @endforeach
            @endif
            @if($total > 0)
              <tr>
                  <td colspan="3"></td>
                  <td><b>Total</b></td>
                  <td><b>Rs. {{$total}}</b></td>
              </tr>
            @endif
            </tbody>
        </table>
    </div>
	</div>
@stop