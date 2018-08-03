@php
  $year = date('Y');
@endphp
<div class="footer-background" style="padding-bottom: 20px !important;">
  <div class="row">
    <div class="footer-content-div col-m-6 col-3" >
        <div class="footer-content-div-heading">REGISTRATION</div>
        <a href="{{ url('registration')}}"><div class="list-item">MSME Registration</div></a>
    </div>
    <div class="footer-content-div col-m-6 col-3" >
      <div class="footer-content-div-heading">OTHERS</div>
      <a href="{{ url('track-order') }}"><div class="list-item">Track Registration</div></a>
      <a href="{{ url('contact-us')}}"><div class="list-item">Contact us</div></a>
      <a href="{{url('faq')}}"><div class="list-item">FAQ</div></a>
      <a href="{{url('admin/login')}}"><div class="list-item">Admin</div></a>
    </div>
    <div class="footer-content-div col-m-6 col-3">
      <div class="footer-content-div-heading">POLICIES</div>
      <a href="{{ url('terms-and-conditions')}}"><div class="list-item">Terms & Conditions</div></a>
      <a href="{{ url('privacy-policy')}}"><div class="list-item">Privacy Policy</div></a>
      <a href="{{ url('disclaimer-policy')}}"><div class="list-item">Disclaimer</div></a>
      <a href="{{ url('refund-policy')}}"><div class="list-item">Refund Policy</div></a>
      <a href="{{ url('about-us')}}"><div class="list-item">About Us</div></a>
    </div>
    <div class="footer-content-div col-m-6 col-3">
      <div class="footer-content-div-heading">PAYMENT TYPES</div>
      <img src="{{ asset('images/card-payment.png')}}" style="width: 200px;">
    </div>
  </div>
  <!-- <div class="row ">
      <div class="footer-content-div col-m-6 col-2" >
        <a href="{{ url('terms-and-conditions')}}"><div class="small-item">Terms & Conditions</div></a>
      </div>
      <div class="footer-content-div col-m-6 col-2" >
          <a href="{{ url('privacy-policy')}}"><div class="small-item">Privacy Policy</div></a>
      </div>
      <div class="footer-content-div col-m-6 col-2" >
          <a href="{{ url('disclaimer-policy')}}"><div class="small-item">Disclaimer</div></a>
      </div>
      <div class="footer-content-div col-m-6 col-2" >
         <a href="{{ url('refund-policy')}}"><div class="small-item">Refund Policy</div></a>
      </div>
      <div class="footer-content-div col-m-6 col-2" >
          <a href="{{ url('about-us')}}"><div class="small-item">ABOUT US</div></a>
      </div>
  </div> -->
  <div align="center" ><div class="small-item">&copy; {{$year}}, ALL RIGHT RESERVED.</div></div>
</div>
<script type="text/javascript">
  $(document).scroll(function() { var y = $(this).scrollTop(); if (y > 400) { $('#msmeImg').fadeOut(); } else { $('#msmeImg').fadeIn(); } });
</script>