<body>

<div id="container">
    <h1>Bienvenido al CMS-CREATOR!</h1>

    <div id="body">

        <!--<p>Por favor ingresa el nombre del sistema</p>
        <code>application/views/welcome_message.php</code>

        <p>The corresponding controller for this page is found at:</p> -->
        <? if (validation_errors() != ""):?>
            <div class="form_error">
                <?php echo validation_errors(); ?>
            </div>        
        <? endif;?>
        <? echo form_open('revisar'); ?>
        <!-- </form> -->        
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Nombre del sistema</h1>
                    <p class="lead">ingresa la dirección correcta del sistema ej.</p>
                    <code>http://localhost/nombre_sistema</code>
                <div class="form-group">
                    <label for="sys_name"><b>Ruta del sistema:</b></label>
                    <? 
                        $data = array(
                            'type'  => 'text',
                            'name'  => 'root_sys',
                            'id'    => 'root_sys',
                            'placeholder' => 'ej. http://localhost/nombre_sistema',
                            'class' => 'form-control',
                            'value' => set_value('root_sys')
                        );

                        echo form_input($data);
                    ?>
                </div>                     
                <div class="form-group">
                    <label for="sys_name"><b>Nombre del sistema:</b></label>
                    <? 
                        $data = array(
                            'type'  => 'text',
                            'name'  => 'sys_name',
                            'id'    => 'sys_name',
                            'placeholder' => 'ej. nombre_del_sistema',
                            'class' => 'form-control',
                            'value' => set_value('sys_name')
                        );

                        echo form_input($data);
                    ?>
                </div>                
                </div>
            </div>        

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Base de datos </h1>
                    <p class="lead">ingresa los datos de la base de datos correspondiente a este proyecto.</p>
                    <!-- usuario db --> 
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"><b>Usuario de la Base de Datos:</b></label>
                        <div class="col-sm-10">
                        <? 
                            $data = array(
                                'type'  => 'text',
                                'name'  => 'db_user',
                                'id'    => 'db_user',
                                'placeholder' => 'ej. user_db',
                                'class' => 'form-control',
                                'value' => set_value('db_user')
                            );

                            echo form_input($data);
                        ?>
                        </div>
                    </div>                 
                    <!-- nombre db -->  
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"><b>Nombre de la Base de Datos:</b></label>
                        <div class="col-sm-10">
                        <? 
                            $data = array(
                                'type'  => 'text',
                                'name'  => 'db_name',
                                'id'    => 'db_name',
                                'placeholder' => 'ej. base_de_datos',
                                'class' => 'form-control',
                                'value' => set_value('db_name')
                            );

                            echo form_input($data);
                        ?>
                        <small id="db_Help" class="form-text text-muted">escriba exactamente el nombre de la base de datos.</small>
                        </div>
                    </div>    
                    <!-- clave -->
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"><b>Clave de la Base de Datos:</b></label>
                        <div class="col-sm-10">
                        <? 
                            $data = array(
                                'type'  => 'password',
                                'name'  => 'db_pass',
                                'id'    => 'db_pass',
                                'placeholder' => 'ej. Ijk$51#_sd9',
                                'class' => 'form-control',
                                'value' => set_value('db_pass')
                            );

                            echo form_input($data);
                        ?>
                        </div>
                    </div>                 
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"><b>Confirmar la clave de la Base de Datos:</b></label>
                        <div class="col-sm-10">
                        <? 
                            $data = array(
                                'type'  => 'password',
                                'name'  => 'conf_db_pass',
                                'id'    => 'conf_db_pass',
                                'placeholder' => 'ej. Ijk$51#_sd9',
                                'class' => 'form-control',
                                'value' => set_value('conf_db_pass')
                            );

                            echo form_input($data);
                        ?>
                        </div>
                    </div>                                                                                 
                </div>           
            </div>          
            <button type="submit" class="btn btn-primary ">Siguiente</button>
        </form>
        <!-- <code>application/controllers/Welcome.php</code> -->
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '' ?></p>
</div>

</body>
</html>