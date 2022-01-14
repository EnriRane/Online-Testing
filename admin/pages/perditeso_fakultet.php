        <?php 
            if(isset($_GET['id']))
            {
                $id_fakultet=$_GET['id'];
                $tbl_name="tbl_fakultet";
                $where="id_fakultet=$id_fakultet";
                $query=$obj->selektoTeDhenat($tbl_name,$where);
                $res=$obj->ekzekutoQuery($conn,$query);
                $count_rows=$obj->numriRreshtave($res);
                if($count_rows==1)
                {
                    $row=$obj->fetch_data($res);
                    $emri_fakultetit=$row['emri_fakultetit'];
                    $kohezgjatja=$row['kohezgjatja'];
                    $qns_per_page=$row['pyetje_per_set'];
                    $total_general=$row['total_pergjithshme'];
                    $total_matematike=$row['total_matematike'];
                    $eshte_aktive=$row['eshte_aktive'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/index.php?page=fakultetet');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/index.php?page=fakultetet');
            }
        ?>
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Perditeso fakultetin</h2>
                        <?php 
                            if(isset($_SESSION['perditesimi']))
                            {
                                echo $_SESSION['perditesimi'];
                                unset($_SESSION['perditesimi']);
                            }
                        ?>
                        <span class="name">Emri i fakultetit</span> 
                        <input type="text" name="emri_fakultetit" value="<?php echo $emri_fakultetit; ?>" required="true" /> <br />
                        
                        <span class="name">Kohezgjatja</span>
                        <input type="number" name="kohezgjatja" value="<?php echo $kohezgjatja; ?>" required="true" /><br />
                        
                        <span class="name">Pyetje per provim</span>
                        <input type="number" name="qns_per_page" value="<?php echo $qns_per_page; ?>" required="true" /><br />
                        
                        <span class="name">Te pergjithshme</span>
                        <input type="number" name="total_pyetje_pergjithshme" value="<?php echo $total_general; ?>" required="true" /><br />
                        
                        <span class="name">Matematike</span>
                        <input type="number" name="total_pyetje_matematike" value="<?php echo $total_matematike; ?>" /><br />
                        
                        <span class="name">Aktiviteti</span>
                        <input <?php if($eshte_aktive=="po"){echo "checked='checked'";} ?> type="radio" name="eshte_aktive" value="po" /> Po
                        <input <?php if($eshte_aktive=="jo"){echo "checked='checked'";} ?> type="radio" name="eshte_aktive" value="jo" /> Jo
                        <br />
                        
                        <input type="submit" name="submit" value="Perditeso fakuktetin" class="btn-update" style="margin-left: 15%;" />
                        <button type="button" class="btn-delete">Kthehu</button>
                    </form>
                    <?php 
                        if(isset($_POST['submit']))
                        {
                          
                            $emri_fakultetit=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['emri_fakultetit']);
                            $kohezgjatja=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['kohezgjatja']);
                            $qns_per_page=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['qns_per_page']);
                            $total_general=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['total_pyetje_pergjithshme']);
                            $total_matematike=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['total_pyetje_matematike']);
                            $eshte_aktive=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['eshte_aktive']);
                            $data_perditesimit=date('Y-m-d');
                            
                            $tbl_name='tbl_fakultet';
                            $data="emri_fakultetit='$emri_fakultetit',
                                    kohezgjatja='$kohezgjatja',
                                    pyetje_per_set='$qns_per_page',
                                    total_pergjithshme='$total_general',
                                    total_matematike='$total_matematike',
                                    eshte_aktive='$eshte_aktive',
                                    data_perditesimit='$data_perditesimit'";
                            $where="id_fakultet='$id_fakultet'";
                            $query=$obj->perditesoTeDhena($tbl_name,$data,$where);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['perditesimi']="<div class='success'>Fakulteti u perditesua me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fakultetet');
                            }
                            else
                            {
                                $_SESSION['perditesimi']="<div class='error'>Perditesimi i fakukultetit deshtoi. Provi perseri..</div>";
                                header('location:'.SITEURL.'admin/index.php?page=perditeso_fakultet&id='.$id_fakultet);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
