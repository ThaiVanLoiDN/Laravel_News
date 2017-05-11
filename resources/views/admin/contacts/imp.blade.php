<?php  
$is_imp = ($qt == 1)?' color-yellow':'-o color-green';
$qt = ($qt == 1)? 0 : 1;
?>
<a href="javascript:void(0)" onclick="changeImp({{ $id }}, {{ $qt }})">
	<i class="fa fa-star{{ $is_imp }}" aria-hidden="true"></i>
</a>