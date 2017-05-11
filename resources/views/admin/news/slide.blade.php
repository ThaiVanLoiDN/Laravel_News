<?php  
$is_slide = ($sl == 1)?'-o color-yellow':'-o color-green';
$sl = ($sl == 1)? 0 : 1;
?>
<a href="javascript:void(0)" onclick="changeSlide({{ $id }}, {{ $sl }})">
	<i class="fa fa-star{{ $is_slide }}" aria-hidden="true"></i>
</a>