<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
</head>
<body>
	<p>Money to Pay: </p>

	<form method="POST" action="{{ route('reservations') }}">
		@csrf
		<input type="hidden" name="" value="">
		<button type="submit">Pay</button>
	</form>
</body>
</html>