<!DOCTYPE html>
<html>
<body>

	<h2>Liên hệ - {{$nameWebsite}}</h2>

	<div>
		<p>Bạn có một bình luận đang chờ xử lí từ website <a href="{{ $diachiWebsite }}" title="{{ $nameWebsite }}" target="_blank">{{ $nameWebsite }}</a></p>
		<hr>
		<p>Họ tên: {{ $hoten }}</p>
		<p>Email: {{ $email }}</p>
		<p>Nội dung: {!! $content !!}</p>
		<p><a href="{{route('admin.comments.index')}}">CLICK HERE</a></p>
	</div>

</body>
</html>
