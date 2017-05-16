<form action="<?php echo $action; ?>" method="POST" id="paygol_checkout">
    <input type="hidden" name="pg_serviceid" value="<?php echo $merchant_id; ?>">
	<input type="hidden" name="pg_currency" value="<?php echo $currency; ?>">
	<input type="hidden" name="pg_name" value="<?php echo $description." - ".$items_text; ?>">
	<input type="hidden" name="pg_custom" value="<?php echo $order_id.";".$amount.";".$customer_id; ?>">
	<input type="hidden" name="pg_price" value="<?php echo $amount; ?>">
	<input type="hidden" name="pg_return_url" value="<?php echo $return_url; ?>">
	<input type="hidden" name="pg_cancel_url" value="<?php echo $cancel_url."&custom=".$order_id.";".$customer_id; ?>">
	<div class="buttons">
		<div class="pull-right">
			<input id="button-confirm" onclick="" type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
		</div>
	</div>
</form>
<script>
	$(function(){
		$('#button-confirm').bind('click',function(){
			$.ajax({
			type: 'post',
			url: 'index.php?route=extension/payment/paygol/confirm',
			cache: false,
			});
			$('#paygol_checkout').submit();
		});
		
	});
</script>