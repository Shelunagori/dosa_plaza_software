<form method="post">
    <table width="100%">
        <tr>
            <td>
                <div align="center" style="font-size: 16px;">Bill Header</div>
                <textarea id="summernote" name="header"><?php echo $BillSetting->header; ?></textarea>
            </td>
            <td width="20px;"></td>
            <td>
                <div align="center" style="font-size: 16px;">Bill Footer</div>
                <textarea id="summernote2" name="footer"><?php echo $BillSetting->footer; ?></textarea>
            </td>
        </tr>
    </table>
    <div align="center">
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<?php echo $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?> 
<?php echo $this->Html->script('http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?> 
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src=""></script>
<?php echo $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?> 

<?php 
$js="
$(document).ready(function() {
    $('#summernote').summernote();
    $('#summernote2').summernote();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>