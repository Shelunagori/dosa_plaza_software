<style type="text/css">
	.Dbox{
		width: 230px;
	    margin: 5px;
	    background-color: #FFF;
	    padding: 0px;
	    border-radius: 7px !important;
	    position: relative;
	    margin-bottom: 3px;
	    display: inline-block;
	}
</style>
<?php foreach ($Bills as $Bill) { ?>
<div class="Dbox"> 
	<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Bills','action'=>'paymentinfo2')) ?>">
		<div style="font-size:14px;">
			<input type="hidden" name="bill_id" value="<?php echo $Bill->id; ?>" >
			<div>
				<table width="100%" style="font-size:12px;line-height: 22px; border: 2px solid #ccc;">
					<tr>
						<td valign="top" align="center">
							<span style="font-size: 14px; color: #3b393a;">Take Away: <b> <?= h($Bill->take_away_no) ?> </b></span><br/>
							<span style="font-size: 14px; color: #3b393a;">Customer <b> <?= h($Bill->customer->name) ?> </b></span><br/>
							<span style="font-size: 14px; color: #3b393a;">Delivery <b> <?= h($Bill->created_on->format('d-m-Y H:i A')) ?> </b></span><br/>
							<span style="font-size: 14px; color: #3b393a;">Bill Amount <b> ₹ <?= h($Bill->grand_total) ?> </b></span>
						</td>
					</tr> 
					<tr>
						<td valign="top">
							<table width="100%"> 
								<tr>
									<td>
										<label class="radio-inline"><input type="radio" name="payment_type" value="cash" checked> Cash  </label>
									</td>
									<td>
										<label class="radio-inline"><input type="radio" name="payment_type" value="card"> Card  </label>
									</td>
									<td>
										<label class="radio-inline"><input type="radio" name="payment_type" value="paytm"> Paytm </label>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign="top" style="padding-top:10px;padding-bottom: 8px;" align="center">
							<button type="submit" style="padding: 2px 8px 3px 10px;font-size: 12px;" class="btn  btn-sm btn-danger showLoader">Submit</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</div>
<?php } ?>
<div align="center"><br/>
	<button type="button" class="btn btn-danger Newdelevery showLoader"><i class="fa fa-plus"></i> New Take Away</button>
</div>


<?php 
$js="
$(document).ready(function() {
    $('.Newdelevery').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'kots','action'=>'generate','0','takeaway'])."'
        window.location.href = url; 
    });
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>