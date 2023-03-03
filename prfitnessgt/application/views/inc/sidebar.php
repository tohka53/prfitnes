<?php

    $parents = json_decode(json_encode($parents));
    //print_r($parents);
    $children = json_decode(json_encode($children));
    //print_r($children);    
    //echo "hey there";
?>
    <style>
        /**
        * coloca el color del nodo padre 
        */
        .active_parent{
            color:#de7d57 !important;
        }
    </style>
	<div class="wrapper">
    <div class="sidebar" data-background-color="brown" data-active-color="danger">
    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
        <div class="logo">
          <!--  <a href="http://www.creative-tim.com" class="simple-text logo-mini"  -->
            <a href="#" class="simple-text logo-mini">
                CMS
            </a>
        <!--    <a href="http://www.creative-tim.com" class="simple-text logo-normal">   -->
            <a href="#" class="simple-text logo-normal">
            CMS <?=NAME_SYS?>
            </a>
        </div>
        <div class="sidebar-wrapper"><!-- inicio navbar -->
            <div class="user">
                <div class="info">
                    <div class="photo">
                        <img src=<?=base_url()?>assets/uploads/images_colaboradores/<?=$this->session->userdata("imagen")?> />
                    </div>

                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        <span>
                            <?=$this->session->userdata("usuario") ?>                           						
                            <b class="caret"></b>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <!--a href="<?=base_url()?>perfil">
                                    <span class="sidebar-mini">P</span>
                                    <span class="sidebar-normal">Perfil</span>
                                </a>
                            </li>
                            <!--li>
                                <a href="#edit">
                                    <span class="sidebar-mini">Ep</span>
                                    <span class="sidebar-normal">Editar Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="sidebar-mini">PP</span>
                                    <span class="sidebar-normal">Propiedades</span>
                                </a>
                            </li-->
                            <li>
                                <a href="<?=base_url()?>cerrar_sesion">
                                    <span class="sidebar-mini">E</span>
                                    <span class="sidebar-normal">Salir</span>
                                </a>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
            <script src="<?= base_url()?>assets/grocery_crud/js/jquery-1.11.1.min.js"></script>
                <?php foreach($parents as $rows): ?>
                <?php $flag = 0?>
                    <?php for($i=0; $i < count($children); $i++ ): ?> 
                        <?php if($children[$i]->id_parent_item == $rows->id ):?>   
                        <!-- avoid duplicated id="parent_item" --> 
                            <?php if($flag <= 0) :?>        
                            <li >
                                <a id="parent_<?=$i?>" data-toggle="collapse" style="color:#FAFAFA;" href="#<?=$rows->nombre_item?>" >
                                    <i class="<?=$rows->icon_item?> icon-info"></i>
                                    <p><?=$rows->nombre_item?>
                                        <b class="caret"></b>
                                    </p>
                                </a>        
                                <div class="collapse" id="<?=$rows->nombre_item?>">
                                    <ul class="nav">                                
                                        <?php foreach($children as $child): ?>
                                           
                                            <?php if($rows->id == $child->id_parent_item):?>
                                            <!-- virify every allow slug -->
                                                <?php 
                                                    /* CHECK which link is active or not  */
                                                ?>                                               
                                                <?php if($this->uri->segment(1) == $child->slug):?>
                                                       
                                                    <li class="active"> 
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#<?=$rows->nombre_item?>').addClass("in");
                                                            $('#parent_<?=$i?>').addClass("active_parent");
                                                        })
                                                    </script>
                                                <?php else: ?>
                                                    <li class="">                                                     
                                                <?php endif;
                                                    /* end of CHECK */
                                                ?>
                                                <a href="<?=site_url($child->slug);?>">                                        
                                                    <span class="sidebar-mini" ><?=$child->referency_word?></span>
                                                    <span class="sidebar-normal" ><?=$child->name_sub_item?></span>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>                                                                   
                            </li>
                            
                            <?php $flag++;?>
                            <?php  endif;?>
                        <?php  endif;?>
                    <?php endfor; ?>                      
                <?php endforeach; ?>
                <br><br><br>
        </div>
        <script>
             $(document).ready(function () {
                var idleState = false;
                var idleTimer = null;
                $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
                    var $time = 125 * 60 * 1000;
                    clearTimeout(idleTimer);
                    if (idleState == true) { 
                        $("body").css('background-color','#fff');            
                    }
                    idleState = false;
                    idleTimer = setTimeout(function () { 
						console.log("idle on action");
                        alert("sesion terminada por inactividad");
                        window.location = "<?=base_url()?>cerrar_sesion";
                        $("body").css('background-color','#000');
                        idleState = true; }, $time);
                });
                $("body").trigger("mousemove");
            });            
        </script>
    </div><!-- fin navbar -->