@extends('layouts.master')
@section('header-title')
	<title>Online Msme Registration | About Us </title>
@stop
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
@stop
@section('content')
  @include('header.header')
  <div class="container" style="padding: 20px 20px 10px 20px;">
    <div class="div-style">
	 	<h1 style="text-align:center;">About Us</h1>
		<p style="text-align: justify;">
		    Welcome to <a href="https://msme-online.org/" target="_blank">msme-online.org</a>.
		    We are the India's largest online business services platform dedicated to helping people easily start and grow their business, at an affordable cost. We were started in July 2017 with the mission of making it easier for Entrepreneurs to start their business.
		</p><br>
		<p style="text-align:justify;">
		    Our aim is to help the entrepreneur on the legal and regulatory requirements, and be a partner throughout the business lifecycle, offering support at every stage to ensure the business remains compliant and continually growing.
		</p>
	</div>
	</div>
  @include('footer.footer')
@stop