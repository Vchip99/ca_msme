<!DOCTYPE html>
<html>
<head>
	<title>Contact us from {{ $name }}</title>
</head>
<body>
	<p>Hello Admin,</p>
		<p>You have a contact us email from {{ $name }}.</p>
		<p>Following are the details:</p>
		<p>Name: <b>{{ $name }}</b></p>
		<p>Email: <b>{{ $email }}</b></p>
		<p>Message: <b>{{ $user_message }}</b></p>
</body>
</html>
