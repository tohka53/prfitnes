<html>
  <head>
      <link rel="stylesheet" type="text/css" href="./assets/css/dompdf.css">
  </head>

<body>

  <header>
      <table>
          <tr>
              <td id="header_logo">
                  <img id="logo" style="height:62px; " src="./assets/images/logo-congreso.jpg">
              </td>
              <td id="header_texto">
                  <div>Reporte Actividades</div>
                  <div>Departamento de Mantenimiento</div>
                  <div>CONGRESO DE LA REPUBLICA DE GUATEMALA</div>
              </td>
          </tr>
      </table>
  </header>

  <table border="1" id="table_info">
       <thead>
           <tr>
               <th>Fecha de solicitud</th>
               <th>No. Boleta</th>
               <th>Oficina Socitante</th>
               <th>Ubicacion</th>
               <th>Telefono</th>
               <th>Falla Reportada</th>
               <th>Persona Asignada</th>
               <th>Tipo de trabajo | Estatus</th>
               
           </tr>
       </thead>
       <tbody>
          <?php foreach ($detalles as $detalle) { ?>
            <tr>
                <td><?php echo $detalle->fecha_detalle_boleta;?></td>
                <td style="text-align:center"><?php echo $detalle->orden_detalle_boleta;?></td>
                <td><?php echo $detalle->nombre_oficina;?></td>
                <td><?php echo $detalle->descripcion_edificio; echo " ";
                          echo $detalle->nivel_oficina; echo " ";
                          echo $detalle->no_oficina;?>
                </td>
                <td><?php echo $detalle->no_telefono; 
                          echo $ext = ($detalle->ext_telefono != "")? "  ext: " . $detalle->ext_telefono: "";?>
                </td>
                <td><?php echo $detalle->falla_reportada_detalle_boleta;?></td>
                <td><?php echo $detalle->id_tec; ?></td>
                <td><?php echo $detalle->nombre_tipo_trabajo;?> | <?php echo ($detalle->nombre_estado_trabajo == 'Realizado')? ' R': ' P';?></td>   
                
                
            </tr>
          <?php  }?>
       </tbody>
</table>



</body>
</html>
