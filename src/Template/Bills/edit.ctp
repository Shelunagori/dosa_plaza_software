<?php echo $this->Html->css('mystyle'); ?>

<?php $this->set("title", 'Bills | DOSA PLAZA'); ?>

<div style="height: 15px;" >.</div>
<div class="row">
    <div class="col-md-8 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Edit Bill: <?php echo $bill->voucher_no; ?>
                </div>
                <div class="tools">
                </div>
                <div class="actions"></div>
                <div class="row">   
                     <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <input type="hidden" id="bill_id" value="<?php echo $bill->id; ?>">
                <table width="100%" id="billTable">
                    <thead>
                        <tr style="border-bottom: solid 1px #F1F1F2; "> 
                            <th width="5%">#</th>
                            <th>Item</th>
                            <th style="text-align:center;" width="5%">Qty</th>
                            <th style="text-align:center;" width="10%">Rate</th>
                            <th style="text-align:center;" width="10%">Amount</th>
                            <th width="10%" style="text-align:center;">Dis%</th>
                            <th width="10%" style="text-align:center;">Dis₹</th>
                            <th width="10%" style="text-align:center;">GST</th>
                            <th style="text-align:right;" width="10%">Net</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sr=0;
                        foreach ($bill->bill_rows as $bill_row) { ?>
                        <tr style="border-bottom: solid 1px #F1F1F2; ">
                            <td><?php echo ++$sr; ?>.</td>
                            <td item_id="<?php echo $bill_row->item_id; ?>"><?php echo $bill_row->item->name; ?></td>
                            <td style="text-align:center;"><?php echo $bill_row->quantity; ?></td>
                            <td style="text-align:center;"><?php echo $bill_row->rate; ?></td>
                            <td style="text-align:center;"><?php echo $bill_row->amount; ?></td>
                            <td>
                                <?php if($bill_row->item->discount_applicable=='1'){ ?>
                                    <input type="text" style="width: 70px;" value="<?php echo $bill_row->discount_per; ?>" class="disBox" >
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($bill_row->item->discount_applicable=='1'){ ?>
                                    <input type="text" style="width: 70px;" value="<?php echo $bill_row->discount_amount; ?>" class="disBoxamt" >
                                <?php } ?>
                            </td>

                            <td style="text-align:center;"><?php echo $bill_row->tax_per; ?>%<span class="percen" style="display:none"><?php echo $bill_row->tax_per; ?></span></td>
                            <td style="text-align:right;"><?php echo $bill_row->net_amount; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; ">
                            <td colspan="5" style="text-align:right;"> Over All Discount</td>
                            <td colspan=""> <input type="text" class="overalldis" style="width:20%;text-align:center;width:100%;" placeholder=""></td>
                             
                            <td colspan="2" style="text-align:right;">Total</td>
                            <td style="text-align:right;"><?php echo $bill->total; ?></td>
                        </tr>
                    
                        <tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; "> 
                            <td colspan="8" style="text-align:right;">Round off</td>
                            <td style="text-align:right;"><?php echo $bill->round_off; ?></td>
                        </tr>
                        <tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background-color: #E6E7E8;font-weight: bold;"> 
                            <td colspan="8" style="text-align:right;">NET AMOUNT</td>
                            <td style="text-align:right;"><?php echo $bill->grand_total; ?></td>
                        </tr>
                    </tfoot>
                </table>
                <br/>
                <div align="center">
                    <button type="button" class="btn btn-danger SubmitBill">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #billTable tr td{
        padding:3px;
    }
</style>



<?php
$js="
$(document).ready(function() {
    $('.disBox').die().live('keyup',function(event){
        var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
        if(isNaN(qty)){ qty=0; }
        var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4)').text());
        if(isNaN(rate)){ rate=0; }
        var discount_per  = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
        if(isNaN(discount_per)){ discount_per=0; }
        var amount   = qty*rate;                        
        if(discount_per)
        {   
            var disAmt    = (amount*discount_per)/100;
            disAmt  = round(disAmt,2);
        }
        $(this).closest('tr').find('td:nth-child(7) input').val(disAmt);
        calculateBill();
    });
    
    $(document).on('keyup','.disBoxamt',function(e){
        var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
        if(isNaN(qty)){ qty=0; }

        var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4)').text());
        if(isNaN(rate)){ rate=0; }

        var discount_amt  = parseFloat($(this).closest('tr').find('td:nth-child(7) input').val());
        if(isNaN(discount_amt)){ discount_amt=0; }
        
        var amount   = qty*rate;

        if(discount_amt && amount>0)
        {   
            var dis_per   = (discount_amt*100)/amount;
            dis_per = round(dis_per,2);
            
        }
        $(this).closest('tr').find('td:nth-child(6) input').val(dis_per);
        calculateBill();
    });
    
    $('.overalldis').die().live('keyup',function(event){
        var dic = $(this).val();
        $('.disBox').val(dic);
        $('#billTable tbody tr').each(function(){
            var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
            if(isNaN(qty)){ qty=0; }
            var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4)').text());
            if(isNaN(rate)){ rate=0; }
            var discount_per  = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
            if(isNaN(discount_per)){ discount_per=0; }
            var amount   = qty*rate;                        
            if(discount_per)
            {   
                var disAmt    = (amount*discount_per)/100;
                disAmt  = round(disAmt,2);
            }
            $(this).closest('tr').find('td:nth-child(7) input').val(disAmt);
        });
        calculateBill();
    });
    
    function calculateBill(){
        var total=0;
        $('#billTable tbody tr').each(function(){
            var quantity=parseFloat($(this).find('td:nth-child(3)').text());
            var rate=parseFloat($(this).find('td:nth-child(4)').text());
            var amount=parseFloat($(this).find('td:nth-child(5)').text());
            var discount_amount=parseFloat($(this).find('td:nth-child(7) input').val());
            if(discount_amount){ 
                amount=round(amount-discount_amount,2);
            }
            var percen=parseFloat($(this).find('td:nth-child(8) span.percen').html());
            var taxamount=round((amount*percen)/100,2);
            var tot=amount+taxamount;
            tot=round(tot,2);
            $(this).find('td:nth-child(9)').text(tot);
            total=total+tot;
        });
        total=round(total,2);
        $('#billTable tfoot tr:nth-child(1) td:nth-child(4)').text(total); 
        var totalAfterTax=total-round(total);
        var totalAfterTaxRound=round(totalAfterTax,0);
        var roundOff=round(totalAfterTaxRound-totalAfterTax,2);
        $('#billTable tfoot tr:nth-child(2) td:nth-child(2)').text(roundOff);
        total=round(total);
        $('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text(total);
    }


    $('.SubmitBill').die().live('click',function(event){
        $('#loading').show();
        event.preventDefault();
        $(this).text('Saving...');
        var postData=[];
        $('#billTable tbody tr').each(function(){
            var item_id=$(this).find('td:nth-child(2)').attr('item_id');
            var quantity=$(this).find('td:nth-child(3)').text();
            var rate=$(this).find('td:nth-child(4)').text();
            var amount=$(this).find('td:nth-child(5)').text();
            var discount_per=$(this).find('td:nth-child(6) input').val();
            if(!discount_per){ discount_per=0;}
            var discount_amt=$(this).find('td:nth-child(7) input').val();
            if(!discount_amt){ discount_amt=0;}
            var percen=parseFloat($(this).find('td:nth-child(8) span.percen').html());
            var net_amount=$(this).find('td:nth-child(9)').text();
            postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount, discount_per : discount_per, net_amount : net_amount, percen : percen, discount_amt : discount_amt}); 
        });
        
        var bill_id = $('#bill_id').val();
        var total=$('#billTable tfoot tr:nth-child(1) td:nth-child(4)').text();
        var roundOff=$('#billTable tfoot tr:nth-child(2) td:nth-child(2)').text();
        var net=$('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text();
        
        var myJSON = JSON.stringify(postData);
        var url='".$this->Url->build(['controller'=>'Bills','action'=>'updateBill'])."';
        url=url+'?myJSON='+myJSON+'&bill_id='+bill_id+'&total='+total+'&roundOff='+roundOff+'&net='+net;
        url=encodeURI(url);
        console.log(url);
        $.ajax({
            url: url,
        }).done(function(response) {
            var url='".$this->Url->build(['controller'=>'Bills','action'=>'index'])."';
            window.location.href = url;
        });
    });


});
";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>