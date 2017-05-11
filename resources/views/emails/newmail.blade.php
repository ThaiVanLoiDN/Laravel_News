<!DOCTYPE html>
<html>
<body>

	<h2>Liên hệ - {{$nameWebsite}}</h2>

	<div>
		<p>Bạn nhận được liên hệ từ website <a href="{{ $diachiWebsite }}" title="{{ $nameWebsite }}" target="_blank">{{ $nameWebsite }}</a></p>
		<hr>
		<p>Họ tên: {{ $fullname }}</p>
		<p>Email: {{ $email }}</p>
		<p>Tiêu đề: {{ $title }}</p>
		<p>Nội dung: {!! $detail !!}</p>
	</div>

</body>
</html>
