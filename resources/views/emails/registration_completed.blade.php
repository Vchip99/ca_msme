<!DOCTYPE html>
<html>
<head>
	<title>New {{ $service }} Registration</title>
</head>
<body>
	<p>Dear User,</p>
		<p>You have successfully registered for <b>{{ $service }} registration service</b>.</p>
		<p>Your orderId is: <b>{{ $orderId }}</b></p>
		<p>Track your order at: <a href="{{ url('track-order')}}/{{$orderId }}">{{ $orderId }}</a></p>
		<p>Thanks for showing interest in msme.online.com.</p>
	<p>Thanks</p>
	<p>Team</p>
	<p>msme.online.com.</p>
</body>
</html>