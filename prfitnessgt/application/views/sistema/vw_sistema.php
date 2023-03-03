<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <? /* evita conflicto */ ?>
    <script src="<?=base_url()?>assets/theme/js/bootstrap.min.js" type="text/javascript"></script>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
<script src="<?=base_url()?>assets/theme/js/demo.js"></script>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12 ">
				Usa las siguientes opciones:
                <p class="text-primary">
                - <span class="text-success">Añadir</span> : para agregar un nuevo item. <br>
                - <span class="text-success">Ver</span> (lupa): para ver un item. <br>
                - <span class="text-success">Editar</span> (lapiz): para editar un item. <br>
                - <span class="text-success">Eliminar</span> (signo menos en <span class="text-danger">rojo</span>): para eliminar un item.</p>
                <?php if( $this->uri->segment(1) == "imagenes_noticias" || $this->uri->segment(1) == "imagenes_bloques" || $this->uri->segment(1) == "imagenes_diputados" || $this->uri->segment(1) == "imagenes_comisiones" ): ?>   
					<button class="btn btn-success" style=" float: right !important;" onclick="goBack()">Regresar</button>

					<script>
					function goBack() {
						window.history.back();
					}
					</script>                 
                <? endif; ?>                
				<br>	              
				<?php echo $output; ?>	
                <br>
                <br>			
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
    
        <? if($this->uri->segment(1) != "subcategorias" && $this->uri->segment(1) != "categorias" && $this->uri->segment(1) != "sys_encabezado"): ?>
            $(document).ready(function(){

                $('#save-and-go-back-button, #form-button-save').click(function(){
                    $('input[type=text]').val(function () {
                        return this.value.toUpperCase();
                    });				
                });
            });
        <? endif; ?> 
	
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

        /* agreaga la opcion de seleccionar en el primer option del select */
        $('select').each(function(){
            $(this).find('option:eq(0)').html('- Selecciona -');
        });
             
        $("#field-oficina").change(function(){
            if($(this).val() != ""){
                $.ajax({
                    url : '<?=base_url()?>ctrl_ajax/get_all_office_data',
                    type: 'POST',
                    dataType : "json",
                    data: $(this).val(),
                    success : function(data){
                        
                        $('#field-edificio').val(data[0].nombre_edificio);
                        $('#field-nivel').val(data[0].no_nivel);
                        $('#field-dcp_nombre').val(data[0].dcp_nombre);
                        ext = (data[0].ext != "")? data[0].ext  : "N/A";
                        $('#field-extensiones').val(ext);
                        telefono = (data[0].telefonos != "")? data[0].telefonos  : "N/A";
                        $('#field-telefonos').val(telefono);
                    }
                });
            }else{
                $('#field-edificio, #field-nivel, #field-nivel, #field-dcp_nombre, #field-extensiones, #field-telefonos').val('');                                              
            }
        });
    
        <?php if( $this->uri->segment(1) == "comisiones_oficinas" && $this->uri->segment(2) == "add" ): ?>            
            /* cuando cambie la oficina  */
        	var select = $("#field-id_oficina").empty();
			var options = $("#field-id_oficina");							
			options.append('<option value="">- Selecciona un período -</option>');		
		
            $("#field-id_periodo").on("change",function(){	
				var select = $("#field-id_oficina").empty();
                var periodo = $(this).val();
                var data = {"id_periodo": periodo};
				/* cargan las oficinas por periodo */
               $.ajax({
                    url : '<?=base_url()?>ctrl_legislativo/get_oficinas_by_periodo',
                    type: 'POST',
                    data: JSON.stringify(data),  
                    contentType: "application/json",  
                    success : function(data){ 	
						data = jQuery.parseJSON( data );
						//var count = Object.keys(data).length;
						//console.log(data);
						if(data.response == undefined){
							var options = $("#field-id_oficina");
							$.each(data, function() {
								options.append(new Option(this.nombre_oficina, this.id));
							});							
						}else{
							var options = $("#field-id_oficina");							
							options.append('<option value="">- No existen oficinas -</option>');	
						}
					}, 
                    error: function(data){
                        console.log(data)
                    }
                });			
            }); 
        <?php endif; ?>
		
		<?php if( $this->uri->segment(1) == "sys_noticias" && $this->uri->segment(2) == "add" || $this->uri->segment(1) == "sys_noticias" && $this->uri->segment(2) == "edit"): ?>            		
			/* ajax population enlazar a */
			$('#field-id_tipo_noticia').change(function(){
				var select = $("#id_target").empty();
				var target = $(this).val();
				var data = {"target": target};				
				$.ajax({
					url : '<?=base_url()?>ctrl_comunicacion_social/get_list_of_targets',
					type: 'POST',
					data: JSON.stringify(data),  
					contentType: "application/json",  
					success : function(data){ 	
						//console.log(data);
						data = jQuery.parseJSON( data );						
						if(data.response == undefined){
							var options = $("#id_target");
							options.append('<option value="">- Selecciona -</option>');
							$.each(data, function() {
								options.append(new Option(this.text, this.id));
							});							
						}else{
							var options = $("#id_target");							
							options.append('<option value="">- No existen datos -</option>');	
						}
					}, 
					error: function(data){
						console.log(data)
					}
				});	
			});
		<?php endif; ?>
		<?php if( $this->uri->segment(1) == "sys_noticias" && $this->uri->segment(2) == "edit"  ): ?>            		
			/* ajax population enlazar a, editar*/
			
				/* guarda el dato para luego usarlo como target y seleccionar el item indicado */
				var value = $("#id_target").val();
				//console.log(value)
				var select = $("#id_target").empty();
				var target = $('#field-id_tipo_noticia').val();
				var data = {"target": target};				
				$.ajax({
					url : '<?=base_url()?>ctrl_comunicacion_social/get_list_of_targets',
					type: 'POST',
					data: JSON.stringify(data),  
					contentType: "application/json",  
					success : function(data){ 	
						//console.log(data);
						data = jQuery.parseJSON( data );						
						if(data.response == undefined){
							var options = $("#id_target");
							options.append('<option value="">- Selecciona -</option>');
							$.each(data, function() {
								options.append(new Option(this.text, this.id));
							});	
						}else{
							var options = $("#id_target");							
							options.append('<option value="">- No existen datos -</option>');	
						}						
						
						$("#id_target").val(value);
					}, 
					error: function(data){
						console.log(data)
					}
				});	
			//});
		<?php endif; ?>		
    });
</script>
