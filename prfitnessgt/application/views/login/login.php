<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/theme/img/favicon.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/theme/img/favicon.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

     <!-- Bootstrap core CSS     -->
    <link href="<?=base_url()?>assets/theme/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="<?=base_url()?>assets/theme/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?=base_url()?>assets/theme/css/demo.css" rel="stylesheet" />


    <!--  Paper Dashboard core CSS    -->
    <link href="<?=base_url()?>assets/theme/css/animate.css" rel="stylesheet"/>
    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>assets/theme/css/themify-icons.css" rel="stylesheet">
    
</head>

<body>
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../dashboard/overview.html">Sistema <?=ucwords(NAME_SYS)?></a>
            </div>
        </div>
    </nav>

    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="<?=base_url()?>assets/theme/img/background/background.gif">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content" ng-app="login">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3"  ng-controller="ctrlLogin as cLogin">
                            <form id="logiForm" name="logiForm" novalidate ng-submit='logiForm.$valid'>
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="card-header">
                                        <h3 class="card-title text-center text-success">Bienvenido</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Usuario:</label>
                                            <input type="text" name="usuario" ng-model="cLogin.data.usuario"  placeholder="Ingresa tu usuario" class="form-control" required>
                                            <span ng-show="loginForm.usuario.$error.required">Username is required.</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Clave:</label>
                                            <input type="password" name="clave" ng-model="cLogin.data.clave"  placeholder="ingresa tu clave" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <input type="submit" ng-disabled="!logiForm.$valid" ng-click="loggearse(cLogin.data)" value="ingresar"  class="btn btn-success btn-fill btn-wd ">
                                        <br>
                                        <!-- <div>{{logiForm.$valid}}</div> -->
                                        <br>
                                        <div class="forgot">
                                            <a href="#" onclick="demo.showSwal('olvidaste-clave')" class="text-left">¿Olvidaste tu clave?</a>
                                        </div>
                                        <div class="alert alert-danger animated fadeIn" ng-show="show_error">
                                            <strong>error!</strong> {{ error }}
                                        </div>                                       
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        	<footer class="footer footer-transparent">
                <div class="container">

                     <div class="copyright">
						&copy; <span id="year_data"></span><a href="http://intranet.congreso.gob.gt/pl/" target="_blank">Unidad de Desarrollo - Multisolusionesgt</a>

                    </div>
<!--
                    <div class="copyright">
                        &copy; <script>document.write(new Date().getFullYear())</script> by <a href="#"><?=base64_decode('T3NjYXIgQ2ViYWxsb3M=')?></a>
                    </div>   -->
                </div>
            </footer>
        </div>
    </div>
</body>
	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="<?=base_url()?>assets/theme/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/theme/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/theme/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/theme/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- angular inclusion -->
	<script id="angularScript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.7/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.7/angular-animate.min.js"></script>  
    <script>
    <?php require_once( FCPATH.'assets/theme/js/angular/loginJS.php');?>
    </script>
    <!--script src="<?=base_url()?>assets/theme/js/angular/login.js" type="text/javascript"></script-->
        
	<!--  Forms Validations Plugin -->
	<script src="<?=base_url()?>assets/theme/js/jquery.validate.min.js"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="<?=base_url()?>assets/theme/js/es6-promise-auto.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="<?=base_url()?>assets/theme/js/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="<?=base_url()?>assets/theme/js/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="<?=base_url()?>assets/theme/js/bootstrap-selectpicker.js"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="<?=base_url()?>assets/theme/js/bootstrap-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
	<script src="<?=base_url()?>assets/theme/js/jquery.easypiechart.min.js"></script>

	<!--  Charts Plugin -->
	<script src="<?=base_url()?>assets/theme/js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="<?=base_url()?>assets/theme/js/bootstrap-notify.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="<?=base_url()?>assets/theme/js/sweetalert2.js"></script>

	<!-- Vector Map plugin -->
	<script src="<?=base_url()?>assets/theme/js/jquery-jvectormap.js"></script>

	<!--  Google Maps Plugin    -->
<!-- 	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

	<!-- Wizard Plugin    -->
	<script src="<?=base_url()?>assets/theme/js/jquery.bootstrap.wizard.min.js"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="<?=base_url()?>assets/theme/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="<?=base_url()?>assets/theme/js/jquery.datatables.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="<?=base_url()?>assets/theme/js/fullcalendar.min.js"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="<?=base_url()?>assets/theme/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="<?=base_url()?>assets/theme/js/demo.js"></script>

	<script type="text/javascript">
        $().ready(function(){
            demo.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700);
                            
            
            var year$ = new Date().getFullYear();
            $('#year_data').append(year$ + " ");
                                       
        });
	</script>

</html>
