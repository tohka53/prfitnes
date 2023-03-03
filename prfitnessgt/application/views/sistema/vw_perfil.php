<div class="content">
    <div class="container-fluid" >
        <div class="row">
            <div class="col-lg-4 col-md-5" >
                <div class="card card-user" ng-app="perfil" ng-controller="ctrlProfileCard as profile">
                    <div class="image">
                        <img src="<?=base_url()?>assets/img/background.jpg" alt="...">
                    </div>
                    <div class="card-content">
                        <div class="author">
                            <img class="avatar border-white" src="<?=base_url()?>assets/uploads/images_colaboradores/<?=$this->session->userdata("imagen")?>" alt="...">
                            <h4 class="card-title"><?=$this->session->userdata("nombre")?><br>
                                <a href="#"><small><?=$this->session->userdata("usuario")?></small></a>
                            </h4>
                        </div>
<!--                      
                        <blockquote>                            
                            <p class="description text-center">
                                "I like the way you work it <br>
                                No diggity <br>
                                I wanna bag it up"
                            </p>   
                        </blockquote>  -->
                    </div>
                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <h5>12<br><small>salidas</small></h5>
                            </div>
                            <div class="col-md-4">
                                <h5>2GB<br><small>presentaciones</small></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>24,6$<br><small>este mes</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
<!--                 <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Team Members</h4>
                    </div>
                    <div class="card-content">
                        <ul class="list-unstyled team-members">
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="../../assets/img/faces/face-0.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        DJ Khaled
                                        <br>
                                        <span class="text-muted"><small>Offline</small></span>
                                    </div>
                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="../../assets/img/faces/face-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        Creative Tim
                                        <br>
                                        <span class="text-success"><small>Available</small></span>
                                    </div>
                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="../../assets/img/faces/face-3.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        Flume
                                        <br>
                                        <span class="text-danger"><small>Busy</small></span>
                                    </div>
                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-8 col-md-7" >
                <div class="card" ng-app="datosPerfil" ng-controller="ctrlDataProfileCard as data">
                    <div class="card-header">
                        <h4 class="card-title">Editar Perfil</h4>
                    </div>
                    <div class="card-content" ng-init="id_colaborador = <?=$id?>">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <?php
                                            echo $inputs['nombres'];
                                        ?>  
                                        <!-- <input type="text" class="form-control border-input" disabled="" placeholder="Company" value="Creative Code Inc."> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <?php
                                            echo $inputs['apellidos'];
                                        ?>  
                                       <!--  <input type="text" class="form-control border-input" placeholder="Username" value="michael23"> -->
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control border-input" placeholder="Email">
                                    </div>
                                </div> -->
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <?php
                                            echo $inputs['usuario'];
                                        ?>                                         
                                        <!-- <input type="text" class="form-control border-input" placeholder="Company" value="Chet"> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Clave</label>
                                        <?php
                                            echo $inputs['clave'];
                                        ?>                                         
                                        <!-- <input type="text" class="form-control border-input" placeholder="Last Name" value="Faker"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección de Casa</label>
                                        <?php
                                            echo $inputs['direccion_casa'];
                                        ?>                                                                                  
                                        <!-- <input type="text" class="form-control border-input" placeholder="Home Address" value="Melbourne, Australia"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cumpleaños</label>
                                        <?php
                                            echo $inputs['fecha_nacimiento'];
                                        ?>                                           
                                        <!-- <input type="text" class="form-control border-input" placeholder="City" value="Melbourne"> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>DPI</label>
                                        <?php
                                            echo $inputs['dpi'];
                                        ?>                                           
                                        <!-- <input type="text" class="form-control border-input" placeholder="Country" value="Australia"> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <?php
                                            echo $inputs['no_telefono'];
                                        ?>                                           
                                        <!-- <input type="number" class="form-control border-input" placeholder="ZIP Code"> -->
                                    </div>
                                </div>
                            </div>
  <!--                           <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
You doubt I'll bother, reading into it
I'll probably won't, left to my own devices
But that's the difference in our opinions.
                                        </textarea>
                                    </div>
                                </div>
                            </div> -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>