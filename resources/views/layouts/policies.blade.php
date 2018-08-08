@extends('layouts.master')
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
          This Privacy Policy governs the manner in which msme.com collects, uses, maintains and discloses information collected from users

          (each, a "User") of the http://msme.com website ("Site"). This privacy policy applies to the Site and all the information provided

          on site.
          </p>
          <h4 style="text-align:center">1. PERSONAL IDENTIFICATION INFORMATION</h4>
          <p>

          We may collect personal identification information from Users in a variety of ways, including, but not limited to, when Users visit our site,

          register on the site, place an application, and in connection with other activities, services, features or resources we make available on our Site.

          Users may be asked for, as appropriate, name, email address, mailing address, phone number. Users may, however, visit our Site anonymously.

          We will collect personal identification information from Users only if they voluntarily submit such information to us. Users can always refuse to

          supply personally identification information, except that it may prevent them from engaging in certain Site related activities.

          </p>
          <h4 style="text-align:center">2. NON-PERSONAL IDENTIFICATION INFORMATION</h4>
          <p>

          We may collect non-personal identification information about Users whenever they interact with our Site. Non-personal identification

          information may include the browser name, the type of computer and technical information about Users means of connection to our Site, such as

          the operating system and the Internet service providers' utilized and other similar information.

          </p>
          <h4 style="text-align:center">3. WEB BROWSER COOKIES</h4>
          <p>

          Our Site may use "cookies" to enhance User experience. User's web browser places cookies on their hard drive for record-keeping purposes and

          sometimes to track information about them. User may choose to set their web browser to refuse cookies, or to alert you when cookies are being

          sent. If they do so, note that some parts of the Site may not function properly.

          </p>
          <h4 style="text-align:center">4. HOW WE PROTECT YOUR INFORMATION</h4>
          <p>

          We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration,

          disclosure or destruction of your personal information, transaction information and data stored on our Site.

          Sensitive and private data exchange between the Site and its Users happens over a SSL secured communication channel and is encrypted and

          protected with digital signatures. Our Site is also in compliance with PCI vulnerability standards in order to create as secure of an environment

          as possible for Users.

          </p>
          <h4 style="text-align:center">5. COMPLIANCE WITH CHILDREN'S ONLINE PRIVACY PROTECTION ACT</h4>
          <p>

          Protecting the privacy of the very young is especially important. For that reason, we never collect or maintain information at our Site from those

          we actually know are under 13, and no part of our website is structured to attract anyone under 13.

          </p>
          <h4 style="text-align:center">6. CHANGES TO THIS PRIVACY POLICY</h4>
          <p>

          msme.com have the discretion to update this privacy policy at any time. We encourage Users to frequently check this page for any

          changes to stay informed about how we are helping to protect the personal information we collect. You acknowledge and agree that it is your

          responsibility to review this privacy policy periodically and become aware of modifications.</p>
    </div>
  </div>
  @include('footer.footer')
@stop