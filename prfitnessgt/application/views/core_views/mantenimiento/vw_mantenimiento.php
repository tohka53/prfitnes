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
	$(document).ready(function(){
		/* lotes */

		url = "<?=$this->uri->segment(1)?>";
		if(url == "lotes"){
		//	$()
		}

		/* detalle nave */
		var wto;
		$("#field-fecha_toma_datos,#field-id_lote").bind("change",function(e){	
			if ($("#field-id_lote").val() != "" && $("#field-fecha_toma_datos").val() != "" ) {

				var no_lote = $("#field-id_lote").val();
				var fecha = $("#field-fecha_toma_datos").val();
	
				$.ajax({
					method: "POST",
					contentType : "application/json; charset=utf-8",
					url:"<?=base_url() ?>ctrl_disasur/get_avarages",
/* 					dataType : "json",	 */				
					data: JSON.stringify({"fecha": fecha ,"lote": no_lote }),
					success : function(data){
						$('#field-promedio_peso').val(data[0].peso);
						$('#promedio_color').val(data[0].color);
						$('#promedio_buche').val(data[0].buche);
						$('#promedio_plumas').val(data[0].plumas);
					}
				});						
			}
		});
	})
</script>
