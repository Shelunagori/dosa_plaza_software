<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'User-Rights | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
                
            <div align="center">
                <?= $this->Form->create($userRight,['onsubmit'=>'return checkValidation()']) ?>
                    <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                        <tr>
                            <td width="20%">
                                <div class="caption"style="padding:13px; color: red;">
                                    User Rights
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                        <tr>
                            <td valign="button">
                                <div align="center">
                                    <table width="50%">
                                        <tr>
                                            <td>
                                                <?php echo $this->Form->control('user_id',['empty'=>'- Select User -','class'=>'form-control input-sm getUser select2me','label'=>false, 'options' => $users,'required'=>'required']);
                                                ?>
                                            </td> 
                                        </tr>
                                    </table>
                                </div>
                            </td> 
                        </tr>
                    </table>
                    <div class="userData loading" style="text-align:left;width:80%">
                    
                    </div>
                    <br><br>
                    <div class="row showButtons" style="display:none">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6"></div>
                                <div class="col-md-2">
                                    <?php echo $this->Form->button('Submit',['class'=>'btn btn-danger']); ?>
                                </div>
                                <div class="col-md-3"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
    <!-- BEGIN COMPONENTS PICKERS -->
    <?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS PICKERS -->

    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->

    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
 <?php
    $js="
    $(document).ready(function(){
        $('.getUser').die().live('change',function(){ 
        var userid=$(this).val();
        $('.loading').html('loading...');
            var url='".$this->Url->build(["controller" => "UserRights", "action" => "ajaxUserRights"])."';
            url=url+'/'+userid
            $.ajax({
                url: url,
                type: 'GET'
                //dataType: 'text'
            }).done(function(response) {
            //alert(response);
                $('.loading').val();
                //var fetch=$.parseJSON(response);
                $('.userData').html(response);
                $('.showButtons').show();
                
            }); 
            });
            
        });
        $(document).ready(function(){
        $('.checkAll').live('click', function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
              ";
    echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
        