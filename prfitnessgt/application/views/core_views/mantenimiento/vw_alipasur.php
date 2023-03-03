<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-sm-12 ">
				Listado de mantenimiento para el sistema de ALIPASUR y DISASUR. 
				<br>				
				<br>
				<br>
				<?php echo $output; ?>				
			</div>
		</div>				
	</div>
</div>

<script>
<?php 
/* 
	initialized scripts
*/
?>
    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 2; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

	$(document).ready(function(){	
        $('#field-nombre').bind('change', function(){
            var name =  $('#field-nombre').val();
            var shorcutName = name.substring(0, 2);
            $id = makeid();	
		    $("#field-codigo").val(shorcutName + "-" + $id + "-CP");            
        });


    })
    

 
</script>
