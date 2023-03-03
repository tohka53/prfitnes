$(document).ready(function(){
    
    /* placeholder - Diputados */
    $('#field-id_diputado').attr('placeholder','ej. 1001');
    $('#field-id_tipo_ingreso').attr('placeholder','ej. ');
    $('#field-nombres').attr('placeholder','ej. Miguel');
    $('#field-apellidos').attr('placeholder','ej. Asturias');  
    $('#field-fecha_nacimiento').attr('placeholder','ej. 19/10/1899'); 
    $('#field-id_tipo_ingreso').attr('placeholder','ej. ');
    $('#field-edad').attr('placeholder','ej. 55');
    $('#field-edad').attr("readonly", "readonly");
    $('#field-cv').attr('placeholder','ej. ');
    $('#field-facebook').attr('placeholder','ej. facebook');
    $('#field-twitter').attr('placeholder','ej. twitter');
    $('#field-instagram').attr('placeholder','ej. instagram');
    $('#field-whatsapp').attr('placeholder','ej. 26552621');
    $('#field-website').attr('placeholder','ej. www.congreso.gob.gt/miguel_asturias');
    $('#field-dv_pdf').attr('placeholder','ej. ');
    $('#field-galeria_imagenes').attr('placeholder','ej. ');
    $('#field-galeria_videos').attr('placeholder','ej. ');
    $('#field-fecha_creacion').attr('placeholder','ej. 15/01/2018');
    
    $('#field-fecha_nacimiento').change(function(){
        var d = $('#field-fecha_nacimiento').val();
        var input = d.split("/");
        var dateObject = new Date(input[2] +"-"+ input[1] +"-"+ input[0]);
        //console.log(dateObject);
        var year = dateObject.getFullYear();
        //or without parsing simply
        var year = input[2];
        var currently = new Date();
        var currentlyYear =  currently.getFullYear();
        
        var yearOld = currentlyYear - year;
        
        $('#field-edad').val(yearOld);
    })
    
    
    
    /*placeholder - legislaturas */
    $('#field-legislatura').attr('placeholder','ej. Primera legislatura ');
    $('#field-anio_inicio').attr('placeholder','ej. 1986');
    $('#field-anio_fin').attr('placeholder','ej. 1990');
    
    /*placeholder - distritos */
    $('#field-nombre_distrito').attr('placeholder','ej. Guatemala');
   
    /*placeholder - bloques */
    $('#field-nombre_bloque').attr('placeholder','ej. partido');    
	$('#field-prefijo').attr('placeholder','ej. GT');    
    $('#field-sitio_web').attr('placeholder','ej. www.bloque-partido.com');
    $('#field-color').attr('placeholder','ej. azul y blanco');
    $('#field-anio_creacion').attr('placeholder','ej. 01/01/2018');
    /**
    * se agrega el valor de 1 al crear el bloque
    */
    $('#field-estado').val(1);
	
	
	/* bloques diputados */
	$('#field-fecha').attr('placeholder','ej. 01/01/2018');
    
    /*placeholder - curules */
    $('#field-no_curul').attr('placeholder','ej. 1'); 
    $('#field-posicion').attr('placeholder','ej. 1'); 
    $('#field-telefono').attr('placeholder','ej. 22447878 , 22447879'); 
    $('#field-extension').attr('placeholder','ej. 2244, 1154'); 
    
    /*placeholder - comisiones */
    $('#field-nombre_comision').attr('placeholder','ej. Comisión del Medio Ambiente'); 
    $('#field-youtube').attr('placeholder','ej. www.youtube.com/comision'); 
    $('#field-email').attr('placeholder','ej. comision@.congreso.gob.gt');
    $('#field-telefonos').attr('placeholder','ej. 22979300');
    $('#field-extensiones').attr('placeholder','ej. 1508');
  
    /*placeholder - categorías comisiones */
    $('#field-categoria_comision').attr('placeholder','ej. COMISIONES ORDINARIAS');      
    
    /*placeholder - categorías categoria ingreso diputados */
    $('#field-categoria_ingreso_diputado').attr('placeholder','ej. Regular');     
    
    /*placeholder - puestos juntas directivas */
    $('#field-puesto_directiva').attr('placeholder','ej. Presidente');    
	
	/* placeholder - oficinas */
	$('#field-nombre_oficina').attr('placeholder','ej. Oficina Presidencia');    
	
	/* placeholder periodos*/
    $('#field-periodo').attr('placeholder','ej. periodos');  
    

    /* agreaga la opcion de seleccionar en el primer option del select */
    $('select').each(function(){
        $(this).find('option:eq(0)').html('- Selecciona -');
    });
        
});

/** formato LA */
function findYearFrom() {
  // if it's not of 'type="date"', or it has no value,
  // or the value is equal to the default-value:
  if (this.type !== 'date' || !this.value || this.value === this.defaultValue) {
    // we return here
    return false;
  }

  // we get the value of the element as a date, and then
  // call getFullYear() on that value:
  console.log(this.valueAsDate.getFullYear());
  return this.valueAsDate.getFullYear();
}

