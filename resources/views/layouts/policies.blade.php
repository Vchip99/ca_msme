@extends('layouts.master')
@section('header-title')
    <title>Online Msme Registration | Privacy Policy </title>
@stop
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
@stop
@section('content')
  @include('header.header')
  <div class="container" style="padding: 20px 20px 10px 20px;">
    <div class="div-style">
        <h1 style="text-align:center">PRIVACY POLICY</h1>
          <p>
            Our organisation website does not automatically capture any specific personal information from you (like name, phone number or e-mail address, personal identification etc), that allows us to identify you individually. If you choose to provide us with your personal information, like names or e-mail addresses, when you visit our website, we use it only to comply your request for information.
          </p>
          <h4 style="text-align:center">1. PERSONAL AND NON PERSONAL IDENTIFICATION INFORMATION</h4>
          <p>
            We may collect Personal and non-personal identification information about Users whenever they interact with our Site. Non-personal identification information may include the browser name, the type of computer and technical information about Users means of connection to our Site, such as the operating system and the Internet service providers' utilized and other similar information.
          </p>
          <h4 style="text-align:center">2. USE OF COOKIES</h4>
          <p>
            A cookie is a piece of software code that an internet web site sends to your browser when you access information at that site. Cookies let you navigate between pages efficiently as they store your preferences, and generally improve your experience of a website.

            We are using only non-persistent cookies. These cookies do not collect personal information on users and they are deleted as soon as you leave our website.
          </p>
          <h4 style="text-align:center">3. HOW WE PROTECT YOUR INFORMATION</h4>
          <p>
            We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your personal information, transaction information and data stored on our Site.
            Sensitive and private data exchange between the Site and its Users happens over a SSL secured communication channel and is encrypted and protected with digital signatures. Our Site is also in compliance with PCI vulnerability standards in order to create as secure of an environment as possible for Users.
          </p>
          <h4 style="text-align:center">4. COMPLIANCE WITH CHILDREN'S ONLINE PRIVACY PROTECTION ACT</h4>
          <p>
            Protecting the privacy of the very young is especially important. For that reason, we never collect or maintain information at our Site from those we actually know are under 13, and no part of our website is structured to attract anyone under 13.
          </p>
          <h4 style="text-align:center">5. CHANGES TO THIS PRIVACY POLICY</h4>
          <p>
            msme-online.org have the discretion to update this privacy policy at any time. We encourage Users to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review this privacy policy periodically and become aware of modifications.
          </p>
    </div>
  </div>
  @include('footer.footer')
@stop