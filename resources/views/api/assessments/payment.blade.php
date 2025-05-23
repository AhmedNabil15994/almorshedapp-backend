<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
</head>
<body>
	<p>Money to Pay: {{ $assessment->price }}</p>

	<form method="POST" action="{{ route('assessments') }}">
		@csrf
		<input type="hidden" name="price" value="{{ $assessment->price }}">
		<input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
		<button type="submit">Pay</button>
	</form>
</body>
</html>