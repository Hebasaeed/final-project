
                <!-- ffffffffffffffffffstartffffffffffffffffff -->

                <div id="layoutSidenav">
         <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">ANALYSIS</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                MEDICAL ANALYSIS
                            </a>
                          
                          
                          
                            <div class="sb-sidenav-menu-heading">Interface</div>
                           
                           <?php



                           if($_SESSION['User']['id_usertypes']==16){
                                 
                                $modules = ["analysis","new_patient"];
                           }else{
                                $modules =  ["users","analysis","new_patient","analysis_patient","department","review_doc","verified_chemist","usertype"];
                            }
                            foreach($modules as $key => $module){


                           ?>
                           
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts<?php echo $key;?>" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                <?php echo $module;?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts<?php echo $key;?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo url($module.'/create.php')?>">CREATE</a>
                                    <a class="nav-link" href="<?php echo url($module)?>">DISPLAY DETAILS</a>
                                </nav>
                            </div>

                            <?php } ?>




                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">