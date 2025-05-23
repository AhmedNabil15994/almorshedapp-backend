<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

@if (is_rtl() == 'rtl')
	<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
@else
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@endif

<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

<style>
	body {
		font-family: 'Cairo', sans-serif;
	}
</style>


<title>@yield('title', '--') || {{ config('app.name') }}</title>