<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
</head>
<body>
	<p>Money to Pay: {{ $data['price'] }}</p>

	<form method="POST" action="{{ route('orders') }}">
		@csrf
		<input type="hidden" name="price" value="{{ $data['price'] }}">
		<input type="hidden" name="redirectUrl" value="{{ $data['redirectUrl'] }}">
		<input type="hidden" name="model_id" value="{{ $data['model_id'] }}">
		<input type="hidden" name="type" value="{{ $data['type'] }}">
		<button type="submit">Pay</button>
	</form>
</body>
</html>