    <div class="main">
            <div class="content">
                <div class="report">
                    <h2><u>Menuja kryesore</u></h2>
                    
                    <?php 
                        if(isset($_SESSION['success']))
                        {
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        }
                        if(isset($_SESSION['deshtimi']))
                        {
                            echo $_SESSION['deshtimi'];
                            unset($_SESSION['deshtimi']);
                        }
                    ?>
                    
                    <div class="clearfix">
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=studentet">
                            <div class="dash-tile">
                                
                                <h1><?php echo $obj->merrNumrinTotalRreshtave('tbl_student',$conn); ?></h1>
                                <span>Studentet</span>
                            </div>
                        </a>
                        
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=fakultetet">
                            <div class="dash-tile">
                                <h1><?php echo $obj->merrNumrinTotalRreshtave('tbl_fakultet',$conn); ?></h1>
                                <span>Fakultetet</span>
                            </div>
                        </a>
                        
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=pyetjet">
                            <div class="dash-tile">
                                <h1><?php echo $obj->merrNumrinTotalRreshtave('tbl_pyetje',$conn); ?></h1>
                                <span>Pyetjet</span>
                            </div>
                        </a>
                        
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=rezultatet">
                            <div class="dash-tile">
                                <h1><?php echo $obj->merrNumrinTotalRreshtave('tbl_rezultat_permbledhje',$conn); ?></h1>
                                <span>Rezultatet</span>
                            </div>
                        </a>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>