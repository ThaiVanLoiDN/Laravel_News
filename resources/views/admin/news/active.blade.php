<?php  
	$is_active = ($gt == 1)?'active.png':'disactive.png';
	$gt = ($gt == 1)?'0':'1';
?>
<a href="javascript:void(0)" onclick="changeActive({{ $id }}, {{ $gt }})">
  <img src="{{$adminUrl}}/images/{{$is_active}}" width="20px">
</a>