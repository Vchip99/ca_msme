<!DOCTYPE html>
<html>
<head>
	<title>Enquiry email from {{ $name }}</title>
</head>
<body>
	<p>Hello Admin,</p>
		<p>You have a enquiry email from {{ $name }}.</p>
		<p>Following are the details:</p>
		<p>Name: <b>{{ $name }}</b></p>
		<p>Email: <b>{{ $email }}</b></p>
		<p>Mobile: <b>{{ $mobile }}</b></p>
</body>
</html>
