@extends('layouts.master')
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
@stop
@section('content')
  @include('header.header')
  <div class="container" style="padding: 20px 20px 10px 20px;">
    <div class="div-style">
        <h1 style="text-align:center">REFUND POLICY</h1>
		<h4 style="text-align:center">1. REFUND OF PAYMENT RECEIVED</h4>
		<p>

		For any reason if your business cannot be registered in MSME and not able to provide you MSME certificate then

		100% of money will be refunded in the same mode you have paid.

		</p>
		<h4 style="text-align:center">2. REFUND REQUEST</h4>
		<p>

		Refund request can be send at help@msme.com. Refund request can be made within 10 days of online

		application made.

		</p>

		<h4 style="text-align:center">3. REFUND TIME FRAME</h4>
		 <p>

		We will process your refund request within 10 to 15 business days of receiving all the information required for processing refund like reason for refund, bank details for processing request, etc.

		</p>
		<br>
		<h4 style="text-align:center">4. CANCELLATION OF APPLICATION</h4>
		<p>

		You cannot cancel the registration once applied. No Refund will be provided once the application is done and

		MSME Certificate is issued.

		</p>
		<h4 style="text-align:center">5. ISSUANCE OF MSME CERTIFICATE</h4>
		<p>

		MSME Registration certificate Applied online, will be delivered within 24 hours to the Email Id provided in the

		online application form.

		</p>
		<h4 style="text-align:center">6. CLARIFICATION ABOUT APPLICATION</h4>
		<p>

		If you have any query about application process, you can write us mail @ help@msme.com.

		In case we need any additional clarification about your business activity our team will reach you by email or call.

		</p>
		<h4 style="text-align:center">7. FORCE MAJEURE</h4>
		<p>

		msme.com shall not be considered in breach of its Satisfaction Guarantee policy or default under any

		terms of service, and shall not be liable to the Client for any cessation, interruption, or delay in the performance of

		its obligations by reason of earthquake, flood, fire, storm, lightning, drought, landslide, hurricane, cyclone,

		typhoon, tornado, natural disaster, act of God or the public enemy, epidemic, famine or plague, action of a court or

		public authority, change in law, explosion, war, terrorism, armed conflict, labor strike, lockout, boycott or similar

		event beyond our reasonable control, whether foreseen or unforeseen (each a "Force Majeure Event").
		</p>
    </div>
  </div>
  @include('footer.footer')
@stop