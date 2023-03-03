$(document).ready(function(){       
    /* placeholder - links articulos */    
    $('#field-articulos').attr('placeholder','Ingresa el nombre del articulo'); 
    $('#field-referencia').attr('placeholder','Ingresa la referencia del articulo');   
    $('#field-titulo').attr('placeholder','Ingresa el titulo del articulo');   
    
    /* placeholder - items articulos */
    $('#field-nombre_vinculo').attr('placeholder','ej. Dependencias '); 
    $('#field-slug').attr('placeholder','ej. link del item'); 
    
    /* placeholder - categorias items */
    $('#field-nombre_categoria').attr('placeholder','ej. Vinculo');   
    $('#field-pdf').attr('placeholder','ej. PDF'); 
    
    /* placeholder items contenido */
    $('#field-nombre').attr('placeholder','ej. 1.1 Estructura Orgánica'); 
    /* placeholder Tipo Vinculo Item */
    $('#field-tipo_contenido').attr('placeholder','ej. PDF'); 
    $('#field-slug_item').attr('placeholder','ej. Vinculo'); 
    

    /***********************************************************
    *
    *                       PROGRAMACIÓN 
    *
    ************************************************************/
            
    $('#field-link_or_dropdown').change(function(){    
        var show = $('#field-link_or_dropdown').val();
        if(parseInt(show) == 1){
            $('#field-slug').css({"visibility":"hidden"});
            $('#field-slug').prop('required',false);
        }else{
            $('#field-slug').css({"visibility":"visible"});
            $('#field-slug').prop('required',true);
        }        
    });
    
    $('#field-slug_item').css({"visibility":"hidden"});
        
    $('#field-id_tipo_contenido').change(function(){    
        var show = $('#field-id_tipo_contenido').val();
        /*var show = $('#field-link_or_dropdown').val();*/
        if(parseInt(show) == 1){
            $('input[type="file"]').removeAttr('disabled');
            $('input[type="file"]').prop('required',true);

            $('#field-slug_item').css({"visibility":"hidden"});
            $('#field-slug_item').prop('required',false);
            
        }else{
            $('input[type="file"]').attr('disabled', 'disabled' );
            $('input[type="file"]').prop('required', false );
            
            $('#field-slug_item').css({"visibility":"visible"});
            $('#field-slug_item').prop('required',true);
        }       
    });
        
    

});