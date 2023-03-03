<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?=ROOT_SYS;?>/assets/INIT/assets/img/favicon.ico">

	<title>CMS creator</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="<?=ROOT_SYS;?>/assets/INIT/assets/img/apple-icon.png" />
	<!-- link rel="icon" type="image/png" href="<?=ROOT_SYS;?>/assets/INIT/assets/img/favicon.png" / -->

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="<?=ROOT_SYS;?>/assets/INIT/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=ROOT_SYS;?>/assets/INIT/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="<?=ROOT_SYS;?>/assets/INIT/assets/css/demo.css" rel="stylesheet" />
	<style>
        @font-face {
            font-family: Quicksand;
            src: url(<?=ROOT_SYS?>/assets/fonts/Quicksand/Quicksand-Regular.ttf) format("truetype");
        }        
        @font-face {
            font-family: Anton;
            src: url(<?=ROOT_SYS?>/assets/fonts/Anton/Anton-Regular.ttf) format("truetype");
        }  
        
        h1{
            font-family: 'Quicksand', sans-serif !important;
        }
    </style>
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('<?=ROOT_SYS;?>/assets/INIT/assets/img/wizard-profile.jpg')">
	    <!--   Creative Tim Branding   -->
	    <a href="http://creative-tim.com">
	         <div class="logo-container">
	            <!--div class="logo">
	                <img src="<?=ROOT_SYS;?>/assets/INIT/assets/img/new_logo.png">
	            </div-->
	            <div class="brand">
	                CMS - creator
	            </div>
	        </div>
	    </a>

		<!--  Made By Oscar Ceballos  -->
		<a href="#" class="made-with-mk">
			<div class="brand">OC</div>
			<div class="made-with">Creado por <strong>Oscar Eli Ceballos Avila</strong></div>
		</a>

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="green" id="wizardProfile">
                            <? if (validation_errors() != ""):?>
                                <div class="form_error">
                                    <?php echo validation_errors(); ?>
                                </div>        
                            <? endif;?>                        
		                    <? echo form_open('revisar'); ?>
		      <!-- You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        	 - CREA UN NUEVO CMS -
		                        	</h3>
									<h5>Ingresa la siguiente información sobre el nuevo sistema.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">sistema</a></li>
			                            <li><a href="#account" data-toggle="tab">base de datos</a></li>
			                            <li><a href="#address" data-toggle="tab">Crear</a></li>
			                        </ul>
								</div>
                                <div class="progress-container">
  

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
                                    <h4 class="info-text"><b>Click en crear para continuar.</b></h4>
		                              <div class="row">		                                	
		                                	<div class="col-sm-10 col-sm-offset-1">		                                	    
												<div class="input-group">												    
													<span class="input-group-addon">
														<i class="material-icons">map</i>
													</span>
													<div class="form-group label-floating">                                               
			                                          <label class="control-label">Ruta del Sistema <small>(required)</small></label>
			                                          <!--input name="root_sys" type="text" class="form-control"-->
			                                         <? 
                                                        $data = array(
                                                            'type'  => 'text',
                                                            'name'  => 'root_sys',
                                                            'id'    => 'root_sys',                                                            
                                                            'class' => 'form-control',
                                                            'value' => ''
                                                        );

                                                        echo form_input($data);
                                                    ?>
			                                        </div>
												</div>
                                                <label for="">ej. <code>http://localhost/nombre_sistema</code></label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">folder</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Nombre del cms <small>(required)</small></label>
                                                    <? 
                                                        $data = array(
                                                            'type'  => 'text',
                                                            'name'  => 'sys_name',
                                                            'id'    => 'sys_name',
                                                            'class' => 'form-control',
                                                            'value' => ''
                                                        );

                                                        echo form_input($data);
                                                    ?>
													</div>
												</div>
                                                <label for=""><code>el nombre debe coincidir con el colocado en la ruta del sistema</code></label>
		                                	</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="account">
		                                <h4 class="info-text">Datos de la <b>Base de Datos</b> del cms </h4>
		                                <div class="row">
		                                	<div class="col-sm-10 col-sm-offset-1">		                                	    
												<div class="input-group">												    
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
													<div class="form-group label-floating">                                               
			                                          <label class="control-label">Usuario de la Base de Datos <small>(required)</small></label>
                                                    <? 
                                                        $data = array(
                                                            'type'  => 'text',
                                                            'name'  => 'db_user',
                                                            'id'    => 'db_user',
                                                            'class' => 'form-control',
                                                            'value' => 'root'
                                                        );

                                                        echo form_input($data);
                                                    ?>
			                                        </div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">storage</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Nombre de la Base de Datos <small>(required)</small></label>
                                                    <? 
                                                        $data = array(
                                                            'type'  => 'text',
                                                            'name'  => 'db_name',
                                                            'id'    => 'db_name',
                                                            'class' => 'form-control',
                                                            'value' => 'db_inventarios'
                                                        );

                                                        echo form_input($data);
                                                    ?>
													</div>
												</div>
		                                	</div>
		                                	<div class="col-sm-10 col-sm-offset-1">		                                	    
												<div class="input-group">												    
													<span class="input-group-addon">
														<i class="material-icons">verified_user</i>
													</span>
													<div class="form-group label-floating">                                               
			                                          <label class="control-label">Clave de la Base de datos </label>
                                                        <? 
                                                            $data = array(
                                                                'type'  => 'password',
                                                                'name'  => 'db_pass',
                                                                'id'    => 'db_pass',
                                                                'class' => 'form-control',
                                                                'value' => set_value('db_pass')
                                                            );

                                                            echo form_input($data);
                                                        ?>
			                                        </div>
												</div>
		                                	</div>	
	                                	<div class="col-sm-10 col-sm-offset-1">		                                	    
												<div class="input-group">												    
													<span class="input-group-addon">
														<i class="material-icons">verified_user</i>
													</span>
													<div class="form-group label-floating">                                               
			                                          <label class="control-label">Confirmar la clave de la Base de datos </label>
                                                        <? 
                                                            $data = array(
                                                                'type'  => 'password',
                                                                'name'  => 'conf_db_pass',
                                                                'id'    => 'conf_db_pass',
                                                                'class' => 'form-control',
                                                                'value' => set_value('conf_db_pass')
                                                            );

                                                            echo form_input($data);
                                                        ?>
			                                        </div>
												</div>
		                                	</div>			                                		                                	
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="address">
                                        <h4 class="info-text">Click en <b>CREAR</b></h4>
                                        <div class="row">

                                        </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Siguiente' />
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='Crear' value='Crear' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             Congreso de la República de Guatemala - Unidad de Desarrollo.
	        </div>
	    </div>
	</div>

</body>
	<!--   Core JS Files   -->
    <script src="<?=ROOT_SYS;?>/assets/INIT/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="<?=ROOT_SYS;?>/assets/INIT/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=ROOT_SYS;?>/assets/INIT/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="<?=ROOT_SYS;?>/assets/INIT/assets/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="<?=ROOT_SYS;?>/assets/INIT/assets/js/jquery.validate.min.js"></script>

</html>
