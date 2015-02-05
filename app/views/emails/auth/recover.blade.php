<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Hello, {{ $name }}</h1>

		<h3>New Password</h3>

		<div>

			<p>It looks like you've requested a new password. You'll need to use the following link to activate it. If you didn't request a new password, please ignore this email.</p>
			<strong>Your New Password: </strong> {{ $password }}
			<br>
			---<br>
			<strong>Use this Link: </strong> {{ $url }}
			<br>---

		</div>
	</body>
</html>
