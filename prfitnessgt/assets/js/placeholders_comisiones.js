$(document).ready(function(){
    
    /* placeholder - comisiones archivos */
    $('#field-fecha_archivos').attr('placeholder','ej. 15/01/2018');
	$('#field-nombre_archivo').attr('placeholder','ej. Nombre del archivo');
    
    $('#field-fecha_archivos, #field-fecha_fondo').change(function(){
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
    });
	
	      
    /* placeholder - comisiones dictamenes */
	$('#field-nombre_dictamen').attr('placeholder','ej. dictamen favorable iniciativa 1000');
	$('#field-fecha_dictamen').attr('placeholder','ej. 15/01/2018');
	
	/* placeholder - comisiones fondos rotativos */
	$('#field-nombre_fondo').attr('placeholder','ej. fondo ratorivo');
	$('#field-fecha_fondo').attr('placeholder','ej. 15/01/2018');
	
	/* placeholder - comisiones sesiones */
	$('#field-nombre_sesion').attr('placeholder','ej. sesion uno');
	$('#field-fecha_sesion').attr('placeholder','ej. 15/01/2018');
		
	/* placeholder - comisiones viajes */
	$('#field-fecha_viaje').attr('placeholder','ej. 15/01/2018');

	/* placeholder - comisiones calendario de actividades */
	$('#field-date').attr('placeholder','ej. 15/01/2018');	
	$('#field-title').attr('placeholder','ej. Reunión Comisión');
	$('#field-location').attr('placeholder','ej. 9 A, 9-44 Z1, Guatemala, Guatemala');
		
	/* placeholder - comisiones convocatorias */
	$('#field-convocatoria').attr('placeholder','descripción de la convocatoria');	
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

