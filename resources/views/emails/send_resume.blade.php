<!DOCTYPE html>
<html>
<head>
	<title>Resume from {{ $name }}</title>
</head>
<body>
	<p>Hello Admin,</p>
		<p>You have a resume email from {{ $name }}.</p>
		<p>Following are the details:</p>
		<p>Name: <b>{{ $name }}</b></p>
		<p>Email: <b>{{ $email }}</b></p>
		<p>Phone: <b>{{ $phone }}</b></p>
		<p>Please find the attached resume.</p>
</body>
</html>
