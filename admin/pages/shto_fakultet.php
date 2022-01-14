        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Shto fakultet</h2>
                        <?php 
                            if(isset($_SESSION['validimi']))
                            {
                                echo $_SESSION['validimi'];
                                unset($_SESSION['validimi']);
                            }
                            if(isset($_SESSION['shto']))
                            {
                                echo $_SESSION['shto'];
                                unset($_SESSION['shto']);
                            }
                        ?>
                        <span class="name">Emri i fakultetit </span> 
                        <input type="text" name="emri_fakultetit" placeholder="Emri i fakultetit" required="true" /> <br />
                        
                        <span class="name">Kohezgjatja</span>
                        <input type="text" name="kohezgjatja" placeholder="Kohezgjatja ne minuta" required="true" /><br />
                        
                        <span class="name">Totali i pyetjeve</span>
                        <input type="text" name="qns_per_page" placeholder="Totali i pyetjeve" required="true" /><br />
                        
                        <span class="name">Te pergjithshme</span>
                        <input type="number" name="total_pyetje_pergjithshme" placeholder="Te pergjithshme" required="true" /><br />
                        
                        <span class="name">Pyetje matematike</span>
                        <input type="number" name="total_pyetje_matematike" placeholder="Totali i pyetjeve te matematikes" /><br />
                        
                        <span class="name">Aktiviteti</span>
                        <input type="radio" name="eshte_aktive" value="po" /> Po 
                        <input type="radio" name="eshte_aktive" value="jo" /> Jo
                        <br />
                        
                        <input type="submit" name="submit" value="Shto fakultet" class="btn-add" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=fakultetet">
                            <button type="button" class="btn-delete">Kthehu</button>
                        </a>
                    </form>
                    
                    <?php 
                        if(isset($_POST['submit']))
                        {
                         
                            $emri_fakultetit=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['emri_fakultetit']);
                            $kohezgjatja=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['kohezgjatja']);
                            $qns_per_page=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['qns_per_page']);
                            $total_pergjithshme=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['total_pyetje_pergjithshme']);
                            $total_matematike=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['total_pyetje_matematike']);
                            if(isset($_POST['eshte_aktive']))
                            {
                                $eshte_aktive=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['eshte_aktive']);
                            }
                            else
                            {
                                $eshte_aktive="po";
                            }
                            $data_krijimit=date('Y-m-d');
                            
                          
                            if(($emri_fakultetit=="")||($kohezgjatja=="")||($qns_per_page==""))
                            {
                                $_SESSION['validimi']="<div class='error'>Emri i fakultetit ose Kohezgjatja or Totali i pyetjeve eshte bosh.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=shto_fakultet');
                            }
                            $tbl_name='tbl_fakultet';
                            $data="emri_fakultetit='$emri_fakultetit',
                                    kohezgjatja='$kohezgjatja',
                                    pyetje_per_set='$qns_per_page',
                                    total_pergjithshme='$total_pergjithshme',
                                    total_matematike='$total_matematike',
                                    eshte_aktive='$eshte_aktive',
                                    data_krijimit='$data_krijimit',
                                    data_perditesimit=''";
                           
                            $query=$obj->insertoTeDhena($tbl_name,$data);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                              
                                $_SESSION['shto']="<div class='success'>Fakulteti i ri u shtua me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fakultetet');
                            }
                            else
                            {
                            
                                $_SESSION['shto']="<div class='error'>Shtimi i fakultetit deshtoi. Provo perseri.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=shto_fakultet');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
