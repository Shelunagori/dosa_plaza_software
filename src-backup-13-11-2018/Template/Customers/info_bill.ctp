<br/>
<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Name"   name="name" id="c_name" value="<?php echo @$Customer->name;?>">
    </div>
    <div class="col-md-6">
        <input type="text"  class="form-control" placeholder="Mobile"    name="mobile_no" id="asdasd" value="<?php echo @$Customer->mobile_no;?>" maxlength="10" minlength="10">
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-6">
        <input type="text"  class="form-control" placeholder="Email"    name="email" id="c_email" value="<?php echo @$Customer->email;?>">
    </div>
    <div class="col-md-6">
        <?php
            $options=[];
            $options[]=['text' =>1, 'value' => 1];
            $options[]=['text' =>2, 'value' => 2];
            $options[]=['text' =>3, 'value' => 3];
            $options[]=['text' =>4, 'value' => 4];
            $options[]=['text' =>5, 'value' => 5];
            $options[]=['text' =>6, 'value' => 6];
            $options[]=['text' =>7, 'value' => 7];
            $options[]=['text' =>8, 'value' => 8];
            $options[]=['text' =>9, 'value' => 9];
            $options[]=['text' =>10, 'value' => 10];
            echo $this->Form->input('no_of_pax', ['empty' => "Select No. of Pax",'label' => false,'options' => $options,'class' => 'form-control','value' => @$Table->no_of_pax, 'id' => 'c_pax', 'value'=>$no_of_pax]); ?>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-6">
        <?php
        if(@$Customer->dob==""){
            $dob="";
        }else{
            $dob=date('Y-m-d',strtotime(@$Customer->dob));
        }
        ?>
        Date of Birth 
        <input type="date"  class="form-control" placeholder="Date of Birth"   name="dob" id="dob" value="<?php echo $dob; ?>">
    </div>
    <div class="col-md-6">
        <?php
        if(@$Customer->anniversary==""){
            $doa="";
        }else{
            $doa=date('Y-m-d',strtotime(@$Customer->anniversary));
        }
        ?>
        Date of Anniversary 
        <input type="date" class="form-control" placeholder="Date of Anniversary"   name="anniversary" id="doa" value="<?php echo $doa; ?>">
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12" style="padding-left: 15px; padding-right: 15px;">
        <textarea rows="4" cols="50" placeholder="Address..." name="address" id="c_address" style="line-height: 20px;resize: none;" class="form-control"><?php echo @$Customer->address;?></textarea>
    </div>
</div>
<br/>