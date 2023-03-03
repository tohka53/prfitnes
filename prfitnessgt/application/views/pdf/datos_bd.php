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

  <table id="table_dgene">
        <tr>   
        <?php foreach ($detalles as $detalle) { ?>
           <th>DATOS GENERALES DEL EVALUADOR Y EL EVALUADO</th>
             <td id = "num"> <?php echo "No. ".$detalle->id_evaluacion; ?> </td>
           </tr>
</table> 

<table border="1" id="tabla_info_ev1">
    <thead>
        <tbody>
      
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
                <td><?php echo"11"?></td>
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
                <td><?php echo $detalle->id_evaluador ?></td>
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

<!--
<!-- Notas de la eveluacion ! 
<table border="0" id="table_dgene">
       <thead>
           <tr>
           <th colspan=15>  ESEMPEÑO GENERAL</th>
           </tr>
       </thead>
      
</table> 
-->
<table border="1" id="table_dgene">
     <!--  <thead> -->
       
       <tr>
            <th rowspan=2>DESEMPEÑO GENERAL</th>
            <td colspan=3>SOBRESALIENTE</td>
            <td colspan=3>SATISFACTORIO</td>
            <td colspan=3>REGULAR</td>
            <td colspan=10>INSATISFACTORIO</td>
         
      </tr>
            <tr>
                <td colspan=3>10 puntos</td>
                <td colspan=3>De 7 a 9 puntos</td>
                <td colspan=3>De 4 a 6 puntos</td>
                <td colspan=10>De 1 a 3 puntos</td>
                
            </tr>

           <tr>
                <td colspan=10>1. CONOCIMIENTO ESPECIFICO EN EL PUESTO:</th>
                <td colspan=10><?php echo $detalle->cep;?></td>
            </tr>
            <tr>
           <td colspan=10>2. CUMPLIMIENTO DE INSTRUCIONES O TAREAS: </td>
           <td colspan=10><?php echo $detalle->cit;?></td> 
           </tr>
           <tr>
           <td colspan=10>3. ADMINISTRACION DEL TIEMPO DE TRABAJO: </td>
           <td colspan=10><?php echo $detalle->adt;?></td>
           </tr>
           <tr>
           <td colspan=10>4. CALIDAD DE EJECUCION DE TRABAJO: </td>
           <td colspan=10><?php echo $detalle->cei;?></td>
           </tr>
           <tr>
           <td colspan=10>5. COMPROMISO CON LA INSTITUCION: </td>
           <td  colspan=10><?php echo $detalle->cci;?></td>
           </tr>
           <tr>
           <td colspan=10>6. NIVEL DE SUPERVISION REQUERIDA: </td>
           <td  colspan=10><?php echo $detalle->nsr;?></td>
           </tr>
           <tr>
           <td colspan=10>7. CONFIABILIDAD: </td>
           <td colspan=10><?php echo $detalle->cof;?></td>
           </tr>
           <tr>
           <td colspan=10>8. INICIATIVA Y PROACTIVIDAD: </td>
           <td colspan=10><?php echo $detalle->iyp;?></td>
           </tr>
           <tr>
           <td colspan=10>9. ORIENTACION A RESULTADOS: </td>
           <td colspan=10><?php echo $detalle->oar;?></td>
           </tr>
           <tr>
           <td colspan=10>10.TRABAJO EN EQUIPO : </td>
           <td colspan=10><?php echo $detalle->tee;?></td> 
           </tr> 
      <!--    
           <tr>
            <th colspan=10>NOTA DESEMPEÑO GENERAL</th>
            <td colspan=10><?php echo $detalle->desem_general;?></td>
            </tr>  
       -->
           <tr>
                <th colspan=10>SUMATORIA DE COLUMNA</th>
                <th colspan=10><?php 
                            $sumDespG = $detalle->cep + $detalle->cit + $detalle->adt + $detalle->cei
                                    +$detalle->cci + $detalle->nsr + $detalle->cof + $detalle->iyp
                                    +$detalle->oar + $detalle->tee;
                            echo $sumDespG;
                
                ?></th>
            </tr>  


            <tr>
                
                <td colspan=10>11. ACTITUD DE SERVICIO:</td>  
                <td  colspan=10><?php echo $detalle->ads;?></td>
                </tr>
                <tr>
                <td colspan=10>12. MANEJO DE SITUACIONES BAJO PRESION: </td>
                <td  colspan=10><?php echo $detalle->msbp;?></td> 
                </tr>
                <tr>
                <td colspan=10>13. DISPOSICION: </td>
                <td  colspan=10><?php echo $detalle->disp;?></td>
                </tr>
                <tr>
                <td colspan=10>14. MANEJO Y RESOLUCION DE CONFLICTOS: </td>
                <td colspan=10><?php echo $detalle->mrc;?></td>
                </tr>
                <tr>
              
                <th colspan=10>SUMATORIA DE COLUMNA</th>
                <th colspan=10><?php 
                        $sumNivSer = $detalle->ads + $detalle->msbp + 
                        $detalle->disp + $detalle->mrc; 
                        echo $sumNivSer;?></th>
                </tr>

         <!--       <th colspan=10>NOTA NIVEL DE SERVICIO</th>
                <td colspan=10><?php echo $detalle->nivel_servicio;?></td>
                </tr>  -->
            <!-- herramientas de trabajo -->
                <tr>
                <th colspan=10>MANEJO DE HERRAMIENTAS DE TRABAJO</th> 
                <td colspan=10> </td>
                </tr>

                <tr>
                <td colspan=10>15. CONOCIMIENTO EN EL USO DE HERRAMIENTAS DE TRABAJO:</td>  
                <td colspan=10><?php echo $detalle->cuht;?></td>
                </tr>
                <tr>
                <td colspan=10>16. UTILIZACION EFICIENTE DE LOS RECURSOS ASIGNADOS: </td>
                <td colspan=10><?php echo $detalle->uera;?></td> 
                </tr>

                <tr>
                <th colspan=10>SUMATORIA DE COLUMNA</th>
                <th colspan=10><?php 
                                $sumManHtrb = $detalle->cuht + $detalle->uera;	
                                echo $sumManHtrb;?></th>
                </tr> 
               
      <!--          <tr>
                <th colspan=10>NOTA MANEJO DE HERRAMIENTAS DE TRABAJO</th>
                <td colspan=10><?php echo $detalle->mane_herra_de_trabajo;?></td>
                </tr>   -->
        
    
<!-- NORMAS DE CONDUCTA GENERAL -->
               <tr>
                <th colspan=10>NORMAS DE CONDUCTA GENERAL</th> 
                <td colspan=10> </td>
                </tr>
                <tr>
                <td colspan=10>17. DISCIPLINA EN EL TRABAJO:</td>  
                <td colspan=10><?php echo $detalle->det;?></td>
              
                </tr>
                <tr>
                <td colspan=10>18. ORDEN EN SU LUGAR DE TRABAJO: </td>
                <td colspan=10><?php echo $detalle->olt;?></td> 
                </tr>
                <tr>
                
                <th colspan=10>SUMATORIA DE COLUMNA</th>
                <th colspan=10><?php 
                                $sumNorCond = $detalle->det + $detalle->olt;
                                echo $sumNorCond;?></td>
                </th>
     <!--           <th colspan=10>NOTA CONDUCTA GENERAL</th>
                <td colspan=10><?php echo $detalle->normas_cod_general;?></td>
                </tr>     -->
<!--  comunicacion -->
             <tr>
                <th colspan=10>COMUNICACION</th> 
                <td colspan=10> </td>
                <tr>
                <td colspan=10>19. HABILIDAD PARA TRANSMITIR SUS IDEAS:</td>  
                <td colspan=10><?php echo $detalle->hti;?></td>
              
                </tr>
                <tr>
                <td colspan=10>20. HABILIDAD PARA ESCUCHAR: </td>
                <td colspan=10><?php echo $detalle->hpe;?></td> 
                </tr>
                <tr>
                    <th colspan=10>SUMATORIA DE COLUMNA</th>
                    <th colspan=10><?php 
                                        $sumCOM =  $detalle->hti + $detalle->hpe;
                                        echo $sumCOM;?></th>
                </tr>
            <!--    <th colspan=10>NOTA COMUNICACION</th>
                <td colspan=10><?php echo $detalle->comunicacion;?></td>
                </tr>  -->
          

       <!--     </thead> -->
       <tbody>
</table> 
   <!--  
<tr>
                <th>NIVEL ACADEMICO</td>
                <td><?php echo $detalle->nacademico;?></td>
                <th >MAIL</td>
                <td><?php echo $detalle->correo;?></td>
                <th>TELEFONOD DE EMPLEADO</td>
                <td><?php echo $detalle->no_telefono;?></td>
            </tr>


   -->
<table border="1" id="table_dgene">
       
    <tr>
        <th>PLAN INDIVIDUAL DE DESARROLLO </th>
        <td><?php echo $detalle->plan_desarrollo;?></td>
        </tr>
        <tr> 
        <th>OBSERVACIONES </th>
        <td><?php echo $detalle->observaciones;?></td>
    </tr>
          </br></br></br></br>
       
</table> 


<table border="1" id="table_infoX">


<table border="0" id="table_dgene">
       <thead>
           <tr>
           <th> PONDERACION DE FACTORES </th>  
           </tr>
       </thead>
       
</table> 
<table border="1" id="table_infoX">
            
            <thead>   


            <tr>
                <th>FACTOR</th>
                <th>PONDERACION</th>
                <th>TOTAL POR FACTOR</th>
                <th>SUB TOTAL</th>
            </tr>
               
               
                <tr>
                <td> DESEMPEÑO GENERAL:</td>  
                
                <td>40 %</td>
                <td><?php echo $sumDespG;?></td>
                <td><?php echo $detalle->desem_general;  ?></td>
               
                </tr>
                <tr>
                <td>SERVICIO: </td>
                <td>20 %</td>
                <td><?php echo $sumNivSer;?></td> 
                <td><?php echo $detalle->nivel_servicio; ?></td>
                </tr>
                <tr>
                <td>MANEJO DE HERRAMIENTAS DE TRABAJO</td>
                <td>15 %</td>
                <td><?php echo $sumManHtrb;?></td>
                <td><?php echo $detalle->mane_herra_de_trabajo; ?></td>
                </tr>
                <tr>
                <td>NORMAS DE CONDUCTA GENERAL</td>
                <td>10 %</td>
                <td><?php echo $sumNorCond;?></td>
                <td><?php echo $detalle->normas_cod_general; ?></td>
                </tr>
                <tr>
                <td>COMUNICACION</td>
                <td>15 %</td>
                <td><?php echo $sumCOM;?></td>
                <td><?php echo $detalle->comunicacion; ?></td>
                </tr>
            </thead>
       
     </table> 

    <table border="1" id="table_dgene">
            
            <thead>   
           
          </br> </br>
                <tr>
                <th colspan=5>PUNTEO FINAL DE EVALUACION ANUAL: </th>
              
                <th><?php
                        $nf = $detalle->pfevaluacion;
                        if($nf >= 90){
                            echo "SOBRESALIENTE: ";
                            echo "Su desempeño es mejor de lo esperado y ";
                            echo "requerido para el puesto";
                        }elseif(($nf <= 89 )&& ($nf >= 75)) {
                            echo "SATISFACTORIO: ";
                            echo "Cumple con las atribuciones requeridas para el puesto";
                        }elseif(($nf <= 74 )&& ($nf >= 65) ){
                            echo "REGULAR: ";
                            echo "Su desempeño puede mejorar";
                            echo "en algunos aspectos";
                        }elseif($nf <= 64){
                            echo "INSATISFACTORIO:";
                            echo "No cumple con los requerimientos mínimos";
                            echo "para el desempeño del puesto";
                        }

                       ?></th> 
                       <th> <?php  echo $detalle->pfevaluacion; ?></th>
                       
                </tr>
               
            </thead>
           
     </table> 

<table border="0" id="table_sign">
             <thead>   
                    </br> </br>
                <tr>
                    <th><?php echo $detalle->id_evaluador;?></th> 
                    <th><?php echo $detalle->nombres. ' '.$detalle->apellidos;?></th> 
                    </tr>
                <tr>
                <th> <?php echo "Puesto del evaluador";?></th>
                <th> <?php echo $detalle->puesto;?></th>
                </tr>
               
            </thead>
            <tbody>
                 <?php  }?>
            </tbody>
     </table> 

</body>
</html>
