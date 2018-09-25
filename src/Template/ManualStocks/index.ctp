<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Manual Stock | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption"style="padding:13px; color: red;">
                    Manual Stock
                </div>
                <div class="actions" style="margin-right: 10px;">
                    <input id="search3"  class="form-control" type="text" placeholder="Search" style="float: right;">
                </div>
                <br/>
                <div class="row">   
                    <div class="col-md-12 horizontal"></div>
                </div>
            </div>
            <div class="portlet-body">
                <form method="POST">
                    <label id="CurrentDate">Date</label>
                    <input name="date" class="form-control" type="text" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" style="width: 150px;">
                    <table class="table table-condensed table-hover" cellpadding="0" cellspacing="0" id="main_table">
                        <thead>
                            <tr>
                                <th style="width:10%"><?= ('S.No.') ?></th>
                                <th style="width:15%"><?= ('Raw materials') ?></th>
                                <th style="width:5%"><?= ('Unit') ?></th>
                                <th style="width:15%" ><?= ('Physical') ?></th>
                                <th style="width:15%" ><?= ('Computer') ?></th>
                            </tr>
                        </thead>
                        <tbody id="main_tbody">
                        <?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
                            <tr style="background-color: #d6d6d6;">
                                <td colspan="5" raw_material_sub_category_id="<?= h($RawMaterial->raw_material_sub_category->id) ?>" class="subCatRow" >
                                    <?= h($RawMaterial->raw_material_sub_category->name) ?>
                                </td>
                            </tr>
                            <tr class="main_tr">
                                <td><?= (++$d) ?></td>
                                <td><?= h($RawMaterial->name) ?></td>
                                <td><?= h($RawMaterial->primary_unit->name) ?></td>
                                <td>
                                    <input type="text" class="form-control input-sm input-small" name="physical[<?php echo $RawMaterial->id; ?>]" value="<?php echo @$data[$RawMaterial->id]; ?>">
                                </td>
                                <td>
                                    <span class="current_stock" name ="quantity"><?= h($RawMaterial->total_in - $RawMaterial->total_out) ?></span> 
                                    <?= h($RawMaterial->primary_unit->quantity) ?> 
                                </td>
                            </tr>
                            <?php $x++; endforeach; ?>
                        </tbody>
                    </table>
                    <div align="center">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?php
    $js="
    $(document).ready(function() {  
        var rows = $('#main_tbody tr.main_tr');
        $('#search3').on('keyup',function() {
          
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            var v = $(this).val();
            
            if(v){ 
                rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        
                    return !~text.indexOf(val);
                }).hide();
            }else{
                rows.show();
            }
        }); 

        var sub_category_id=0;
        $('.subCatRow').each(function(){
            var raw_material_sub_category_id= $(this).attr('raw_material_sub_category_id');
            if(sub_category_id!=raw_material_sub_category_id){
                sub_category_id = raw_material_sub_category_id;
            }else{
                $(this).remove();
            }
        });
        
    });
    ";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>