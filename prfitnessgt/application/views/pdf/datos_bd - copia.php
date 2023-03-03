<html>
  <head>
      <link rel="stylesheet" type="text/css" href="./assets/css/dompdf.css">
  </head>

<body>
  <header>
 
      <table>
          <tr>
              <td id="header_logo">
                  <img id="logo" style="height:62px; " src="./assets/img/logo-congreso.jpg">
              </td>
              <td id="header_texto">
                  <div>ORGANISMO LEGISLATIVO</div> 
                  <div>DIRECCION DE RECURSOS HUMANOS</div> 
                  <div>EVALUACION DE DESEMPEÑO</div>
                  <div>INSTRUMENTO DE EVALUACION DEL DESEMPEÑO</div>
               
              </td>

          </tr>
     </table>  
  </header>

  <table border="0" id="table_dgene">
       <thead>
       
           <tr>   
           <td></td>
           <th>DATOS GENERALES DEL EVALUADOR Y EL EVALUADO</th>
           </tr>
       </thead>
   
</table> 

<table border="1" id="tabla_info_ev1">
    <thead>
        <tbody>
          <?php foreach ($detalles as $detalle) { ?>
            <tr>
                <th>No. DE ID EMPLEADO</td>
                <td><?php echo $detalle->Idc;?></td>   
                <th>PUESTO</td> 
                <td><?php echo $detalle->puesto;?></td>
                <th>NOMBRE DEL EVALUADO</td>
                <td><?php echo $detalle->nombres. ' '.$detalle->apellidos;?></td>  
            </tr>
            <tr>
                <th>RENGLON PRESUPUESTARIO</td>
                <td>011 change</td>
                <th>UBICACION</td>
                <td><?php echo $detalle->nombre_direccion. ' / '.$detalle->nombre_depto;?></td>
                <th>OFICINA</td>
                <td><?php echo $detalle->NomOf;?></td>
            </tr>
                  
            <tr>
                <th>NIVEL ACADEMICO</td>
                <td><?php echo $detalle->nacademico;?></td>
                <th >MAIL</td>
                <td><?php echo $detalle->correo;?></td>
                <th>TELEFONOD DE EMPLEADO</td>
                <td><?php echo $detalle->no_telefono;?></td>
            </tr>

            <tr>
                
                <th>No. DE ID JEFE INMEDIATO</th>
                 <td><?php echo $this->session->userdata("id_work")/*.'/'.$this->session->userdata(" puestojefe")*/ ; ?>
                <th>NOMBRE DEL ENCARGADO</th>
                <td><?php echo $detalle->id_evaluador;?></td>
                <th>TIPO EVALUACION</th>  
                <td><?php echo $detalle->nombre;?></td>
            </tr>

             <tr>
                
                <th>FECHA DE EVALUACION</th>
                <td><?php 
                        $originalDate = $detalle->fecha_evaluacion;
                        $newDate = date("d/m/Y", strtotime($originalDate));
                        echo $newDate;
                ?></td>
                <th>FUNCIONES</th>  
                <td colspan=3><?php echo $detalle->funciones;?></td>
           </tr>
        </tbody>
    </thead>
</table> 


<!-- Notas de la eveluacion ! -->
<table border="0" id="table_dgene">
       <thead>
           <tr>
           <th colspan=15>DESEMPEÑO GENERAL</th>
           </tr>
       </thead>
      
</table> 

<table border="1" id="table_dgene">
       <thead>
      
           <tr>
                <td colspan=13>1. CONOCIMIENTO ESPECIFICO EN EL PUESTO:</th>
                <td><?php echo $detalle->cep;?></td>
            </tr>
            <tr>
           <td colspan=13>2. CUMPLIMIENTO DE INSTRUCIONES O TAREAS: </td>
           <td><?php echo $detalle->cit;?></td> 
           </tr>
           <tr>
           <td  colspan=13>3. ADMINISTRACION DEL TIEMPO DE TRABAJO: </td>
           <td><?php echo $detalle->adt;?></td>
           </tr>
           <tr>
           <td  colspan=13>4. CALIDAD DE EJECUCION DE TRABAJO: </td>
           <td><?php echo $detalle->cei;?></td>
           </tr>
           <tr>
           <td  colspan=13>5. COMPROMISO CON LA INSTITUCION: </td>
           <td><?php echo $detalle->cci;?></td>
           </tr>
           <tr>
           <td  colspan=13>6. NIVEL DE SUPERVISION REQUERIDA: </td>
           <td><?php echo $detalle->nsr;?></td>
           </tr>
           <tr>
           <td  colspan=13>7. CONFIABILIDAD: </td>
           <td><?php echo $detalle->cof;?></td>
           </tr>
           <tr>
           <td  colspan=13>8. INICIATIVA Y PROACTIVIDAD: </td>
           <td><?php echo $detalle->iyp;?></td>
           </tr>
           <tr>
           <td  colspan=13>9. ORIENTACION A RESULTADOS: </td>
           <td><?php echo $detalle->oar;?></td>
           </tr>
           <tr>
           <td  colspan=13>10.TRABAJO EN EQUIPO : </td>
           <td><?php echo $detalle->tee;?></td> 
           </tr> 
            <tr>
           <th colspan=13>NOTA DESEMPEÑO GENERAL</th>
           
           <td><?php echo $detalle->desem_general;?></td>
           </tr>  
          
    
<!-- NORMAS DE CONDUCTA GENERAL -->
           <!--     <tr>
                <th colspan=13>NORMAS DE CONDUCTA GENERAL</th> 
                <td> </td>
                </tr>
                <tr>
                <td colspan=13>17. DISCIPLINA EN EL TRABAJO:</td>  
                <td><?php echo $detalle->det;?></td>
              
                </tr>
                <tr>
                <td colspan=13>18. ORDEN EN SU LUGAR DE TRABAJO: </td>
                <td><?php echo $detalle->olt;?></td> 
                </tr>
                <tr>
                <th colspan=13>NOTA CONDUCTA GENERAL</th>
                <td><?php echo $detalle->normas_cod_general;?></td>
                </tr>    -->
<!--  comunicacion -->
<!--                <tr>
                <th colspan=13>COMUNICACION</th> 
                <td> </td>
                <tr>
                <td colspan=13>19. HABILIDAD PARA TRANSMITIR SUS IDEAS:</td>  
                <td><?php echo $detalle->hti;?></td>
              
                </tr>
                <tr>
                <td colspan=13>20. HABILIDAD PARA ESCUCHAR: </td>
                <td><?php echo $detalle->hpe;?></td> 
                </tr>
                <tr>
                <th colspan=13>NOTA COMUNICACION</th>
                <td><?php echo $detalle->comunicacion;?></td>
                </tr> 
          -->

            </thead>
       <tbody>
</table> 


<table border="0" id="table_dgeneT2">
       <thead>
           <tr>
           <th>NIVEL DE SERVICIO</th>
           </tr>
       </thead>
      
</table>

<table border="1" id="table_dgene2">
       <thead>
        </tbody>
          <!-- nivel de servicio--> 
               
       
                <tr>
                
                <td colspan=13>11. ACTITUD DE SERVICIO:</td>  
                <td><?php echo $detalle->ads;?></td>
                </tr>
                <tr>
                <td colspan=13>12. MANEJO DE SITUACIONES BAJO PRESION: </td>
                <td><?php echo $detalle->msbp;?></td> 
                </tr>
                <tr>
                <td colspan=13>13. DISPOSICION: </td>
                <td><?php echo $detalle->disp;?></td>
                </tr>
                <tr>
                <td colspan=13>14. MANEJO Y RESOLUCION DE CONFLICTOS: </td>
                <td><?php echo $detalle->mrc;?></td>
                </tr>
                <tr>
              
                <th colspan=13>NOTA NIVEL DE SERVICIO</th>
                <td><?php echo $detalle->nivel_servicio;?></td>
                </tr>
            <!-- herramientas de trabajo -->
                <tr>
                <th colspan=13>MANEJO DE HERRAMIENTAS DE TRABAJO</th> 
                <td> </td>
                </tr>

                <tr>
                <td colspan=13>15. CONOCIMIENTO EN EL USO DE HERRAMIENTAS DE TRABAJO:</td>  
                <td><?php echo $detalle->cuht;?></td>
              
                </tr>
                <tr>
                <td colspan=13>16. UTILIZACION EFICIENTE DE LOS RECURSOS ASIGNADOS: </td>
                <td><?php echo $detalle->uera;?></td> 
                </tr>
                <tr>
                <th colspan=13>NOTA MANEJO DE HERRAMIENTAS DE TRABAJO</th>
                <td><?php echo $detalle->mane_herra_de_trabajo;?></td>
                </tr>
                <tr> 
                    <!--NORMAS DE CONDUCTA GENERAL  -->
                <th colspan=13>NORMAS DE CONDUCTA GENERAL</th> 
                <td> </td>
                </tr>
                <tr>
                <td colspan=13>17. DISCIPLINA EN EL TRABAJO:</td>  
                <td><?php echo $detalle->det;?></td>
              
                </tr>
                <tr>
                <td colspan=13>18. ORDEN EN SU LUGAR DE TRABAJO: </td>
                <td><?php echo $detalle->olt;?></td> 
                </tr>
                <tr>
                <th colspan=13>NOTA CONDUCTA GENERAL</th>
                <td><?php echo $detalle->normas_cod_general;?></td>
                </tr>

                <!--COMUNICACION -->
                <tr>
                <th colspan=13>COMUNICACION</th> 
                <td> </td>
                <tr>
                <td colspan=13>19. HABILIDAD PARA TRANSMITIR SUS IDEAS:</td>  
                <td><?php echo $detalle->hti;?></td>
              
                </tr>
                <tr>
                <td colspan=13>20. HABILIDAD PARA ESCUCHAR: </td>
                <td><?php echo $detalle->hpe;?></td> 
                </tr>
                <tr>
                <th colspan=13>NOTA COMUNICACION</th>
                <td><?php echo $detalle->comunicacion;?></td>
                </tr>
       </thead>
       <tbody>
</table> 

<table border="1" id="table_dgeneD">
       <thead>
       <tr>
        <th colspan=13>PLAN INDIVIDUAL DE DESARROLLO </th>
        <td><?php echo $detalle->plan_desarrollo;?></td>
        </tr>
        <tr>
        <th colspan=13>OBSERVACIONES </th>
        <td><?php echo $detalle->observaciones;?></td>
        </tr>
       </thead>
       
</table> 


<table border="1" id="table_infoX">


<table border="0" id="table_dgene">
       <thead>
           <tr>
           <th colspan=30> PONDERACION DE FACTORES </th>  
           </tr>
       </thead>
       
</table> 
<table border="1" id="table_infoX">
            
            <thead>   


            <tr colspan=30>
                <th colspan=30>FACTOR</th>
                <th colspan=30>PONDERACION</th>
                <th colspan=30>SUB TOTAL</th>
            </tr>
               
               
                <tr>
                <td colspan=30> DESEMPEÑO GENERAL:</td>  
                
                <td colspan=30>40 %</td>
                <td colspan=30><?php echo $detalle->desem_general;?></td>
                </tr>
                <tr>
                <td colspan=30>SERVICIO: </td>
                <td colspan=30>20 %</td>
                <td colspan=30><?php echo $detalle->nivel_servicio;?></td> 
                </tr>
                <tr>
                <td colspan=30>MANEJO DE HERRAMIENTAS DE TRABAJO</td>
                <td colspan=30>15 %</td>
                <td colspan=30><?php echo $detalle->mane_herra_de_trabajo;?></td>
                </tr>
                <tr>
                <td colspan=30>NORMAS DE CONDUCTA GENERAL</td>
                <td colspan=30>10 %</td>
                <td colspan=30><?php echo $detalle->normas_cod_general;?></td>
                </tr>
                <tr>
                <td colspan=30>COMUNICACION</td>
                <td colspan=30>15 %</td>
                <td colspan=30><?php echo $detalle->comunicacion;?></td>
                </tr>
            </thead>
            
     </table> 

    <table border="0" id="table_dgene">
            
            <thead>   
           
                </tr>
                <tr>
                <th>PUNTEO FINAL DE EVALUACION ANUAL: </th>
                <td><?php echo $detalle->pfevaluacion;?></td> 
                </tr>
               
            </thead>
           
     </table> 

       
</table>

<table border="0" id="table_sign">
             <thead>   
           
                <tr>
                    <th><?php echo $detalle->nombres. ' '.$detalle->apellidos;?></th> 
                     <th><?php echo $detalle->id_evaluador;?></th> 
                 </tr>
                <tr>
                <th> <?php echo $detalle->puesto;?></th>
                </tr>
               
            </thead>
            <tbody>
                 <?php  }?>
            </tbody>
     </table> 

</body>
</html>
